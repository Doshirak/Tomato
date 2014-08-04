<?php

class TutorialForm extends CFormModel
{
    public $id;
    public $title;
    public $content;

    public function rules()
    {
        return array(
            array('id, title, content', 'required'),
        );
    }

    public function save()
    {
        $newTutorial = new Tutorials();
        $tutorial = $newTutorial->findByPk($this->id);
        $tutorial->title = $this->title;
        $tutorial->content = $this->content;
        $tutorial->update_date = new CDbExpression('NOW()');
        $tutorial->save();

    }

    public function create()
    {
        $tutorial = new Tutorials();
        $tutorial->owner_id = Yii::app()->user->getId();
        $tutorial->title = 'Title';
        $tutorial->content = 'Content';
        $tutorial->rating = 0;
        $tutorial->views = 0;
        $tutorial->create_date = new CDbExpression('NOW()');
        $tutorial->update_date = new CDbExpression('NOW()');
        $tutorial->save();
        $tutorial->origin_id = $tutorial->tutorial_id;
        $tutorial->save();

        $this->id = $tutorial->tutorial_id;
        $this->title = $tutorial->title;
        $this->content = $tutorial->content;
    }
}