<?php
require ('../include/init.inc.php');
$method = $user_id = $page_no = '';
extract ( $_GET, EXTR_IF_EXISTS );

$user_info = UserSession::getSessionInfo ();
$actor =$user_info['user_name'];

//查看生产分配详情
if(isset($_GET['action']) &&$_GET['action']=='view'){


	$ccontent = Cpworker::getCporderContent($_GET['id_porder']);
	$worker = Cpworker::getCporderWorker();
	$chistory= Cpworker::getTaskHistoy($_GET['id_porder']);
/* 	echo '<pre>';
	var_dump($chistory);
	echo '</pre>';
	exit;  */
	
	
	Template::assign(
				array( 'ccontent'=>$ccontent,
				       'id_porder'=>$_GET['id_porder'],
					   'worker'=>$worker,
					   'number'=>$ccontent[0]['number'],
					   'num_use'=>$ccontent[0]['num_use'],
					   'chistory'=>$chistory
	
					) );


	Template::display('cpworker/cpworker_content.tpl');

	exit;
}



//查看员工任务详情
if(isset($_GET['action'])&&$_GET['action']=='viewworker'){
	
	
		$ctask = Cpworker::getWorkerTask($_GET['user_id']);
		$workername=Cpworker::getWorkerName($_GET['user_id']);
		$chistory =Cpworker::getWokerHistoy($_GET['user_id']);

		
		Template::assign(
				array( 'ctask'=>$ctask,
				       'worker_id'=>$_GET['user_id'],
					   'workername'=>$workername,
					   'num_use'=>$ccontent[0]['num_use'],
					   'chistory'=>$chistory
	
					) );


		Template::display('cpworker/cpworker_task.tpl');

	exit;
}


//分配任务
if(isset($_POST['action'])&&$_POST['action']=='task'){
	
	$workername=Cpworker::getWorkerName($_POST['worker']);

		
	Cpworker::addCporderTask($_POST['id_porder'],$_POST['worker'],$_POST['num'],$_POST['ccontent'],$_POST['state'],$_POST['note'],$_POST['date'],$actor ,$workername);
	echo 'success';
	
	
	exit;
}


//更新员工任务
if(isset($_POST['action'])&&$_POST['action']=='updtask'){
	
	$workername=Cpworker::getWorkerName($_POST['worker']);
	Cpworker::updWorkerTask($_POST['id_worker_order'],$_POST['id_porder'],$_POST['worker_level'],$workername,$_POST['worker'],$actor);
	
	echo 'success';
	
	
	exit;
}

