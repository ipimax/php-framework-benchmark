<?php
	
if (isset($_GET['debug'])) {
    xhprof_enable(XHPROF_FLAGS_CPU + XHPROF_FLAGS_MEMORY);
}
// System Start Time
define('START_TIME', microtime(true));
// System Start Memory
define('START_MEMORY_USAGE', memory_get_usage());

/**
 * Laravel - A PHP Framework For Web Artisans
 *
 * @package  Laravel
 * @author   Taylor Otwell <taylorotwell@gmail.com>
 */

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader
| for our application. We just need to utilize it! We'll require it
| into the script here so that we do not have to worry about the
| loading of any our classes "manually". Feels great to relax.
|
*/

require __DIR__.'/../bootstrap/autoload.php';

/*
|--------------------------------------------------------------------------
| Turn On The Lights
|--------------------------------------------------------------------------
|
| We need to illuminate PHP development, so let's turn on the lights.
| This bootstraps the framework and gets it ready for use, then it
| will load up this application so that we can run it and send
| the responses back to the browser and delight these users.
|
*/

$app = require_once __DIR__.'/../bootstrap/start.php';

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application, we can simply call the run method,
| which will execute the request and send the response back to
| the client's browser allowing them to enjoy the creative
| and wonderful application we have whipped up for them.
|
*/

$app->run();




if (isset($_GET['debug'])) {

	$xhprof_data = xhprof_disable();
	echo "Page rendered in <b>"
	    . round((microtime(true) - START_TIME), 5) * 1000 ." ms</b>, taking <b>"
	    . round((memory_get_usage() - START_MEMORY_USAGE) / 1024, 2) ." KB</b>";
	$f = get_included_files();
	echo ", include files: ".count($f);

	$XHPROF_ROOT = realpath(dirname(__FILE__) .'/../..');
	include_once $XHPROF_ROOT . "/xhprof/xhprof_lib/utils/xhprof_lib.php";
	include_once $XHPROF_ROOT . "/xhprof/xhprof_lib/utils/xhprof_runs.php";

	// save raw data for this profiler run using default
	// implementation of iXHProfRuns.
	$xhprof_runs = new XHProfRuns_Default();

	// save the run under a namespace "xhprof_foo"
	$run_id = $xhprof_runs->save_run($xhprof_data, "xhprof_foo");

	echo ", xhprof <a href=\"http://xhprof.pfb.example.com/xhprof_html/index.php?run=$run_id&source=xhprof_foo\">url</a>";
}