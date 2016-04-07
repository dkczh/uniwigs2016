<?php
$st_prof = false;
if(isset($_REQUEST['st']) and $_REQUEST['st'] == '13505150707'){
	$st_prof = true;
}

if($st_prof){
	xhprof_enable(XHPROF_FLAGS_CPU + XHPROF_FLAGS_MEMORY);
}

echo date('Y-m-d H:i:s');

if($st_prof){
	$data = xhprof_disable();
	include_once('xhprof_lib/utils/xhprof_lib.php');
	include_once('xhprof_lib/utils/xhprof_runs.php');

	$objXhprofRun = new XHProfRuns_Default();
	$run_id = $objXhprofRun->save_run($data, 'xhprof');
	var_dump($run_id);
}
