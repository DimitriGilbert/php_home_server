<<?php
switch ($type) 
{
	case 'video':
		echo 'video width="240" height="180"';
		break;
	case 'music':
		echo 'audio';
		break;
}
?> controls>
  <source src="<?php echo $file; ?>">
Your browser does not support the video/audio tag.
</video> 