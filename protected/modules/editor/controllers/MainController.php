<?php

class MainController extends Controller
{
    public function filters()
    {
        return array(
            'accessControl',
        );
    }


    public function accessRules()
    {
        return array(
            array('allow',
                'actions'=>array('browse', 'edit', 'new'),
                'users'=>array('@'),
            ),
            array('deny',
                'users'=>array('*'),
            ),
        );
    }


    public function actionBrowse()
    {
        $tutorials = new Tutorials();
        $tutorials = $tutorials->findAllByAttributes(array('owner_id' => Yii::app()->user->getId()));

        $this->render('browse', array('tutorials' => $tutorials));
    }

    public function actionEdit()
    {
        $id = Yii::app()->request->getQuery('id');
        $form = new TutorialForm();
        $tutorial = new Tutorials();

        $tutorial = $tutorial->findByPk($id);
        $form->id = $tutorial->tutorial_id;
        $form->title = $tutorial->title;
        $form->content = $tutorial->content;

        $post = Yii::app()->request->getPost('TutorialForm');
        if (isset($post)) {
            $post['content'] = htmlspecialchars_decode($post['content']);
            $form->attributes = $post;
            if($form->validate()) {
                $form->save();
            }
        }

        if(Yii::app()->request->isAjaxRequest)
        {
            echo $tutorial->content;
            Yii::app()->end();
        }
        else
        {
            $this->render('edit', array('form' => $form));
        }
    }

    public function actionNew()
    {
        $form = new TutorialForm();
        $form->create();
        $url = CHtml::normalizeUrl(Yii::app()->createUrl('/editor/main/edit', array('id'=>$form->id)));
        $this->redirect($url);
//        $this->render('edit', array('form' => $form));
    }
}