<?php

/**
* 
*/
class Core
{
	public $config, $_debug, $request;

	function __construct()
	{
		$this->config=array(
			'core' => json_decode(file_get_contents(__DIR__.'/../../config/core.json'), 1)
		);
		$this->_debug=array();
		$this->request=array(
			'controller'=>'index',
			'action'=>'index',
			'instance'=>null
		);
		include_once $this->config['core']['path'].'classes/controllers/controller.php';

		$this->debug('core config loaded', __FILE__);
	}

	/**
	*
	*/
	public function load_config($file)
	{
		//
		if (is_file($this->config['core']['path'].'config/'.$file.'.json'))
		{
			$this->config[$file]=json_decode(file_get_contents($this->config['core']['path'].'config/'.$file.'.json'), 1);
			$this->debug($file.' config has been loaded');
		}
		else
		{
			$ex='Configuration file '.$this->config['core']['path'].'config/'.$file.'.json does not exist !';
			$this->ex($ex);
		}
	}

	/**
	*
	*/
	public function load_class($file)
	{
		//
		if (is_file($this->config['core']['path'].'classes/'.$file.'.php'))
		{
			include_once $this->config['core']['path'].'classes/'.$file.'.php';
			$this->debug($file.' file has been loaded');
		}
		else
		{
			$ex='PHP file '.$this->config['core']['path'].'classes/'.$file.'.php does not exist !';
			$this->ex($ex);
		}
	}

	/**
	*
	*/
	static public function ex($ex)
	{
		throw new Exception($ex);
	}

	/**
	*
	*/
	public function debug($str, $file = false)
	{
		// var_dump($this->config);
		//
		if ($this->config['core']['debug'])
		{
			//
			if ($file)
			{
				$str.='('.$file.')';
			}
			$this->_debug[]=$str;
		}
	}

	/**
	*
	*/
	public function route()
	{
		//
		if (isset($_GET['c']))
		{
			$this->request['controller']=$_GET['c'];
		}

		//
		if (isset($_GET['a']))
		{
			$this->request['action']=$_GET['a'];
		}

		//
		if (is_file($this->config['core']['path'].'classes/controllers/'.$this->request['controller'].'.php'))
		{
			include_once $this->config['core']['path'].'classes/controllers/'.$this->request['controller'].'.php';
			$ctr='Controller_'.ucfirst($this->request['controller']);
			$this->request['instance']=new $ctr;
			$this->debug('Controller '.$this->request['controller'].' has been loaded');
			//
			if (method_exists($this->request['instance'], 'action_'.$this->request['action']))
			{
				$met='action_'.$this->request['action'];
				$this->debug('executing Controller_'.ucfirst($this->request['controller']).'::'.$met);

				$this->request['instance']->$met();
			}
			else
			{
				$this->ex('Controller '.$this->request['controller'].' does not have action '.$this->request['action']);
			}
			
		}
		else
		{
			$this->ex('Controller '.$this->config['core']['path'].'classes/controllers/'.$this->request['controller'].'.php does not exist');
		}
	}
}
?>