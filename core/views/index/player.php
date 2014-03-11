<<?php
// creating video or audio tag acoording to media type
switch ($type) 
{
	case 'video':
		//i should put that in a config
		echo 'video width="240" height="180"';
		break;
	case 'music':
		echo 'audio';
		break;
}
?> controls>
  <source src="<?php echo $file; ?>">
Your browser does not support the video/audio tag.
</<?php
switch ($type) 
{
	case 'video':
		echo 'video';
		break;
	case 'music':
		echo 'audio';
		break;
}
?>> 