<?php

class SiteController extends CController
{
	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

    public function actionLogin()
    {
        $model=new LoginForm();

        if(isset($_POST['ajax']) && $_POST['ajax'] === 'login-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        if(isset($_POST['LoginForm']))
        {
            $model->attributes = $_POST['LoginForm'];

            if($model->validate() && $model->login())
            {
                echo CJSON::encode(array(
                    'status'=>'success'
                ));

                Yii::app()->end();
            }
        else
            {
                $error = CActiveForm::validate($model);
                if($error!='[]')
                    echo $error;

                Yii::app()->end();
            }
        }

        $this->render('login',array('model'=>$model));
    }

    public function actionRegistrate()
    {
        $model=new RegistrateForm();

        if(isset($_POST['ajax']) && $_POST['ajax'] === 'registrate-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        if(isset($_POST['RegistrateForm']))
        {
            $model->attributes=$_POST['RegistrateForm'];

            if($model->validate() && $model->registrate())
            {
                echo CJSON::encode(array(
                    'status'=>'success'
                ));

                Yii::app()->end();
            }
            else
            {
                $error = CActiveForm::validate($model);
                if($error != '[]')
                    echo $error;

                Yii::app()->end();
            }
        }

        $this->render('registrate',array('model'=>$model));
    }

    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }
}