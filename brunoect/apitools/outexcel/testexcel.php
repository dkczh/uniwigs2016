<?php
/*
* AUTHOR  DKC 
*
* phpexcel 测试
* 注意  excel 生成前 不可以有 echo 函数 输出 否则 出错
*/

require_once('Classes/PHPExcel.php');
//include 'Classes/PHPExcel.php';
include 'Classes/PHPExcel/Writer/Excel2007.php';

//或者include 'PHPExcel/Writer/Excel5.php'; 用于输出.xls的

include 'Classes/PHPExcel/Writer/Excel5.php';

//创建一个excel
$objPHPExcel = new PHPExcel();
//保存excel—2007格式
//$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);

//$objWriter->save("xxx.xlsx");


//设置当前的sheet
$objPHPExcel->setActiveSheetIndex(0);
//设置sheet的name
$objPHPExcel->getActiveSheet()->setTitle('产品');
//设置单元格的值
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'id');
//$objPHPExcel->getActiveSheet()->getStyle('A1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
//$objPHPExcel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setARGB('F73809');
$objPHPExcel->getActiveSheet()->setCellValue('B1', 'product');

//处理中文输出问题
//需要将字符串转化为UTF-8编码，才能正常输出，否则中文字符将输出为空白，如下处理：
 //$str  = iconv('gb2312', 'utf-8', $str);
$objPHPExcel->getActiveSheet()->setCellValue('B2', '头饰');

$objPHPExcel->getActiveSheet()->setCellValue('C1', 'sales');
$objPHPExcel->getActiveSheet()->setCellValue('D1', 'customer');
$objPHPExcel->getActiveSheet()->setCellValue('E1', 'email');

/* 
//循环获取 数据库对象数据
for ($i = 2; $i <= $count+1; $i++) {
 $objPHPExcel->getActiveSheet()->setCellValue('A' . $i, convertUTF8($row[$i-2][1]));
 $objPHPExcel->getActiveSheet()->setCellValue('B' . $i, convertUTF8($row[$i-2][2]));
 $objPHPExcel->getActiveSheet()->setCellValue('C' . $i, convertUTF8($row[$i-2][3]));
 $objPHPExcel->getActiveSheet()->setCellValue('D' . $i, convertUTF8($row[$i-2][4]));
 $objPHPExcel->getActiveSheet()->setCellValue('E' . $i, convertUTF8(date("Y-m-d", $row[$i-2][5])));
 $objPHPExcel->getActiveSheet()->setCellValue('F' . $i, convertUTF8($row[$i-2][6]));
 $objPHPExcel->getActiveSheet()->setCellValue('G' . $i, convertUTF8($row[$i-2][7]));
 $objPHPExcel->getActiveSheet()->setCellValue('H' . $i, convertUTF8($row[$i-2][8]));
} */



$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
header("Pragma: public");
header("Expires: 0");
header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
header("Content-Type:application/force-download");
header("Content-Type:application/vnd.ms-execl");
header("Content-Type:application/octet-stream");
header("Content-Type:application/download");;
header('Content-Disposition:attachment;filename="resume.xls"');
header("Content-Transfer-Encoding:binary");
$objWriter->save('php://output');





