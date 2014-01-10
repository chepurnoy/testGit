<?php

Yii::import('application.helpers.GitRepositories');

/**
 * @author Igor Chepurnoy 
 */
class SiteController extends Controller
{

    public function actions()
    {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex()
    {
        $this->pageTitle = "Main";
        //Get Single repository
        $findRepository = GitRepositories::getFullDataRepository('yiisoft','yii');
        //Get contributors
        $contributors   = GitRepositories::getContributorsUsers($findRepository['full_name']);
        $this->render('index', array(
            'repository'   => $findRepository,
            'contributors' => $contributors,
        ));
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Displays the login page
     */
    public function actionLogin()
    {
        $pages = PageModel::model()->findAll();
        $model = new LoginForm;
        $route = 'admin/contactus/admin';

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login())
                $this->redirect(Yii::app()->createUrl($route));
        }
        // display the login form
        $this->render('login', array(
            'model' => $model,
            'pages' => $pages
        ));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

    /**
     * Displays the about page
     */
    public function actionAbout()
    {
        $this->render('about');
    }

    /**
     * Action Search
     */
    public function actionSearch(){
        //Get param title
        $title = Yii::app()->request->getParam('title');
        // Get results
        $result = GitRepositories::getSearchItems($title);
        $result = array_slice($result['items'], 0,10);
        //Set page title
        $this->pageTitle = "For seacrh term - $title, found:";
        $dataProvider = new CArrayDataProvider($result, array(
            'pagination' => array(
                'pageSize' => 5,
            )
        ));
        $this->render('search',array(
            'dataProvider' => $dataProvider
        ));
    }
    
    /**
     * View Project
     * @param type $owner
     * @param type $repos
     */
    public function actionViewProject($owner,$repos){
        $project = GitRepositories::getFullDataRepository($owner,$repos);
        $contributors   = GitRepositories::getContributorsUsers($project['full_name']);
        $this->pageTitle = $project['description'];
        $this->render('viewProject',array(
          'project'      => $project,
          'contributors' => $contributors
        ));
    }
}
