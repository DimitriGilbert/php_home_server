<?php

/**
* 
*/
class Library
{
	/**
	*
	*/
	static public function cache_dir($dir, $config)
	{
		$cache=array(
			'video'=>array(),
			'music'=>array()
		);
		$a_dir=scandir($dir);
		foreach ($a_dir as $d)
		{
			//
			if (!in_array($d, array('.', '..')))
			{
				//
				if (is_dir($dir.'/'.$d))
				{
					// recursive call to go through directories.
					$tmpc=self::cache_dir($dir.'/'.$d, $config);

					// of course we want to grab the fracking data we gathered !
					$cache['music']=array_merge($cache['music'], $tmpc['music']);
					$cache['video']=array_merge($cache['video'], $tmpc['video']);
				}
				else
				{
					// ASL ? #caramail_style
					$info=pathinfo($dir.'/'.$d);
					
					// oh, so you are a video, nice !
					if (in_array($info['extension'], $config['extensions']['video']))
					{
						$cache['video'][$info['filename']]=str_replace($config['base_path'], $config['base_url'], $dir.'/'.$d);
					}
					
					// you damn audio file are so mean with me....
					if (in_array($info['extension'], $config['extensions']['music']))
					{
						$cache['music'][$info['filename']]=str_replace($config['base_path'], $config['base_url'], $dir.'/'.$d);
					}
				}
			}
		}

		return $cache;
	}
}

?>