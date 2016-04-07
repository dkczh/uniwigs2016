<?php
class Ip
{
    /**
     * 得到IP
     */
    public static function get_ip()
    {
        if(getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) {
            $onlineip = getenv('HTTP_CLIENT_IP');
        } elseif(getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) {
            $onlineip = getenv('HTTP_X_FORWARDED_FOR');
        } elseif(getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) {
            $onlineip = getenv('REMOTE_ADDR');
        } elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) {
            $onlineip = $_SERVER['REMOTE_ADDR'];
        }
        $onlineip = addslashes($onlineip);
        @preg_match("/[\d\.]{7,15}/", $onlineip, $onlineipmatches);
        $onlineip = $onlineipmatches[0];
        return $onlineip;
    }

    /**
     * 得到IP的长整型数
     */
    public static function get_longip()
    {
        return ip2long(ip::get_ip());
    }

    /**
     * 得到短的IP
     */
    public static function get_short_ip()
    {
        if(getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) {
            $onlineip = getenv('HTTP_CLIENT_IP');
        } elseif(getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) {
            $onlineip = getenv('HTTP_X_FORWARDED_FOR');
        } elseif(getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) {
            $onlineip = getenv('REMOTE_ADDR');
        } elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) {
            $onlineip = $_SERVER['REMOTE_ADDR'];
        }
        $onlineip = addslashes($onlineip);
        @preg_match("/[\d\.]{7,15}/", $onlineip, $onlineipmatches);
        $onlineip = $onlineipmatches[0];
        $pos        = strrpos($onlineip,'.');
        $onlineip   = substr($onlineip,0,$pos);
        return $onlineip;
    }

    /*********************** 获取IP所在地等信息 ****************************/
    private static $fp;//QQWry.Dat文件指针
    private static $firstip;//第一条IP记录的偏移地址
    private static $lastip;//最后一条IP记录的偏移地址
    private static $totalip;//IP记录的总条数（不包含版本信息记录）
    /**
    * 析构函数，用于在页面执行结束后自动关闭打开的文件。
    */
    private function _Ip()
    {
        fclose(self::$fp);
    }
    /**
    * 根据所给 IP 地址或域名返回所在地区信息
    * @access public
    * @param string $ip
    * @return array
    */
    public static function getlocation($ip)
    {
        if(!self::$fp)
        {
            $filename = dirname(__FILE__)."/QQWry.dat";
            if ((self::$fp = @fopen($filename, 'rb')) !== false)
            {
                self::$firstip = self::getlong();
                self::$lastip = self::getlong();
                self::$totalip = (self::$lastip - self::$firstip) / 7;
                //注册析构函数，使其在程序执行结束时执行
                //register_shutdown_function(array(&$this, '_Ip'));
            }
        }

        if (!self::$fp) return null; // 如果数据文件没有被正确打开，则直接返回空
        $location['ip'] = gethostbyname($ip); // 将输入的域名转化为IP地址
        $ip = self::packip($location['ip']); // 将输入的IP地址转化为可比较的IP地址
        // 不合法的IP地址会被转化为255.255.255.255
        // 对分搜索
        $l = 0; // 搜索的下边界
        $u = self::$totalip; // 搜索的上边界
        $findip = self::$lastip; // 如果没有找到就返回最后一条IP记录（QQWry.Dat的版本信息）
        while ($l <= $u) { // 当上边界小于下边界时，查找失败
            $i = floor(($l + $u) / 2); // 计算近似中间记录
            fseek(self::$fp, self::$firstip + $i * 7);
            $beginip = strrev(fread(self::$fp, 4)); // 获取中间记录的开始IP地址
            // strrev函数在这里的作用是将little-endian的压缩IP地址转化为big-endian的格式
            // 以便用于比较，后面相同。
            if ($ip < $beginip) { // 用户的IP小于中间记录的开始IP地址时
                $u = $i - 1; // 将搜索的上边界修改为中间记录减一
            }
            else {
                fseek(self::$fp, self::getlong3());
                $endip = strrev(fread(self::$fp, 4)); // 获取中间记录的结束IP地址
                if ($ip > $endip) { // 用户的IP大于中间记录的结束IP地址时
                    $l = $i + 1; // 将搜索的下边界修改为中间记录加一
                }
                else { // 用户的IP在中间记录的IP范围内时
                    $findip = self::$firstip + $i * 7;
                    break; // 则表示找到结果，退出循环
                }
            }
        }
        //获取查找到的IP地理位置信息
        fseek(self::$fp, $findip);
        $location['beginip'] = long2ip(self::getlong()); // 用户IP所在范围的开始地址
        $offset = self::getlong3();
        fseek(self::$fp, $offset);
        $location['endip'] = long2ip(self::getlong()); // 用户IP所在范围的结束地址
        $byte = fread(self::$fp, 1); // 标志字节
        switch (ord($byte))
        {
            case 1: // 标志字节为1，表示国家和区域信息都被同时重定向
                $countryOffset = self::getlong3(); // 重定向地址
                fseek(self::$fp, $countryOffset);
                $byte = fread(self::$fp, 1); // 标志字节
                switch (ord($byte))
                {
                    case 2: // 标志字节为2，表示国家信息又被重定向
                        fseek(self::$fp, self::getlong3());
                        $location['country'] = self::getstring();
                        fseek(self::$fp, $countryOffset + 4);
                        $location['area'] = self::getarea();
                        break;
                    default: // 否则，表示国家信息没有被重定向
                        $location['country'] = self::getstring($byte);
                        $location['area'] = self::getarea();
                        break;
                }
                break;
            case 2: // 标志字节为2，表示国家信息被重定向
                fseek(self::$fp, self::getlong3());
                $location['country'] = self::getstring();
                fseek(self::$fp, $offset + 8);
                $location['area'] = self::getarea();
                break;
            default: // 否则，表示国家信息没有被重定向
                $location['country'] = self::getstring($byte);
                $location['area'] = self::getarea();
                break;
        }
        if ($location['country'] == " CZ88.NET")// CZ88.NET表示没有有效信息
        {
            $location['country'] = "未知";
        }
        if ($location['area'] == " CZ88.NET")
        {
            $location['area'] = "";
        }
        return $location;
    }
    /**
    * 返回读取的长整型数
    * @access private
    * @return int
    */
    private function getlong()
    {
        //将读取的little-endian编码的4个字节转化为长整型数
        $result = unpack('Vlong', fread(self::$fp, 4));
        return $result['long'];
    }
    /**
    * 返回读取的3个字节的长整型数
    * @access private
    * @return int
    */
    private function getlong3()
    {
        //将读取的little-endian编码的3个字节转化为长整型数
        $result = unpack('Vlong', fread(self::$fp, 3).chr(0));
        return $result['long'];
    }
    /**
    * 返回压缩后可进行比较的IP地址
    * @access private
    * @param string $ip
    * @return string
    */
    private function packip($ip)
    {
        // 将IP地址转化为长整型数，如果在PHP5中，IP地址错误，则返回False，
        // 这时intval将Flase转化为整数-1，之后压缩成big-endian编码的字符串
        return pack('N', intval(ip2long($ip)));
    }
    /**
    * 返回读取的字符串
    * @access private
    * @param string $data
    * @return string
    */
    private function getstring($data = "")
    {
        $char = fread(self::$fp, 1);
        while (ord($char) > 0) { // 字符串按照C格式保存，以\0结束
            $data .= $char; // 将读取的字符连接到给定字符串之后
            $char = fread(self::$fp, 1);
        }
        return $data;
    }
    /**
    * 返回地区信息
    * @access private
    * @return string
    */
    private function getarea()
    {
        $byte = fread(self::$fp, 1); // 标志字节
        switch (ord($byte))
        {
            case 0: // 没有区域信息
                $area = "";
                break;
            case 1:
            case 2: // 标志字节为1或2，表示区域信息被重定向
                fseek(self::$fp, self::getlong3());
                $area = self::getstring();
                break;
            default: // 否则，表示区域信息没有被重定向
                $area = self::getstring($byte);
                break;
        }
        return $area;
    }
}
?>