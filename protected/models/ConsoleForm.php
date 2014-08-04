<?php

/**
 * ConsoleForm class.
 * ConsoleForm is the data structure for keeping console data.
 * It is used by actions of 'ConsoleController'.
 */
class ConsoleForm extends CFormModel
{
    public $code;
    public $inputData;
    public $outputData;
    public $language;
    public static $languages;

    public function __construct()
    {
        parent::__construct();

        if (! self::$languages)
            self::$languages = Yii::app()->compilerService->getLanguages();
    }

    /**
     * Declares the validation rules.
     */
    public function rules()
    {
        return array(
            array('code', 'required'),
            array('inputData, outputData, language', 'safe'),
        );
    }

    /**
     * Declares customized attribute labels.
     * If not declared here, an attribute would have a label that is
     * the same as its name with the first letter in upper case.
     */
    public function attributeLabels()
    {
        return array(
            'code' => 'Code',
            'inputData' => 'Input data',
            'outputData' => 'Output data',
        );
    }

    public function executeCode()
    {
        $answer = Yii::app()->compilerService->createSubmission($this->code, $this->inputData, $this->language);
        if (!is_array($answer))
            return false;

        $submIid = $answer[0];
        $with = array('output' => true);
        $answer = Yii::app()->compilerService->getSubmissionDetails($submIid, $with);
        if (!is_array($answer))
            return false;

        $this->outputData = $answer['output'];
        return true;
    }
} 