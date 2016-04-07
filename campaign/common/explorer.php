<?
/**
* Description: 资源管理器
* @Copyright: KETAI (c) 2008
* Author: chiwm
* Create: 2010-01-15
* Amendment Record:
*/
class Explorer
{
    private static $strOS;//操作系统，linux;window

    /**创建目录
     * @param strDir 目录，如果目录不是以"/"开头，则以该文件目录为基准目录
     * @return 真实存放目录，创建目录错误返回false
     * @exception Exception 无异常处理
    */
    public static function mkdir($strDir=null)
    {
        $strPath = dirname(__FILE__)."/";
        if($strDir=="")
            return $strPath;
        else
        {
            $strFullDir = str_replace("\\","/",$strDir."/");
            $strFullDir = preg_replace("/\/+/","/",$strFullDir);
            $strOS = self::getOS();
            if($strOS == "window")
            {
                if(substr($strFullDir,1,2) != ":/")
                    $strFullDir = $strPath.$strFullDir;
            }
            else
            {
                if(substr($strFullDir,0,1) != "/")
                    $strFullDir = $strPath.$strFullDir;
            }
            if(!file_exists($strFullDir))
            {
                if($strOS == "window")
                {
                    $aryDirs = explode("/",substr(trim($strFullDir,"/"),3));
                    $strRoot = substr($strFullDir,0,3);
                }
                else
                {
                    $aryDirs = explode("/",trim($strFullDir,"/"));
                    $strRoot = "/";
                }
                $aryMkDir = array();
                for($i=count($aryDirs)-1;$i>=0;$i--)
                {
                    $aryMkDir[] = $aryDirs[$i];
                    $strFullDir = preg_replace("/".preg_quote($aryDirs[$i])."\/$/","",$strFullDir);
                    if(@file_exists($strFullDir))
                        break;
                }
                for($i=count($aryMkDir)-1;$i>=0;$i--)
                {
                    $strFullDir .= $aryMkDir[$i]."/";
                    if(!@mkdir($strFullDir,0777))
                    {
                        return false;
                    }
                    @chmod($strFullDir,0777);
                }
            }
            return $strFullDir;
        }
    }

    /**获取操作系统类型
     * @return String 操作系统类型，linux;window
     * @exception Exception 无异常处理
    */
    public static function getOS()
    {
        if(self::$strOS)
            return self::$strOS;
        $strOS = strtolower($_ENV["OS"]);
        if(strpos($strOS,"window") !== false)
            $strOS = "window";
        else
            $strOS = "linux";
        self::$strOS = $strOS;
        return $strOS;
    }
}
?>