<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

<!--	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />-->
<!--	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />-->
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/official-style.css" />
        
        <?php Yii::app()->clientScript->registerScriptFile( Yii::app()->request->baseUrl . '/js/lib/jquery.js', CClientScript::POS_END ) ?>
        <?php Yii::app()->clientScript->registerScriptFile( Yii::app()->request->baseUrl . '/bootstrap/js/bootstrap.min.js', CClientScript::POS_END ) ?>
        <?php Yii::app()->clientScript->registerScriptFile( Yii::app()->request->baseUrl . '/js/main.js', CClientScript::POS_END ) ?>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">
    <div id="official-wrap">
      <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="navbar-inner">
          <div class="container">
             <a class="brand" href="#">Топ чиновник</a>       
          </div>
        </div>
      </div>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div class="official-footer">
            <hr />
            Copyright &copy;&nbsp; <?php echo date('Y'); echo Yii::t( 'application', 'VinSquirrels for OpenIdeas4UA' ); ?>  <br/>
            <?php echo Yii::powered(); ?>
	</div><!-- footer -->

    </div><!-- page -->

</body>
</html>
