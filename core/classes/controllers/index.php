<?php

/**
* 
*/
class Controller_Index extends Controller
{
	/**
	*
	*/
	public function __construct()
	{
		$this->config=array(
			'config'=>array(
				'library'
			),
			'classes'=>array(
				'helpers/library'
			)
		);
		parent::__construct();
	}

	/**
	*
	*/
	public function action_index()
	{
		//
		if (is_file($this->core->config['core']['path'].'data/library.cache.json'))
		{
			$cache=json_decode(file_get_contents($this->core->config['core']['path'].'data/library.cache.json'));
		}
		else
		{
			$cache=Library::cache_dir($this->core->config['library']['base_path'], $this->core->config['library']);
			file_put_contents($this->core->config['core']['path'].'data/library.cache.json', json_encode($cache));
		}
		
		echo $this->render('index/index', array('cache'=>$cache, 'config'=>$this->core->config));
	}

	/**
	*
	*/
	public function action_vlc()
	{
		header("Content-Type:application/xml");
		header('Content-Disposition: attachment; filename="playlist.xspf"');
		$this->use_tpl=false;
		echo $this->render('index/vlc', array('file'=>base64_decode($_GET['file'])));
	}

	/**
	*
	*/
	public function action_play()
	{
		echo $this->render('index/player', array(
			'type'=>$_GET['type'],
			'file'=>base64_decode($_GET['file'])
		));
	}

	/**
	*
	*/
	public function action_rescan()
	{
		$this->use_tpl=false;
		Library::cache_dir($this->core->config['library']['base_path'], $this->core->config['library']);
	}
}
