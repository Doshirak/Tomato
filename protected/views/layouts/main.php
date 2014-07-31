<?php ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/protected/extensions/yiifoundation/assets/css/foundation.css" />
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div>
    <?php
    echo foundation\widgets\TopBar::display(array(
            'title' => '<h1><a href="#">Tomato</a></h1>',
        )
    );
    ?>
</div>

<?php echo $content; ?>

</body>
</html>
