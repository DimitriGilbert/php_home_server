<?php

/**
* 
*/
class Controller
{
	public $config, $template;
	static $core;
	
	function __construct()
	{
		$this->core=$GLOBALS['core'];
		$this->template=array(
			'header'=>'header',
			'template'=>'template',
			'footer'=>'footer'
		);
		$this->template_var=array(
			'common'=>array(
				'base_url'=>$this->core->config['core']['base_url']
			),
			'header'=>array(),
			'template'=>array(),
			'footer'=>array()
		);

		$this->use_tpl=true;

		//
		if (is_array($this->config['config']))
		{
			$this->core->debug('Loading Controller_'.ucfirst($this->core->request['controller']).' configuration files...');
			foreach ($this->config['config'] as $v)
			{
				$this->core->load_config($v);
			}
		}

		//
		if (is_array($this->config['classes']))
		{
			$this->core->debug('Loading php file for Controller_'.ucfirst($this->core->request['controller']).'...');
			foreach ($this->config['classes'] as $v)
			{
				$this->core->load_class($v);
			}
		}
	}

	/**
	*
	*/
	public function render($file, $data)
	{
		$content=View::render($file, $data);
		//
		if ($this->use_tpl)
		{
			$header=View::render('header', array_merge($this->template_var['common'],$this->template_var['header']));
			$footer=View::render('footer', array_merge($this->template_var['common'],$this->template_var['footer']));
			
			$tpl_data=array(
				'__header__'=>$header,
				'__footer__'=>$footer,
				'__content__'=>$content
			);

			$tpl_data=array_merge($this->template_var['template'],$this->template_var['common'],$tpl_data);

			$display=View::render('template', $tpl_data);
		}
		else
		{
			$display=$content;
		}
		
		return $display;
	}

}
