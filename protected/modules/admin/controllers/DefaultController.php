<?php

class DefaultController extends Controller
{
	public function actionIndex()
        { 

            if(Yii::app()->user->getType() == 'user' || Yii::app()->user->isGuest) {
                $this->redirect(Yii::app()->createUrl('site/page?link=404'));
        }
        else {
		$this->redirect(Yii::app()->createUrl('admin/contact/admin'));
             }
	}
}