<?php
Yii::import('application.helpers.GitRepositories');
class UserController extends Controller {

    /**
     * View User
     * @param type $name
     */
    public function actionView($name) {
        $this->pageTitle = "User";
        $user = GitRepositories::getSingleUser($name);
        $this->render('view',array(
          'user' => $user
        ));
    }

    public function actionAddLike($id)
    {
        $userIdLike = $id;
        //Get a Specific User
        $model = new LikesModel;
        //Get previous page
        $previousPage = Yii::app()->request->urlReferrer;
        // collect data
        if (isset($userIdLike)) {
            //collect user data
            $model->ipUser = Yii::app()->request->userHostAddress;
            $model->userIdLike = $userIdLike;
            //Save data
            if ($model->save()) {
                Yii::app()->user->setFlash('addLike', 'Your add like');
            }
        }
        $this->redirect($previousPage);
    }

    /**
     * @author    Igor Chepurnoy <Chepurnoy@zfort.com>
     *            UnLike Function
     */
    public function actionUnLike($id)
    {
        $userIdLike = $id;
        //Create Likes Model
        $model = new LikesModel;
        //Get previous page
        $previousPage = Yii::app()->request->urlReferrer;
        // collect data
        if (isset($userIdLike)) {
            //Delete like user
            if ($model->deleteAllByAttributes(array('userIdLike' => $userIdLike, 'ipUser' => Yii::app()->request->userHostAddress))) {
                //Set Flash
                Yii::app()->user->setFlash('addLike', 'Your unlike user');
            }
        }
        $this->redirect($previousPage);
    }
}

