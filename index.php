<?php
/*
* 2007-2015 PrestaShop
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
*  @copyright  2007-2015 PrestaShop SA
*  @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/
$st_prof = false;
if(isset($_REQUEST['st']) and $_REQUEST['st'] == '13505150707'){
	$st_prof = true;
}

if($st_prof){
	xhprof_enable(XHPROF_FLAGS_CPU + XHPROF_FLAGS_MEMORY);
}

require(dirname(__FILE__).'/config/config.inc.php');
Dispatcher::getInstance()->dispatch();

if($st_prof){
	$data = xhprof_disable();
	include_once('xhprof_lib/utils/xhprof_lib.php');
	include_once('xhprof_lib/utils/xhprof_runs.php');

	$objXhprofRun = new XHProfRuns_Default();
	$run_id = $objXhprofRun->save_run($data, 'xhprof');
	var_dump($run_id);
}
