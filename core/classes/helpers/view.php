<?php

/**
* 
*/
class View
{
	
	/**
	* taken from fuelphp view classe
	*/
	static public function render($file, $data)
	{

		$clean_room = function($__file, array $__data)
		{
			global $core;
			extract($__data, EXTR_REFS);

			// Capture the view output
			ob_start();

			try
			{
				$core->debug('Rendering '.$core->config['core']['path'].'views/'.$__file.'.php with data : <pre>'.print_r($__data, 1).'</pre>');
				// Load the view within the current scope
				include $core->config['core']['path'].'views/'.$__file.'.php';
			}
			catch (\Exception $e)
			{
				// Delete the output buffer
				ob_end_clean();

				// Re-throw the exception
				throw $e;
			}

			// Get the captured output and close the buffer
			return ob_get_clean();
		};
		return $clean_room($file, $data);
	}
}

?>