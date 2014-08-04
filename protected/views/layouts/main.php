<?php ?>
<!DOCTYPE html>

<html>
<head>
    <meta charset=utf-8" />

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>

    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />

    <!-- foundation -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <?php
    Yii::app()->clientScript->registerCssFile(
        Yii::app()->assetManager->publish(
            Yii::getPathOfAlias('ext.yiifoundation.assets').'/css/normalize.css'
        ));
    ?>


    <?php
    Yii::app()->clientScript->registerCssFile(
        Yii::app()->assetManager->publish(
            Yii::getPathOfAlias('ext.yiifoundation.assets').'/css/foundation.css'
        ));
    ?><!-- foundation -->

    <!-- highlight -->
    <?php
    Yii::app()->clientScript->registerCssFile(
        Yii::app()->assetManager->publish(
            Yii::getPathOfAlias('ext.highlight.styles').'/monokai.css'
        ));
    ?><!-- highlight -->

</head>

<body>

<div class="container" id="page">

    <?php include_once("mainmenu.php"); ?>

    <?php echo $content; ?>

</div><!-- page -->

<!-- foundation -->
<?php
Yii::app()->clientScript->registerScriptFile(
    Yii::app()->assetManager->publish(
        Yii::getPathOfAlias('ext.yiifoundation.assets').'/js/vendor/jquery.js'
    ));
?>
<?php
Yii::app()->clientScript->registerScriptFile(
    Yii::app()->assetManager->publish(
        Yii::getPathOfAlias('ext.yiifoundation.assets').'/js/foundation.min.js'
    ));
?>

<!-- highlight -->
<?php
Yii::app()->clientScript->registerScriptFile(
    Yii::app()->assetManager->publish(
        Yii::getPathOfAlias('ext.highlight').'/highlight.pack.js'
    ));
?><!-- highlight -->


<script type="text/javascript">
    $(document).foundation();
    hljs.initHighlightingOnLoad();
</script> <!-- foundation -->

</body>
</html>