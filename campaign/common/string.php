<?
/**
* Description: 字符串处理类
* @Copyright: KETAI (c) 2007
* Author: chiwm
* Create: 2008-06-21
* Amendment Record:
*/
class String
{
    /**
    * Passport 加密函数
    * @param string 等待加密的原字串
    * @param string 私有密匙(用于解密和加密)
    * @return string 原字串经过私有密匙加密后的结果
    */
    public static function passEncode($txt,$key='k125')
    {
        srand((double)microtime() * 1000000);
        $encrypt_key = md5(rand(0, 32000));

        // 变量初始化
        $ctr = 0;
        $tmp = '';

        for($i = 0; $i < strlen($txt); $i++)
        {
            $ctr = $ctr == strlen($encrypt_key) ? 0 : $ctr;
            $tmp .= $encrypt_key[$ctr].($txt[$i] ^ $encrypt_key[$ctr++]);
        }
        return base64_encode(self::passKey($tmp, $key));
    }

    /**
    * Passport 解密函数
    * @param string 加密后的字串
    * @param string 私有密匙(用于解密和加密)
    * @return string 字串经过私有密匙解密后的结果
    */
    public static function passDecode($txt,$key='k125')
    {
        $txt = self::passKey(base64_decode($txt), $key);

        // 变量初始化
        $tmp = '';

        for ($i = 0; $i < strlen($txt); $i++)
        {
            $tmp .= $txt[$i] ^ $txt[++$i];
        }
        return $tmp;

    }

    /**
    * Passport 密匙处理函数
    * @param string 待加密或待解密的字串
    * @param string 私有密匙(用于解密和加密)
    * @return string 处理后的密匙
    */
    public static function passKey($txt,$encrypt_key='k125')
    {
        $encrypt_key = md5($encrypt_key);

        // 变量初始化
        $ctr = 0;
        $tmp = '';

        for($i = 0; $i < strlen($txt); $i++)
        {
            $ctr = $ctr == strlen($encrypt_key) ? 0 : $ctr;
            $tmp .= $txt[$i] ^ $encrypt_key[$ctr++];
        }
        return $tmp;
    }

    /**
    * Passport 信息(数组)编码函数
    * @param array 待编码的数组
    * @return string 数组经编码后的字串
    */
    public static function arrayUriEncode($array)
    {
        $arrayenc = array();
        foreach($array as $key => $val)
        {
            $arrayenc[] = $key.'='.urlencode($val);
        }
        return implode('&', $arrayenc);
    }



    /**
    * url地址加密
    * @param string 待加密字符串
    * @param string 密钥
    * @return string 加密后的字符串
    */
    public static function uriEncode($sQuery,$key='k125')
    {
        if(strlen($sQuery)==0)
        {
            return '';
        }
        else
        {
            $s_tem = preg_replace("/&/i", '&', $sQuery);
            $s_tem = preg_replace("/&/i", '&', $s_tem);
            $a_tem = explode('&', $s_tem);
            shuffle($a_tem);
            $verifyCode='';
            foreach($a_tem as $rs)
            {
                $verifyCode.=$key.$rs;
            }
            $verifyCode=substr(md5($verifyCode),3,7);
            $s_tem = implode('&', $a_tem);
            $s_tem='vcode='.$verifyCode.'&'.$s_tem;
            $s_tem = rawurlencode($s_tem);
            $s_tem = base64_encode($s_tem);
            $s_tem = strrev($s_tem);
            return $s_tem;
        }
    }

    /**
    * url地址解密
    * @param string 待解密字符串
    * @param string 密钥
    * @return string 解密后的字符串
    */
    public static function uriDecode($sEncode,$key='k125')
    {
        if(strlen($sEncode)==0)
            return '';
        else
        {
            $s_tem = strrev($sEncode);
            $s_tem = base64_decode($s_tem);
            $s_tem = rawurldecode($s_tem);
            $vcode=substr($s_tem,6,7);
            $s_tem=substr($s_tem,14);
            $a_tem = explode('&', $s_tem);
            $verifyCode='';
            foreach($a_tem as $rs)
            {
                $verifyCode.=$key.$rs;
            }
            $verifyCode=substr(md5($verifyCode),3,7);

            if($verifyCode==$vcode)
              return $s_tem;
            else
                return '';
        }
    }

