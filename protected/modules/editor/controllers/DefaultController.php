<?php

class DefaultController extends Controller
{
	public function actionIndex()
	{
        $form = new TutorialForm();
        $form->content = 'Text from tutorial activeRecord';
		$this->render('index', array('form'=>$form));
	}
}