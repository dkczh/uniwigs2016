<?php
if (isset($_GET["id"]) && $_GET["id"]) {
	$id = $_GET["id"];
	echo '
	<script type="text/javascript">
	window.onload = function(){
		//var url = window.location.href;
		var paramstr = window.location.search;
		if (paramstr) paramstr = paramstr.substring(1);
		if(paramstr && paramstr.indexOf("msg=1") > -1){
			var datastr = location.hash;
			if(datastr.length > 1){
				datastr = datastr.substring(1);
			}

			window.parent.parent.reciveMsg_'.$id.'(datastr);
			//window.location.href = "'.   /*$iframe_msg_url*/''   .'";
		}
	}
	</script>
	';
}