    /**字符串截取，当截取处为全角字符则只截取到前一个全角字符结束，并补全截取以前不完整html标签
     * @param strInput 输入字符串
     * @param intStart 截取开始位置
     * @param intLength 截取字符长度
     * @return String 截取后的输出字符串
     * @exception Exception 无异常处理
    */
    public static function htmlSubstr($strInput,$intStart=30,$intLength=0)
    {
        if($intLength==0)
        {
            $intLength=$intStart;
            $intStart=0;
        }
        $intEnd=$intStart+$intLength;
        //$strInput=str_replace("&nbsp;"," ",$strInput);
        if(strlen($strInput)>$intEnd)
        {
            $isSetStart=false;
            for($i=0;$i<strlen($strInput);$i++)
            {
                if($i>=$intStart && !$isSetStart)
                {
                    $intStart=$i;
                    $isSetStart=true;
                }
                if($i>=$intEnd)
                {
                    $intEnd=$i;
                    break;
                }
                if(ord($strInput[$i])>128)
                {
                    $i++;
                }
            }
            $strInput=substr($strInput,$intStart,$intEnd-$intStart);
        }

        //删除最后未封闭html标签
        if(substr($strInput,-1)=="<")
            $strInput=substr($strInput,0,strlen($strInput)-1);
        $intLPos=strrpos($strInput,"<");
        if($intLPos)
        {
            $chrL=ord(substr($strInput,$intLPos+1,1));
            while(!(($chrL>=97 && $chrL<=122) || $chrL==47 || ($chrL>=65 && $chrL<=90)))
            {
                $intLPos=strrpos(substr($strInput,0,$intLPos),"<");
                if(!$intLPos)
                    break;
                $chrL=ord(substr($strInput,$intLPos+1,1));
            }
            if($intLPos)
            {
                $intRPos=strrpos($strInput,">");
                if($intLPos>$intRPos)
                    $strInput=substr($strInput,0,$intLPos);
            }
        }

        //补全不完整html标签
        preg_match_all("/(<[a-z\/]+).*?>/i",$strInput,$ary);
        $ary=array_map("strtolower",$ary[1]);
        $isEnd=false;
        while(!$isEnd)
        {
            $isEnd=true;
            foreach($ary as $key=>$value)
            {
                if($oldvalue==$value)
                {
                    unset($ary[$oldkey]);
                    unset($ary[$key]);
                    $isEnd=false;
                }
                $oldvalue="</".substr($value,1);
                $oldkey=$key;
            }
        }
        $strRtn="";
        foreach($ary as $key=>$value)
        {
            if($value!="<br")
                $strRtn="</".substr($value,1).">".$strRtn;
        }
        return $strInput.$strRtn;
    }

    /**截取全角字符串
     * @param strInput 输入字符串
     * @param intLength 截取字符长度
     * @return String 截取后的输出字符串
     * @exception Exception 无异常处理
    */
    public static function cnSubstr($strInput,$intLength=30,$intStart=0)
    {
        if($intStart!=0)
        {
            $intTemp=$intStart;
            $intStart=$intLength;
            $intLength=$intTemp;
        }
        $strInput=str_replace("&nbsp;"," ",$strInput);
        if(strlen($strInput)>$intLength)
        {
            for($i=0;$i<$intLength+$intStart;$i++)
            {
                if(ord($strInput[$i])>128)
                {
                    $i++;
                    if($i==$intLength+$intStart) {$i--;break;}
                }
            }
            $intLength=$i-$intStart;
            for($i=0;$i<$intStart;$i++)
            {
                if(ord($strInput[$i])>128)
                {
                    $i++;
                    if($i==$intStart) {$i--;break;}
                }
            }
            $intStart=$i;
            //var_dump($intLength);
            $strInput=substr($strInput,$intStart,$intLength);
        }
        return $strInput;
    }

    /**截取UTF-8字符串
     * @param strInput 输入字符串
     * @param len 截取字符长度
     * @return String 截取后的输出字符串
    */
    function utfSubstr($strInput,$len)
    {
        for($i=0;$i<$len;$i++)
        {
            $temp_str=substr($strInput,0,1);
            if(ord($temp_str) > 127)
            {
                $i++;
                if($i<$len)
                {
                    $new_str[]=substr($strInput,0,3);
                    $strInput=substr($strInput,3);
                }
            }
            else
            {
                $new_str[]=substr($strInput,0,1);
                $strInput=substr($strInput,1);
            }
        }
        return join($new_str);
    }

    function hmac_md5($data, $key='')
    {
        // See RFCs 2104, 2617, 2831
        // Uses mhash() extension if available
        if (extension_loaded('mhash'))
        {
            if ($key== '') {
                $mhash=mhash(MHASH_MD5,$data);
            } else {
                $mhash=mhash(MHASH_MD5,$data,$key);
            }
            return $mhash;
        }
        if (!$key)
        {
             return pack('H*',md5($data));
        }
        $key = str_pad($key,64,chr(0x00));
        if (strlen($key) > 64) {
            $key = pack("H*",md5($key));
        }
        $k_ipad =  $key ^ str_repeat(chr(0x36), 64) ;
        $k_opad =  $key ^ str_repeat(chr(0x5c), 64) ;
        /* Heh, let's get recursive. */
        $hmac=hmac_md5($k_opad . pack("H*",md5($k_ipad . $data)) );
        return $hmac;
    }

}
?>