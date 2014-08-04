<div class="editor">
<?php
$url = CHtml::normalizeUrl(Yii::app()->createUrl('/editor/main/edit', array('id'=>$form->id)));

echo CHtml::beginForm($url);
echo CHtml::activeHiddenField($form, 'id', array('value' => $form->id));
echo CHtml::tag('div', array('class'=>'title'), 'Title');
echo CHtml::activeTextField($form, 'title',  array('value' => $form->title));

echo CHtml::openTag('div', array('class'=>'button'));
echo CHtml::ajaxSubmitButton('Edit',$url,
    array('type' => 'POST','update' => '#TutorialForm_title'),
    array('type'=>'submit')
);
echo CHtml::closeTag('div');

echo CHtml::endForm();

echo CHtml::beginForm($url);
echo CHtml::activeHiddenField($form, 'id', array('value' => $form->id));
echo CHtml::tag('div', array('class'=>'title'),'Content');
$this->widget('application.modules.editor.extensions.eckeditor.ECKEditor', array(
    'model' => $form,
    'attribute' => 'content',
    'config' => array(
        'codeSnippet_theme' => 'monokai',
        'htmlEncodeOutput' => 'true',
//        'toolbar'=>array(
//            array( 'Save'),
//            array( 'Bold', 'Italic', 'Image', 'Link', 'Unlink', ),
//            array('CodeSnippet'),
//        ),
    ),
));

echo CHtml::openTag('div', array('class'=>'button'));
echo CHtml::ajaxSubmitButton('Edit',$url,
    array('type' => 'POST','update' => '#TutorialForm_content'),
    array('type'=>'submit', 'id'=>'ajaxButton')
);
echo CHtml::endForm();
echo CHtml::closeTag('div');

$scriptUrl =  CHtml::asset(Yii::getPathOfAlias('application.modules.editor.js'));
Yii::app()->clientScript->registerScriptFile($scriptUrl.'/ajaxButton.js');
?>
</div>


