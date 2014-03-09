<!DOCTYPE html>
<html>
	<head>
		<title>
			Raspberry Pi server <?php echo (isset($title)? '- '.$title:''); ?>
		</title>
		<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" />
	</head>
	<body>
		<?php
		//
		if (isset($__header__))
		{
			echo $__header__;
		}
		?>
		<div class="container">
			<?php
			//
			if (isset($__content__))
			{
				echo $__content__;
			}
			?>
		</div>
		<?php
		//
		if (isset($__footer__))
		{
			echo $__footer__;
		}
		?>
		<div>
			<script type="text/javascript">
			var base_url="<?php echo $base_url; ?>";
			</script>
			<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
			<script type="text/javascript" src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
			<script type="text/javascript" src="assets/js/main.js"></script>
		</div>
	</body>
</html>