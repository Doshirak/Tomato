<div class="browser">
<?php
if(isset($tutorials))
    foreach($tutorials as $val)
    {
        echo CHtml::beginForm(CHtml::normalizeUrl(Yii::app()->createUrl('/editor/main/edit', array('id'=>$val->tutorial_id))), "get");
            echo CHtml::tag('div', array('class'=>'title'),$val->title);
        echo CHtml::tag('div', array('class'=>'content'),$val->content);
        echo CHtml::submitButton('Edit');
        echo CHtml::endForm();
    }

echo CHtml::beginForm(Yii::app()->createUrl('/editor/main/new'));
echo CHtml::submitButton('New tutorial');
echo CHtml::endForm();

?>
</div>