<?php
/**
 * Lithium: the most rad php framework
 *
 * @copyright     Copyright 2016, Union of RAD (http://union-of-rad.org)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */
?>
<!doctype html>
<?php 
	$mtime = microtime();
	$mtime = explode(" ",$mtime);
	$mtime = $mtime[1] + $mtime[0];
	$pagestarttime = $mtime; 

?>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="keywords" content="<?php if(isset($keywords)){echo $keywords;} ?>">	
	<meta name="description" content="<?php if(isset($description)){echo $description;} ?>">		
	<meta name="author" content="Nilam Doctor">
	<link rel="shortcut icon" href="/img/logo-IndianEagles.ico" /> 
	<title><?php echo MAIN_TITLE;?><?php if(isset($title)){echo $title;} ?></title>
	<!-- Bootstrap Core CSS -->
	<link href="/bootstrap/css/bootstrap.css" rel="stylesheet">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	<link href="/bootstrap/css/default.css" rel="stylesheet">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/css?family=Baloo+Bhai|Oswald" rel="stylesheet"> 
	<script src="/js/jquery.js"></script>
	<script src="/js/main.js"></script>
	<style>
	.oswald {font-family: 'Oswald', sans-serif;}
	</style>
	<script src="/bootstrap/js/bootstrap.min.js"></script>	
	<?php echo $this->scripts(); ?>
	<?php echo $this->styles(); ?>
	<?php echo $this->html->link('Icon', null, array('type' => 'icon')); ?>
</head>
 <body>
  <div class="container">

		<?php echo $this->_render('element', 'header');?>	
		<div class="content">
			<?php echo $this->content(); ?>
		</div>

		<hr>
		</div>
<?php 
	$mtime = microtime();
	$mtime = explode(" ",$mtime);
	$mtime = $mtime[1] + $mtime[0];
	$pageendtime = $mtime;
	$pagetotaltime = ($pageendtime - $pagestarttime);
?>
		<div class="footer">
		<?php echo $this->_render('element', 'footer', compact('pagetotaltime'));?>	
		</div>

<script src="/js/jquery-ui.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(function() {
	$( "#dateofbirth" ).datepicker({
      changeMonth: true,
      changeYear: true,
						dateFormat: 'yy-mm-dd',
						inline: false,
						yearRange: "-100:+0",
 });
		$( "#DateJoin" ).datepicker({
      changeMonth: true,
      changeYear: true,
						dateFormat: 'yy-mm-dd',
						inline: false,
						yearRange: "-100:+0",
 });
});
</script>

</body>
</html>
