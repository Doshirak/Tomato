<?php

class TutorialForm extends CFormModel
{
    public $content;

    /**
     * Declares the validation rules.
     */
    public function rules()
    {
        return array(
            array('content', 'required'),
        );
    }
}