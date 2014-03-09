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
				// print_r($d);
				//
				if (is_dir($dir.'/'.$d))
				{
					$tmpc=self::cache_dir($dir.'/'.$d, $config);
					// $cache['music']=array_merge($cache['music'], $tmpc['music']);
					$cache['video']=array_merge($cache['video'], $tmpc['video']);
				}
				else
				{
					$info=pathinfo($dir.'/'.$d);
					
					if (in_array($info['extension'], $config['extensions']['video']))
					{
						$cache['video'][$info['filename']]=str_replace($config['base_path'], $config['base_url'], $dir.'/'.$d);
					}
					
					if (in_array($info['extension'], $config['extensions']['music']))
					{
						$cache['music'][$info['filename']]=str_replace($config['base_path'], $config['base_url'], $dir.'/'.$d);
					}
				}
			}
		}
		// $cache=json_encode($cache);
		return $cache;
	}
}

?>