<?php
/**
* Description: 写日志
* @Copyright: KETAI (c) 2008
* Author: chiwm
* Create: 2008-03-12
* Amendment Record:

* sample
include_once("./common/log.php");
Log::out('msg','I','','mylogname.log');
*/
class Log
{
    private static $strFileName;

    /**输出log
     * @param strMSG log信息
     * @param strType log类型
     * @param strExtra 扩展信息
     * @param strFileName log的存放路径及文件名。默认为common/log下（在没有设置，或只设置文件名的情况下）
     * @return void
     * @exception Exception 无异常处理
    */
    public function Log($strMSG="",$strType="I",$strExtra="",$strFileName="")
    {
        self::$strFileName = $strFileName;
        if($strMSG)
            $this->out($strMSG,$strType,$strExtra);
    }

    public static function out($strMSG="",$strType="I",$strExtra="",$strFileName="",$line="")
    {
        $strPath = dirname(__FILE__);
        include_once($strPath."/ip.php");

        if($strType=="") $strType = "I";

        $filenameDate = "";
        if(is_array($strFileName))
        {
            if($strFileName["datestyle"])
                $filenameDate = date($strFileName["datestyle"]);
        }
        else
            $filenameDate = date("ymd");
        if($strFileName)
            self::$strFileName = $strFileName;
        if(self::$strFileName)
        {
            $pos = strrpos(self::$strFileName,"/");
            if($pos !== false)
            {
                $logDir = substr(self::$strFileName,0,$pos);
                $logName = substr(self::$strFileName,$pos+1);
                if(!file_exists($logDir))
                {
                    $aryDirs = explode("/",substr($logDir,1));
                    $strDir = "/";
                    foreach($aryDirs as $value)
                    {
                        $strDir .= $value."/";
                        if(!@file_exists($strDir))
                        {
                            if(!@mkdir($strDir,0777))
                            {
                                $return = "mkdirError";
                            }
                            chmod($strDir,0777);
                        }
                    }
                }
                $pos = strrpos(self::$strFileName,".");
                if($pos === false)
                    $filename = self::$strFileName.$filenameDate;
                else
                    $filename = substr(self::$strFileName,0,$pos).$filenameDate.substr(self::$strFileName,$pos);
            }
            else
            {
                $strDir = $strPath."/log";
                if(!@file_exists($strDir))
                {
                    if(!@mkdir($strDir,0777))
                    {
                        $return = "mkdirError";
                    }
                    chmod($strDir,0777);
                }
                $pos = strrpos(self::$strFileName,".");
                if($pos === false)
                    $filename = $strPath."/log/".self::$strFileName.$filenameDate;
                else
                    $filename = $strPath."/log/".substr(self::$strFileName,0,$pos).$filenameDate.substr(self::$strFileName,$pos);
            }
        }
        else
        {
            $strDir = $strPath."/log";
            if(!@file_exists($strDir))
            {
                if(!@mkdir($strDir,0777))
                {
                    $return = "mkdirError";
                }
                chmod($strDir,0777);
            }
            $filename = $strPath."/log/log_".$filenameDate.".log";
        }
        if($return == "mkdirError")
            $filename = $strPath."/log_".$filenameDate.".log";
        $handle = fopen($filename, "a");
        $strContent = "[".date("Y-m-d H:i:s")."] [".strtoupper($strType)."] [".@IP::get_ip()."] MSG:[".$strMSG."]".$strExtra." Location:".$_SERVER["SCRIPT_FILENAME"].($line?" Line:".$line:"")." QUERY_STRING:".$_SERVER["QUERY_STRING"]." HTTP_REFERER:".$_SERVER["HTTP_REFERER"]." User-Agent:".$_SERVER["HTTP_USER_AGENT"]."\n";
        if(!fwrite($handle, $strContent)){print "Write permission deny";exit;}
        fclose($handle);
        @chmod($filename,0777);
    }
}
?>
