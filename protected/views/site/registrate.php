<?php if(Yii::app()->user->isGuest): ?>
<h1>Sign Up</h1>
    <div class="form">

        <?php
        $form = $this->beginWidget('CActiveForm',array(
            'id'=>'registrate-form',
            'enableAjaxValidation'=>true,
            'action'=>$this->createUrl('site/registrate'),
            'enableClientValidation'=>true,
        ));
        ?>

        <div class="row">
            <div class="large-6 columns">
                <p class="note">Fields with <span class="required">*</span> are required.</p>
            </div>
        </div>

        <div class="row">
            <div class="large-6 columns">
                <?php echo $form->errorSummary($model); ?>
            </div>
        </div>

        <div class="row">
            <div class="large-6 columns">
                <?php echo $form->labelEx($model,'username'); ?>
                <?php echo $form->textField($model,'username'); ?>
                <?php echo $form->error($model,'username'); ?>
            </div>
        </div>

        <div class="row">
            <div class="large-6 columns">
                <?php echo $form->labelEx($model,'email'); ?>
                <?php echo $form->textField($model,'email'); ?>
                <?php echo $form->error($model,'email'); ?>
            </div>
        </div>

        <div class="row">
            <div class="large-6 columns">
                <?php echo $form->labelEx($model,'password'); ?>
                <?php echo $form->textField($model,'password'); ?>
                <?php echo $form->error($model,'password'); ?>
            </div>
        </div>

        <div class="row">
            <div class="large-6 columns">
                <?php
                echo CHtml::ajaxSubmitButton('Sign Up',CHtml::normalizeUrl(array('site/registrate')),
                    array(
                        'dataType'=>'json',
                        'type'=>'post',
                        'success'=>'function(data)
                        {
                            if(data.status=="success")
                            {
                                window.location.replace("/site/index");
                            }
                            else
                            {
                                errors = $("#registrate-form .errorMessage");

                                $.each(errors, function(i, val){
                                    $(val).hide();
                                });

                                $.each(data, function(key, val)
                                {
                                    $("#registrate-form #"+key+"_em_").text(val);
                                    $("#registrate-form #"+key+"_em_").show();
                                });
                            }
                        }'
                    ));
                ?>
            </div>
        </div>

        <?php $this->endWidget(); ?>

    </div><!--form -->

    <p id="success"></p>

<?php else: ?>

    <div class="row">
        <div class="large-6 columns">
            <h1>You are loginned!</h1>
        </div>
    </div>

<?php endif; ?>