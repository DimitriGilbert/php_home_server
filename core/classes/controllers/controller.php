<?php

/**
* 
*/
class Controller
{
	public $config, $template, $core;
	
	function __construct()
	{
		// yeah, yeah ... i know that's crappy but hey, i work only 10hrs !
		$this->core=$GLOBALS['core'];

		// it could be nice to actually display something for a change, init ?, so that tells you what to look for
		// TODO : put that in a config
		$this->template=array(
			'header'=>'header',
			'template'=>'template',
			'footer'=>'footer'
		);

		// because we all need some data, even templates !
		$this->template_var=array(
			// that is for every views of the template
			'common'=>array(
				'base_url'=>$this->core->config['core']['base_url']
			),
			// do i really need to explain those three ones ?
			'header'=>array(),
			'template'=>array(),
			'footer'=>array()
		);

		// because rest in sexy, but we also need good all fachion loading sometimes
		$this->use_tpl=true;

		// some needs more than others, in that case just tell what config to load
		if (is_array($this->config['config']))
		{
			$this->core->debug('Loading Controller_'.ucfirst($this->core->request['controller']).' configuration files...');
			foreach ($this->config['config'] as $v)
			{
				$this->core->load_config($v);
			}
		}

		// same as before, but with classes/function files
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
	* yep, it does just what it's called rendering the output of your controller action
	*/
	public function render($file, $data)
	{
		// we start with the main content
		$content=View::render($file, $data);
		
		// if we use the template...well, we have to render it to
		if ($this->use_tpl)
		{
			$header=View::render('header', array_merge($this->template_var['common'],$this->template_var['header']));
			$footer=View::render('footer', array_merge($this->template_var['common'],$this->template_var['footer']));
			
			// 
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
			// A POIIIIIIL le content !
			$display=$content;
		}
		
		// theres no point in doing something if we do not render it, don't you think ?
		return $display;
	}

}
