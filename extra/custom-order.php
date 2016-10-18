<?php
/*
* 2007-2014 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Open Software License (OSL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/osl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2014 PrestaShop SA
*  @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/


require_once(dirname(__FILE__).'/../config/config.inc.php');

class CustomOrderController extends FrontController
{
	public $page_name = 'extra/custom-order';
	public $display_column_left = false;

	/**
	 * Set default medias for this controller
	 */
	public function setMedia()
	{
		parent::setMedia();
		// $this->addCSS(_THEME_CSS_DIR_.'addresses.css');
		// $this->addJS(_THEME_JS_DIR_.'tools.js'); // retro compat themes 1.5
	}

	/**
	 * Initialize addresses controller
	 * @see FrontController::init()
	 */
	public function init()
	{
		parent::init();

		// if (!Validate::isLoadedObject($this->context->customer))
		// 	die(Tools::displayError('The customer could not be found.'));
	}

	/**
	 * Assign template vars related to page content
	 * @see FrontController::initContent()
	 */
	public function initContent()
	{
		parent::initContent();

		if ($_FILES) {
			// var_dump($_FILES);
			// die();

			$max_size = 2*1024*1024;
			$postfixs = array('jpg','jpeg','png','gif');

			$return_struct = array(
			    'status'  => 0,
			    'code'    => 0,
			    'msg'     => '',
			    'content' => array(),
			);

			$uploads = array();
			$errors  = array();
			foreach ($_FILES as $index => $upload) {
			    if (!is_array($upload) OR $upload['error'] != UPLOAD_ERR_OK) {
					$errors[$index] = '<font color="red">'.strtr('Upload failed').'</font>'; continue;
			    }
			    if (!is_uploaded_file($upload['tmp_name'])) {
					$errors[$index] = '<font color="red">'.strtr('Upload failed').'</font>'; continue;
			    }
			    if ($max_size > 0 AND $upload['size'] > $max_size) {
					$errors[$index] = '<font color="red">'.strtr('File is too big').'</font>'; continue;
			    }
			    $postfix = strtolower(pathinfo($upload['name'], PATHINFO_EXTENSION));
			    if (!empty($postfixs) AND !in_array($postfix, $postfixs)) {
					$errors[$index] = '<font color="red">'.strtr('File format error').'</font>'; continue;
			    }
			    $uploads[] = array(
					'name' => $upload['name'],
					'extension' => $postfix,
					// 'mime_type' => File::mime_by_ext($postfix),
					'size' => $upload['size'],
					'tmp_name' => $upload['tmp_name'],
			    );
			}
			if (empty($errors)) {
				$subcat = 'custom_order' . DIRECTORY_SEPARATOR . strtr(date('Y-m-d-H', time()), '-', DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
				$fullcat = _PS_ROOT_DIR_ . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . $subcat;
				if (!is_dir($fullcat) AND !@mkdir($fullcat, 0777, TRUE)) {
					// throw new Exception_BES(__('Fail to establish upload directory'));
					die('Fail to establish upload directory');
				}
				foreach ($uploads as $upload) {
					$uniqid_str = uniqid();
					$destination = $uniqid_str . '.' . $upload['extension'];
					$destination_tiny = $uniqid_str . '_tiny_.' . $upload['extension'];
					if (@move_uploaded_file($upload['tmp_name'], $fullcat . $destination)) {
						$resize_result = ImageUtil::resize($fullcat . $destination, $fullcat . $destination_tiny, 0, 180);
						$content = array(
						    'name'        => $upload['name'],
						    'src'         => 'http://www.uniwigs.com/img/'.str_ireplace(DIRECTORY_SEPARATOR, "/", $subcat)
						    	.('success'==$resize_result ? $destination_tiny : $destination),
						);
						array_push($return_struct['content'], $content);
					}
				}
				$return_struct['status'] = 1;
			} else {
				$return_struct['msg'] = implode("<br/>", $errors);
			}
			echo '<script type="text/javascript">';
			echo 'if(typeof parent.submitUploadResult == "function"){';
			echo '    parent.submitUploadResult('. json_encode($return_struct) . ');';
			echo '}';
			echo '</script>';
			exit();
		}

		if ($_POST && isset($_POST['email_co']) && $_POST['email_co'])
		{
			function checkbox($arr)
			{
				$values = "";
				if (is_array($arr) && $arr) {
					$values = implode(" + ", $arr);
				}
				return $values;
			}

			$message = "Around Head: ".Tools::getValue('Cap-Around-Head','').Tools::getValue('Cap-Around-Head-System','')."<br />";
			$message .= "Front to Nape: ".Tools::getValue('Cap-Front-to-Nape','').Tools::getValue('Cap-Front-to-Nape-System','')."<br />";
			$message .= "Temple to Temple: ".Tools::getValue('Cap-Temple-to-Temple','').Tools::getValue('Cap-Temple-to-Temple-system','')."<br />";
			$message .= "Ear to Ear: ".Tools::getValue('Cap-Ear-to-Ear','').Tools::getValue('Cap-Ear-to-Ear-System','')."<br />";
			$message .= "Nape: ".Tools::getValue('Cap-Nape','').Tools::getValue('Cap-Nape-System','')."<br />";
			$message .= "Cap Type: ".Tools::getValue('Cap-Type','')."<br />";
			$message .= "Hair Texture: ".Tools::getValue('quality','')."<br />";
			$message .= "Fiber: ".Tools::getValue('part','')."<br />";
			$message .= "Hair Density: ".checkbox(Tools::getValue('fullness',''))."<br />";
			$message .= "Part: ".checkbox(Tools::getValue('style',''))."<br />";
			$message .= "Baby Hairs: ".Tools::getValue('baby-hairs','')."<br />";
			$message .= "Hair Length: ".Tools::getValue('hair-length','').Tools::getValue('hair-length-system','').Tools::getValue('haircut','')."<br />";
			$message .= "Human Hair Color: ".Tools::getValue('humanhair_color','')."<br />";
			$message .= "Futura Color: ".Tools::getValue('futura_color','')."<br />";
			$message .= "Kanekalon Color: ".Tools::getValue('kanekalon_color','')."<br />";
			$message .= "Additional Comments: ".Tools::getValue('Additional-Comments','')."<br />";

			$message .= "First Name: ".Tools::getValue('first-name','')."<br />";
			$message .= "Last Name: ".Tools::getValue('last-name','')."<br />";
			$message .= "Phone Number: ".Tools::getValue('phone-number','')."<br />";
			$message .= "E-mail address: ".Tools::getValue('email_co','')."<br />";
			$message .= "Best time to call is: ".Tools::getValue('best-time-to-call','')."<br />";

			$upload_img = Tools::getValue('upload_img','');
			$img_html = "";
			if ($upload_img) {
				$imgs = explode(";", $upload_img);
				foreach ($imgs as $img) {
					$img_html .= '<a href="'.str_ireplace("_tiny_", "", $img).'" target="_blank"><img height="180" src="'.$img.'"/></a> ';
				}
			}
			$message .= "Upload Photo: ". ($img_html ? $img_html : 'None') ."<br />";

			$headers = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=gb2312' . "\r\n";
			$headers .= 'From: '.Tools::getValue('email_co','')."\r\n";

			// $tos = "uniwigscustomorder@gmail.com, customorder@uniwigs.com, 263609376@qq.com";
			$tos = "263609376@qq.com, 269931612@qq.com, 757668783@qq.com, 1058922069@qq.com,634543741@qq.com";
			if(mail( $tos, "CREATE A CUSTOM WIG", $message, $headers )){
				echo "<script language='javascript'> alert('Thank you for using our mail form'); window.location.href='http://www.uniwigs.com/'; </script>";
				exit;
			}else{
				echo "<script language='javascript'> alert('Mistake!'); window.location.href='http://www.uniwigs.com/custom-order'; </script>";
				exit;
			}
		}

		$this->setTemplate(_PS_ROOT_DIR_.'/extra/tpls/custom-order.tpl');
	}
}

$controller = new CustomOrderController();
$controller->run();


