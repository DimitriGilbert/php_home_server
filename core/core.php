<?php
// because i find it cool to see how little time it takes to process things :)
$exec_start=microtime(true);

// including the core class
include_once __DIR__.'/classes/helpers/core.php';

// instantiating the core class, duh !
$core=new Core();

// routing the request
$core->route();

// if ($this->core->config['core']['debug'])
// {
// $debug='
// <div class="debug" id="debug">
// <div class="trace" style="display:none">
// '.implode('<br />', $core->_debug).'
// </div>
// <div class="ressource">
// execution time : '.((microtime(true)-$exec_start)/1000).'s <br />
// memory : '.(memory_get_usage(true)/1024/1024).' Mo
// </div>
// </div>';

// }