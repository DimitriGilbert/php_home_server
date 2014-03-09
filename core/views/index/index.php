<?php
foreach ($cache as $k => $v)
{
	?>
	<h2><?php echo $k;?></h2>
	<div id="<?php echo $k;?>_container">
		<?php
		foreach ($v as $item => $iv)
		{
			?>
			<div class="col-md-12">
				<div class="col-md-4">
					<div class="col-md-12">
					<?php echo $item; ?>
					</div>
					<div class="col-md-12">
					<?php 
					echo View::render('index/player', array(
						'type'=>$k,
						'file'=>$iv
					));
					?>
					</div>
				</div>
				<div class="col-md-4">
					<input onclick="this.select();" type="text" class="input input-lg" value="<?php echo $iv; ?>" />
				</div>
				<div class="col-md-4">
					<a class="btn btn-lg btn-primary" href="<?php echo $config['core']['base_url']; ?>?a=vlc&file=<?php echo base64_encode($iv); ?>">
						VLC
					</a>
					<a class="btn btn-lg btn-primary" href="<?php echo $config['core']['base_url']; ?>?a=play&type=<?php echo $k;?>&file=<?php echo base64_encode($iv); ?>">
						open
					</a>
				</div>
			</div>
			<?php
		}
		?>
	</div>
	<?php
}
?>