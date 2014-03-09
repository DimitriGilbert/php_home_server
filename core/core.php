<?php

$exec_start=microtime(true);

include_once __DIR__.'/classes/helpers/core.php';

$core=new Core();

include_once $core->config['core']['path'].'classes/helpers/view.php';

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