<?
session_start();
/* SSL Management */
$useSSL = true;
include(dirname(__FILE__) . '/../../config/config.inc.php');
include(dirname(__FILE__) . '/../../init.php');
require_once(dirname(__FILE__) . '/../../fb/src/facebook.php');
include_once(dirname(__FILE__) . '/../../log/log.php');

/***************************  draw  *********************/
if($_POST['draw'])
{
	echo '9';
	exit;
	if ($cookie->isLogged()){
		if(empty($cookie->email))
			die('2');
	}else
		die('');

	if(empty($cookie->id_customer))
		die('');
	$memcache && $today_wined = $memcache->get('today_wined'.$cookie->id_customer);
	if(empty($today_wined)){
		$result = Db::getInstance()->getRow("
			SELECT win_credits
			FROM 0_monster_winner
			WHERE customer_id='".$cookie->id_customer."' and add_date='".date('Y-m-d')."'",false);
		if(empty($result)){
			$memcache && $memcache->set('today_wined'.$cookie->id_customer,'n',600);
			$today_wined = 'n';
		}else{
			$_SESSION['win_credits'] = $result['win_credits'];
			$memcache && $memcache->set('today_wined'.$cookie->id_customer,'y',600);
			$today_wined = 'y';
		}
	}
	if($today_wined == 'y')
	{
		if(!isset($_SESSION['creditBalance'])){
			$result = Db::getInstance()->getRow("
				SELECT creditBalance
				FROM ps_customer
				WHERE id_customer='".$cookie->id_customer."'",false);
			$_SESSION['creditBalance'] = floatval($result['creditBalance']);
		}
		if(!isset($_SESSION['win_credits'])){
			$result = Db::getInstance()->getRow("
				SELECT win_credits
				FROM 0_monster_winner
				WHERE customer_id='".$cookie->id_customer."' and add_date='".date('Y-m-d')."'",false);
			$_SESSION['win_credits'] = $result['win_credits'];
		}
		die('One day one prize only.<br><br>You have won $'.$_SESSION['win_credits'].' credits today. You have $'.$_SESSION['creditBalance'].' credits currently. The credits you won expires on August 31st. <a href="http://www.uniwigs.com">Shop now</a>!  Don\'t forget to come back tomorrow.');
	}

	$memcache && $win_count = $memcache->get('win_count'.$cookie->id_customer);
	if(empty($win_count) && $win_count!=='0'){
		$result = Db::getInstance()->getRow("
			SELECT count(*) cnt
			FROM 0_monster_winner
			WHERE customer_id='".$cookie->id_customer."'",false);
		$win_count = $result['cnt'];
		$memcache && $memcache->set('today_wined'.$cookie->id_customer,$win_count,600);
	}

	$rand = 2560 * pow(2,intval($win_count));
	$aryProbability = array('1'=>64, '2'=>32, '5'=>16, '10'=>8/*, '100'=>2, '500'=>1*/);
	$multiple = 1;

	if($_POST['c'] >= 2 && $_POST['c'] <=4){
		$multiple = 2;
	}elseif($_POST['c'] >= 5 && $_POST['c'] <=9){
		$multiple = 4;
	}elseif($_POST['c'] >= 10){
		$multiple = 4;
	}else{
		$multiple = 1;
	}

	$draw = rand(1,$rand/$multiple);
	$probability = 0;
	$hit = 0;
	foreach($aryProbability as $key=>$value)
	{
		$probability += $value;
		if($draw <= $probability){
			$hit = $key;
			break;
		}
	}

	$aryMiss = array('Sorry, You won nothing. Have a rest and try again later.','You almost won it, come on!','A prize is about to be brought out, fighting!','You missed it. Have a rest and try again.');
	if($hit > 0)
		draw_hit($hit);
	else{
		if($multiple == 1)
			echo 'You missed it. You are so gentle, beat it fiercely.';
		else
			echo $aryMiss[rand(0,3)];
	}

	//*******************************/
	$rand = 2560 * 4;
	$aryProbability = array(/*'2'=>32, '5'=>32, */'10'=>16, '100'=>8, '500'=>2);
	$multiple = 1;

	$draw = rand(1,$rand/$multiple);
	$probability = 0;
	$hit = 0;
	foreach($aryProbability as $key=>$value)
	{
		$probability += $value;
		if($draw <= $probability){
			$hit = $key;
			break;
		}
	}
	if($hit > 0)
		draw_hit($hit,true);

	exit;
}

/***************************  invite customer  *********************/
if($_GET['ci']){
	if($cookie->isLogged())
		insert_invite();
	else
		$_SESSION['ci'] = $_GET['ci'];
}
if($_SESSION['ci'] && $cookie->isLogged()){
	insert_invite();
	unset($_SESSION['ci']);
}

function insert_invite()
{
	global $cookie;
	if($_GET['ci'])
		$ci = $_GET['ci'];
	else
		$ci = $_SESSION['ci'];
	if($_SESSION['beinvited']!='1'){
		$ci = base64_decode($ci);
		$result = Db::getInstance()->getRow("
			SELECT id
			FROM 0_monster_invite
			WHERE customer_id='".$ci."'",false);
		if(empty($result)){
			Db::getInstance()->Execute("insert into 0_monster_invite(customer_id,invite_cus_id,add_date)
			values('".$cookie->id_customer."','".$ci."','".date('Y-m-d H:i:s')."')");
		}
		$_SESSION['beinvited'] = '1';
	}
}

function draw_hit($intHit=0,$jshow=false)
{
	global $cookie;
	if($jshow){
		Db::getInstance()->Execute("insert into 0_monster_winner(customer_id,email,win_credits, add_date)
			values('-1','".readable_random_string(rand(6,10))."@gmail.com','".$intHit."','".date('Y-m-d')."')");
	}elseif($intHit>0 && $cookie->id_customer){
		//if($intHit==100 && $_POST['c']<10)
			//$intHit = 20;
		$memcache && $memcache->set('today_wined'.$cookie->id_customer,'y',600);
		Db::getInstance()->Execute("insert into 0_monster_winner(customer_id,email,win_credits, add_date)
			values('".$cookie->id_customer."','".$cookie->email."','".$intHit."','".date('Y-m-d')."')");
        $temp="";
		$result = Db::getInstance()->getRow("
			SELECT creditBalance,isblogger
			FROM ps_customer
			WHERE id_customer='".$cookie->id_customer."'",false);
		$_SESSION['creditBalance'] = floatval($result['creditBalance']);
		if($result['isblogger']=='2'){
			Db::getInstance()->Execute("insert into ps_creditlog(`flag`,`from`,`to`,`amount`,`remark`,`send`,`logtime`,`sendtime`)
				values('17','0','".$cookie->id_customer."','".$intHit."','12720打怪赢积分','0','".date('Y-m-d H:i:s')."','0')");
				$temp='<br/><br/>Cash credits you won will be funded to your account next time we renew credits to your account to avoid being zeroed.';
		}else{
			Db::getInstance()->Execute("insert into ps_creditlog(`flag`,`from`,`to`,`amount`,`remark`,`send`,`logtime`,`sendtime`)
				values('17','0','".$cookie->id_customer."','".$intHit."','12720打怪赢积分','1','".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."')");
			Db::getInstance()->Execute("update ps_customer set creditBalance=creditBalance+".$intHit." where id_customer='".$cookie->id_customer."'");
			$_SESSION['creditBalance'] += $intHit;
		}

		echo 'Congratulations, you won $'.$intHit.' credits. You have $'.$_SESSION['creditBalance'].' credits currently. The credits you won expires on August 31st. <a href="http://www.uniwigs.com">Shop now</a>! Don\'t forget to come back tomorrow.'.$temp;
	}
}
function readable_random_string($length = 6){
	$conso=array("b","c","d","f","g","h","j","k","l",
	"m","n","p","r","s","t","v","w","x","y","z");
	$vocal=array("a","e","i","o","u");
	$str="";
	srand ((double)microtime()*1000000);
	$max = $length/2;
	for($i=1; $i<=$max; $i++)
	{
		$str.=$conso[rand(0,19)];
		$str.=$vocal[rand(0,4)];
	}
	return $str;
}
$base64_cusid = ($cookie->id_customer?base64_encode($cookie->id_customer):base64_encode(0));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="description" content="Share the giveaway through facebook, twitter, blog, forums or anywhere available. Enter Oasap $200,000 giveaway to win $500 cash credits for shopping at oasap.com, giveaway link: Copy and paste the sentence in above box, and share it through your facebook, twitter, blog or any other sites (forums) you can reach to. We can track it once people enter the giveaway through your link." />
<meta name="keywords" content="oasap giveaway, oasap free credits, oasap coupon,oasap Promotional Codes" />
<meta name="title" content="OASAP Giveaway day - Get free $200,000 cash credits." />
<title>OASAP Giveaway day - Get free $200,000 cash credits.</title>
<meta http-equiv="Content-Language" content="en"/>
<link type="text/css" rel="stylesheet" media="screen" href="images/global.css">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js"></script>
<script type="text/javascript" src="/themes/oasap/js/google.js"></script>
<link type="text/css" rel="stylesheet" media="screen" href="/themes/oasap/css/showorder.css">
<meta property="og:title" content="It's great, beat the Monster to win cash credits every day. Come on, xoxo!" />
<meta property="og:description" content="It's great, beat the Monster to win cash credits every day. Come on, xoxo!" />
<meta name="medium" content="image" />
<meta property="og:image" content="http://www.uniwigs.com/campaign/monster/images/monsterad.gif" />
<style>
#atcode textarea {
    background: none repeat scroll 0 0 #FCF8E3;
    font-size: 13px;
    margin: 10px 0;
	width:335px;
	height:85px;
}
input[type="text"], input[type="password"], textarea {
    border: 1px solid #CCCCCC;
    border-radius: 4px 4px 4px 4px;
    box-shadow: 0 3px 5px rgba(0, 0, 0, 0.05) inset;
    line-height: 1.5em;
    outline: medium none;
    padding: 4px;
}
a {
text-decoration: underline;
}
#winner{ overflow:hidden; height:186px;}
.top_alert{width:100%;background-color:#fff8e4;border:#ffae00 1px solid;font-size:12px;text-align:center;}
#oNo_Script{display:none;}
</style>

</head>
<body>
<noscript><div class="top_alert">Your browser does not support Javascript temporarily, this will cause some function can't be used normally. In order to obtain a better experience, suggest you open the browser Javascript support.</div></noscript><div id="oNo_Script" class="top_alert"></div>
<script>
if(document.cookie=='') {
	$("#oNo_Script").html('Your browser does not support Cookie temporarily, this will cause some function can\'t be used normally. In order to obtain a better experience, suggest you open the browser Cookie support.');
	$("#oNo_Script").css('display','block');}
</script>
<!--[if lt IE 7]>
<script src="/themes/oasap/js/killie6-en.js"></script>
<![endif]-->
<div class="wrapper">
    <div class="W_main">
      <div class="ignous">
        <div style="overflow:hidden;width:100%;text-align:center">
          <img src="images/hot-products.gif" width="990" height="99" border="0" usemap="#Map"/>
          <map name="Map" id="Map">
            <area shape="rect" coords="316,4,411,99" href="http://www.uniwigs.com/handbags/5062-rivet-detail-metal-corner-boston-bag.html" />
            <area shape="rect" coords="423,5,518,96" href="http://www.uniwigs.com/jumpers-cardigans/432-nordic-print-oversized-knitted-jumper.html" />
            <area shape="rect" coords="526,3,617,101" href="http://www.uniwigs.com/shirts-blouses/8440-american-national-flat-long-sleeve-blouse.html" />
            <area shape="rect" coords="631,5,735,97" href="http://www.uniwigs.com/shoulder-bags/8487-oversized-simple-envelope-clutch-bag.html" />
            <area shape="rect" coords="744,4,840,97" href="http://www.uniwigs.com/skirts/12241-pure-colored-elastic-waist-pleated-chiffon-skirt.html" />
			<area shape="rect" coords="848,5,987,97" href="http://www.uniwigs.com" />
          </map>
        </div>
        <div class="ign_head">
<object id="moster" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase=" http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="990" height="720">
<param name="wmode" value="transparent">
<param name="movie" value="images/monster.swf" />
<param name="quality" value="high" />
<embed name="moster" src="images/monster.swf" wmode="transparent" quality="high" pluginspage=" http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="990" height="720"></embed>
</object>
<a href="http://www.uniwigs.com" target="_blank" title="Oasap high street fashion"><div class="logo"></div></a>
          <div class="coupon_num_box">
		  <?
			/*$result = Db::getInstance()->getRow("
			SELECT sum(win_credits) total
			FROM 0_monster_winner");
			$remain = 150000 - $result['total']+41785;*/
			$remain = 0;
		  ?>
            <span class="coupon_num"><?=number_format($remain)?></span>
          </div>
          <div class="coupon_winner">
            <div class="coupon_winner_bolder">
              <div class="coupon_winner-title">Winners List</div>
              <div class="coupon_winner_box coupon_winner_bolder_max">
                <ul style="margin-top: 0px;" id="winner">
				<?
				$result = Db::getInstance()->ExecuteS('SELECT * from 0_monster_winner order by id desc limit 100');
				foreach($result as $key=>$value)
				{
					echo '<li>'.substr($value['email'],0,3).'***@**'.substr($value['email'],-4).' Won $'.$value['win_credits'].'</li>';
				}
				?>
                </ul>
              </div>
            </div>
            <a id="myCoupon" class="myCoupon" href="https://www.uniwigs.com/my-creditBalance.php" target="_blank"></a>
            <!--a id="myCoupon" class="Coupon" href="#"></a-->
          </div>
          	<?
			if ($cookie->isLogged())
				echo '<div class="sm"></div>';
			else
				echo '<a href="javascript:showUpload(\'\');"><div class="sm"></div></a>';
			?>
          <a href="javascript:showUpload('1');"><div class="give"></div></a>
          <a class="rule" href="detail.html"></a>
          <?if($remain>0){
              echo '
		  <div class="award_btn award_btn3" style="left: 700px; top: 250px;" onmousedown="javascript:this.style.backgroundPosition= \'-112px 0\';heat();" onmouseup="javascript:this.style.backgroundPosition= \'0 0\';"></div>';
			}else{
              echo '
		  <div class="award_btn award_btn3" style="left: 700px; top: 250px;background-position:-224px 0;" onclick="showUpload(9);return false;"></div>';
			}
          ?>
          <div class="moster"></div>
        </div>
      </div>
    </div>
  </div>
<div id="wrapper" class="show_order" style="display: hidden; ">
    <div class="container">
      <div class="order">
        <div class="close"><img src="/themes/oasap/images/giveaway-close.jpg" align="right" border="0" height="50px" width="50px" onclick="hideUpload();return false"></div>
        <div class="order-title">
          NOTICE:
        </div>
        <div class="order-right">
          <div class="order-right-title" style="text-transform:none;height:200px;font-size:14px;" id="showmsg"></div>
        </div>
        <div class="order-left">
		<div style="font-size:14px;font-weight:bold;margin:6px;">Share the giveaway by any of following ways to win $200 credits. More shares, more chances!</div>
          <div>
	<div class="addthis_toolbox addthis_default_style  addthis_32x32_style" style="margin:0 0 4px 0;"
		addthis:url="http://www.uniwigs.com/campaign/monster/?ci=<?=$base64_cusid?>"
		addthis:title="It's great, beat the Monster to win cash credits every day. Come on, xoxo!"
		addthis:description="It's great, beat the Monster to win cash credits every day. Come on, xoxo!">
		<a class="addthis_button_preferred_1"></a>
		<a class="addthis_button_preferred_2"></a>
		<a class="addthis_button_preferred_3"></a>
		<a class="addthis_button_preferred_4"></a>
		<a class="addthis_button_compact"></a>
		<br>
		<br>
	<a class="addthis_button_tweet" tw:count="none"></a>
	<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
	<a class="addthis_button_pinterest_pinit" pi:pinit:media="http://www.uniwigs.com/campaign/monster/images/monsterad.gif" pi:pinit:layout="horizontal"></a>
	<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=ra-4d9d609c6bb4b04f"></script>
</div>
          <div id="atcode">
		  <textarea class="order-right-description" onfocus="this.select();" onclick="this.select();">It's great, beat the Monster to win cash credits every day. Come on, xoxo! http://www.uniwigs.com/campaign/monster/?ci=<?=$base64_cusid?></textarea></div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
function  get_flash_object(movieName){
	if (window.document[movieName])  {
	  return window.document[movieName];
	}
	if (navigator.appName.indexOf("Microsoft Internet")==-1){
	  if (document.embeds && document.embeds[movieName])
		return document.embeds[movieName];
	}
	else if (navigator.appName.indexOf("Microsoft Internet")!=-1){
	  return document.getElementByIdx_x(movieName);
	}
}
var c = 0;
var timer;
function heat(){
	<?
	if ($cookie->isLogged()){
		if(empty($cookie->email)){
			echo 'showUpload(2);return;';
		}
	?>
	var mc = get_flash_object("moster");
	mc.Play();
	c = c + 1;
	clearTimeout(timer);
	timer = setTimeout("draw("+c+")",500);
	<?
	}else{
	?>
		showUpload('');
	<?}?>
}
function draw(c)
{
	$.ajax({
	type: "POST",
	url: "./",
	data: "draw=1&c="+c,
	success: function(msg){
		showUpload( msg );
	}
});
}
function showUpload(msg){
	c = 0;
	if(msg=='')
		msg='<div>Please <a href="https://www.uniwigs.com/signin?back=http://www.uniwigs.com/campaign/monster/">LOGIN</a> your account to beat the Monster and win cash credits, No account yet? <a href="https://www.uniwigs.com/signup?back=http://www.uniwigs.com/campaign/monster/">REGISTER</a> in 5 seconds.</div>';
	else if(msg=='2')
		msg='<div>Please complete <a href="https://www.uniwigs.com/my-account.php">YOUR PROFILE</a> to beat the Monster and win cash credits.</div>';
	else if(msg=='1')
		msg = 'Share the giveaway by any of ways to win $200 credits.<br><br> More shares, more chances!';
	else if(msg=='9')
		msg = 'Thank you for taking part in "Beat the Monster" giveaway. It ended as $150,000 credits has been beated away. Oasap will run more campaigns to reward you in future.';
	$("#showmsg").html(msg);
	$("body").addClass("noscroll");
	$("#wrapper").show();
}
function hideUpload(){
	$("#show_order_detail").val("");
	$("body").removeClass("noscroll");
	$(".show_order").hide();
	$("#wrapper-done").remove();
	$(".order-right-preview").attr("src","");
}

//winner roll
var scrollnews = document.getElementById('winner');
var lis = scrollnews.getElementsByTagName('li');
var ml = 0;
var timer1 = setInterval(function(){
    var liHeight = lis[0].offsetHeight;
    var timer2 = setInterval(function(){
     scrollnews.scrollTop = (++ml);
     if(ml == liHeight){
        clearInterval(timer2);
        scrollnews.scrollTop = 0;
        ml = 0;
        lis[0].parentNode.appendChild(lis[0]);
     }
  },10);
},2000);

</script>
</body>
</html>
