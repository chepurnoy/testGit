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
            'cocoCod' => array(
                'class' => 'CocoCodAction',
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
     * @author    Igor Chepurnoy 
     * Action Register
     */
    public function actionRegister() {
        $this->pageTitle = 'Registration Page';
        //Create models
        $userModel = new UserModel;
        $loginForm = new LoginForm;
        //Get post param
        $post = Yii::app()->request->getPost('UserModel');
        //Ajax Validation
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'commentform') {
            echo CActiveForm::validate($userModel);
            Yii::app()->end();
        }
        //Collect data and save it
        if (!empty($post)) {
            $userModel->attributes = Yii::app()->request->getPost('UserModel');
            if ($userModel->save()) {
                if ($loginForm->oneStepLogin($userModel->email, $post['password'])) {
                    $this->redirect(Yii::app()->homeUrl);
                }
            }
        }
        $this->render('register', array(
            'model' => $userModel,
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
     * @author    Igor Chepurnoy 
     * Displays the contact page
     */
    public function actionContact() {
        $this->pageTitle = "Contact Us";
        $model = new ContactModel;
        //Ajax validation
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'commentform') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        //Collect data
        if (isset($_POST['ContactModel'])) {
            $model->attributes = $_POST['ContactModel'];
            if ($model->validate()) {
                // form inputs are valid, do something here
                $model->save();
                Yii::app()->user->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
                $this->refresh();
            }
        }
        $this->render('contact', array('model' => $model));
    }
    
    /**
     * @author    Igor Chepurnoy 
     * Displays the login page
     */
    public function actionLogin() {
        $this->pageTitle = 'Login Page';
        $model = new LoginForm;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'commentform') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login())
                $this->redirect(Yii::app()->user->returnUrl);
        }
        // display the login form
        $this->render('login', array('model' => $model));
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
     * Action Search
     */
    public function actionSearch(){
        $form = new SearchForm;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'seacrhform') {
            echo CActiveForm::validate($form);
            Yii::app()->end();
        }
        $title = Yii::app()->request->getPost('SearchForm');
        // Get results
        $result = GitRepositories::getSearchItems($title['title']);
        $result = array_slice($result['items'], 0,10);
        //Set page title
        $this->pageTitle = "For seacrh term - ".$title['title'].", found:";
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
    
    /**
     * @author    Igor Chepurnoy
     * Action Page
     * @param type $alias
     * @throws CHttpException
     */
    public function actionPage($alias) {
        $this->layout = 'main';
        $page = PageModel::model()->findByAttributes(array('link' => $alias));
//        $test = PageModel::generateMenu();
//        var_dump($test);die;
        
        $this->pageTitle = $page->title;
        if (empty($page)) {
            throw new CHttpException(404, 'The specified post cannot be found.');
        }
        $this->render('dynamicPage', array(
            'page' => $page,
        ));
    }
}
