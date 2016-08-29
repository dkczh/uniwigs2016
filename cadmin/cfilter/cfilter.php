<?php
require ('../include/init.inc.php');
$method = $user_id = $page_no = '';
extract ( $_GET, EXTR_IF_EXISTS );

if(isset($_POST['fcategory'])){
	
	$res = Cfilter::getcQuery($_POST['fcategory'],$_POST['Scategory'],$_POST['cnum'],$_POST['camount'],$_POST['cstate']);
	if($res){
		$str= '';
		foreach($res as $a ){
				$str.= '<tr>';
				$str.=" <td>".$a['id_customer']."</td>";
				$str.=" <td><a href=\"/cadmin/cmanager/message.php?cid=".$a['id_customer']."\" target=\"_blank\">".$a['email']."</a></td>";
				$str.=" <td>".$a['camount']."</td>";
				$str.=" <td>".$a['cnum']."</td>";
				$str.=" <td>".$a['name']."</td>";
				$str.="</tr>";
		}

		echo $str;
	}else{
		
		echo '结果为空';
	}
	exit;	
	
}



	






$cstate = Cfilter::getcState();

Template::assign('cstate', $cstate);
Template::display('cfilter/cfilter.tpl');
