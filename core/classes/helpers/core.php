<?php

/**
* 
*/
class Core
{
	public $config, $_debug, $request;

	function __construct()
	{
		// loading core config
		$this->config=array(
			'core' => json_decode(file_get_contents(__DIR__.'/../../config/core.json'), 1)
		);
		// telling the world what is going on here
		$this->debug('core config loaded', __FILE__);

		// initializing debug stack
		$this->_debug=array();

		// initializing request with default value
		// TODO : put that in a config
		$this->request=array(
			'controller'=>'index',
			'action'=>'index',
			'instance'=>null
		);

		// loading the main classes
		// TODO : put that in a config
		$this->load_class('controllers/controller');
		$this->load_class('helpers/view')
	}

	/**
	*
	*/
	public function load_config($file)
	{
		// does your bloody file exists ?
		if (is_file($this->config['core']['path'].'config/'.$file.'.json'))
		{
			$this->config[$file]=json_decode(file_get_contents($this->config['core']['path'].'config/'.$file.'.json'), 1);
			$this->debug($file.' config has been loaded');
		}
		else
		{
			// you morron are trying to load a ghost file... try again !
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
	* because dealing with your ex is always painful !
	*/
	static public function ex($ex)
	{
		throw new Exception($ex);
	}

	/**
	* you want to say something ? do it with that baby ;)
	*/
	public function debug($str, $file = false)
	{
		// i'm damn lazy so i don't do something if i don't bloody have to !
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
	* take right, then left, left again, straight for a 100m and the right, you should be there...or not ;)
	*/
	public function route()
	{
		// who wants to be loaded ? there won't be room for every controller out here !
		// TODO : put which parameter contains the controller name in a config
		if (isset($_GET['c']))
		{
			$this->request['controller']=$_GET['c'];
		}

		// so i know who i load (look up !), now i want to know what i do with him !
		// TODO : put which parameter contains the action name in a config
		if (isset($_GET['a']))
		{
			$this->request['action']=$_GET['a'];
		}

		// is our controller out there ?
		if (is_file($this->config['core']['path'].'classes/controllers/'.$this->request['controller'].'.php'))
		{
			// yeaaah, his here, let's load this litle bastard !
			include_once $this->config['core']['path'].'classes/controllers/'.$this->request['controller'].'.php';
			$ctr='Controller_'.ucfirst($this->request['controller']);
			$this->request['instance']=new $ctr;
			$this->debug('Controller '.$this->request['controller'].' has been loaded');
			// so he is among us now, but can he do what you want him to do ?
			if (method_exists($this->request['instance'], 'action_'.$this->request['action']))
			{
				// obviouly your little guy can do what you want so lets make it happen :D
				$met='action_'.$this->request['action'];
				$this->debug('executing Controller_'.ucfirst($this->request['controller']).'::'.$met);

				$this->request['instance']->$met();
			}
			else
			{
				// same player play again, but next time make sure you don't mess up !
				$this->ex('Controller '.$this->request['controller'].' does not have action '.$this->request['action']);
			}
			
		}
		else
		{
			// you forgot the name of your controller...deal with your ex !
			$this->ex('Controller '.$this->config['core']['path'].'classes/controllers/'.$this->request['controller'].'.php does not exist');
		}
	}
}
?>