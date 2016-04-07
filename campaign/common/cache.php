<?
/**
* Description: 缓存类
* @Copyright: KETAI (c) 2008
* Author: chiwm
* Create: 2008-01-15
* Amendment Record:
*/
class Cache
{
    private static $strCacheDir;
    /**得到缓存
     * @param strCacheName 缓存名
     * @return 存入缓存的内容，一般为数组
     * @exception Exception 无异常处理
    */
    public static function get($strCacheName)
    {
        if($strCacheName=="")
            return false;
        if(self::$strCacheDir=='')
            self::setCacheDir();
        $aryRtn = self::_readFile(self::$strCacheDir.$strCacheName.".php");
        if($aryRtn[0] > time())
            return $aryRtn[1];
        else
            return false;
    }

    /**设置缓存
     * @param strCacheName 缓存名
     * @param cacheData 缓存内容
     * @param timeExpire 缓存过期时间偏移量
     * @exception Exception 无异常处理
    */
    public static function set($strCacheName,$cacheData,$timeExpire=3600)
    {
        if($strCacheName=="")
            return false;
        if(self::$strCacheDir=='')
            self::setCacheDir();
        self::_writeFile(self::$strCacheDir.$strCacheName.".php",$cacheData,$timeExpire);
    }

    /**设置缓存路径
     * @param strCacheDir 缓存路径
     * @param cacheData 缓存内容
     * @param timeExpire 缓存过期时间偏移量
     * @exception Exception 无异常处理
    */
    public static function setCacheDir($strCacheDir="cache")
    {
        include_once(dirname(__FILE__)."/explorer.php");
        $return = Explorer::mkdir($strCacheDir);
        if($return)
            self::$strCacheDir = $return;
        else
            return false;
    }

    /**设置缓存路径
     * @param strCacheDir 缓存路径
     * @param cacheData 缓存内容
     * @param timeExpire 缓存过期时间偏移量
     * @exception Exception 无异常处理
    */
    private static function _readFile($strFileName)
    {
        $cacheData = array();
        if(!file_exists($strFileName))
        {
             return $cacheData;
        }
        //动态载入cache数据
        include($strFileName);
        $cacheData = isset($aryCacheData) ? $aryCacheData : array();
        return $cacheData;
    }

    /*
    * write cache file content
    * @param     string     $strFileName 待写入文件名
    * @param     array     $cacheData     记录数组
    * @param     integer     $iIsArray     是否为数组数据 1:是 0:否 默认0
    * @return boolean     $bReturn     成功:true 失败:false;
    * @access private
    */
    private static function _writeFile($strFileName,$cacheData,$timeExpire=3600)
    {
        if(empty($strFileName))
        {
             return false;
        }
        $fp = fopen($strFileName, "w");
        if(!$fp)
        {
             return false;
        }
        flock($fp, LOCK_EX);
        //数据内容处理
        $aryCacheData = array();
        $aryCacheData[0] = time() + $timeExpire;
        $aryCacheData[1] = $cacheData;
        //数据格式化, 转换为php类型数据
        $strContent = "<?php\n";
        $strContent .= "\$aryCacheData = ".var_export($aryCacheData, true).";\n";
        $strContent .= "?>";
        fwrite($fp, $strContent);
        flock($fp, LOCK_UN);
        fclose($fp);
        @chmod($filename,0777);
        return true;
    }

}
?>