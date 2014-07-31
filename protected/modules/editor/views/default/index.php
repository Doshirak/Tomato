<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	$this->module->id,
);
?>

<?php
echo CHtml::beginForm();
$this->widget('application.modules.editor.extensions.eckeditor.ECKEditor', array(
    'model'=>$form,
    'attribute'=>'content',
    'config' => array(
        'codeSnippet_theme'=>'monokai',
//        'toolbar'=>array(
//            array( 'Save'),
//            array( 'Bold', 'Italic', 'Image', 'Link', 'Unlink', ),
//            array('CodeSnippet'),
//        ),
    ),
));
echo CHtml::endForm();
?>