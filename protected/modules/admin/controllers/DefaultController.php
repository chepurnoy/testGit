<?php

class DefaultController extends Controller {

    public function actionIndex() {
        if (Yii::app()->user->getType() == 'user' || Yii::app()->user->isGuest) {
            throw new CHttpException(404, 'The specified post cannot be found.');
        } else {
            $this->redirect(Yii::app()->createUrl('admin/contact/admin'));
        }
    }

}
