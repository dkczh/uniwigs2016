<?
/**
* Description: 图片处理类，主要包括图片缩放和添加水印
* @Copyright: KETAI (c) 2007
* Author: chiwm
* Create: 2008-6-11
* Amendment Record:

* sample
include_once('./common/image.php');
Image::resize('sourcefilename.jpg','tofilename.jpg',16,9,true,true);
*/
class Image
{
    //以下为添加水印相关
    var $needWatermark = false;//是否添加水印
    var $intWatermarkType = 1;//添加水印类型(1为文字,2为图片)
    var $strWatermarkPosition = "rb";//水印位置 lt左上；lb左下；rt右上；rb右下；ct中上；cb中下；lc左中；rc右中；cc中间；random随机
    var $strWatermarkString = "KETAI.COM"; //水印字符串
    var $strWatermarkImage = "";//水印图片
    var $intWatermarkSize = 24;//文字水印字体大小
    var $strWatermarkFont = "";//文字水印字体

    private static $strImageType="jpg|jpeg|png|pjpeg|gif|bmp|dib|x-png|tif|tiff|wmf|dwg|dxf|svg|svgz|emf|emz";

    //获得文件扩展名
    public static function getExtention($filename)
    {
        $rpos = strrpos($filename,".");
        return substr($filename,$rpos+1);
    }

    //获取文件存放地址
    public static function getSaveDir($filename)
    {
        $strSaveDir = dirname($filename);
        if(!file_exists($strSaveDir))
        {
            $aryDirs = explode("/",substr($strSaveDir,1,strlen($strSaveDir)-2));
            $strDir = "/";
            foreach($aryDirs as $value)
            {
                $strDir .= $value."/";
                if(!@file_exists($strDir))
                {
                    if(!@mkdir($strDir,0777))
                    {
                        return "mkdirError";
                    }
                }
            }
        }
        return $strSaveDir;
    }

    //以下为添加水印相关
    //是否添加水印
    public function setWatermark($needWatermark=false)
    {
        $this->needWatermark = $needWatermark;
    }

    //添加水印类型(1为文字,2为图片)
    public function setWatermarkType($intWatermarkType=1)
    {
        $this->intWatermarkType = $intWatermarkType;
    }

    //设置水印位置
    public function setWatermarkPosition($strWatermarkPosition="rb")
    {
        $this->strPosition = $strWatermarkPosition;
    }

    //设置水印字符串
    public function setWatermarkString($strWatermarkString="KETAI.COM")
    {
        $this->strWatermarkString = $strWatermarkString;
    }

    //设置水印图片
    public function setWatermarkImage($strWatermarkImage="")
    {
        if($strWatermarkImage == "") $strWatermarkImage = dirname(__FILE__)."/logo.png";
        $this->strWatermarkImage = $strWatermarkImage;
    }

    //设置文字水印字体
    function setWatermarkFont($strWatermarkFont="")
    {
        if($strWatermarkFont == "") $strWatermarkFont = dirname(__FILE__)."/ariblk.ttf";
        $this->strWatermarkFont = $strWatermarkFont;
    }

    //设置文字水印字体大小
    function setWatermarkSize($intWatermarkSize=24)
    {
        $this->intWatermarkSize = $intWatermarkSize;
    }

    /**调整图片大小
     * @param filename 需要缩放的图片文件
     * @param saveFilename 生成新的图片文件名
     * @param intResizeWidth 生成的图片宽度
     * @return intResizeHeight 生成的图片高度
     * @return resizeCut 设置是否删除调整图多余部分
     * @return resizeReality 设置是否保持调整图逼真不变形（按宽高大比例项缩放）
     * @exception Exception 无异常处理
    */
    public static function resize($filename,$saveFilename,$intResizeWidth=0,$intResizeHeight=0,$resizeCut=false,$resizeReality=true)
    {
        $strExtention = self::getExtention($filename);
        $strSaveDir = self::getSaveDir($filename);
        if(strpos("|".self::$strImageType."|","|".$strExtention."|") === false)
        {
            return  "imageTypeError";
        }

        if(!@file_exists($filename))
        {
            return  "noneFileError";
        }

        list($intWidth,$intHeight) = getimagesize($filename);//获得上传图片的长宽

        if($intResizeWidth > 0 && $intResizeHeight <= 0)
            $intResizeHeight = $intHeight * ($intResizeWidth / $intWidth);
        elseif($intResizeHeight > 0 && $intResizeWidth <= 0)
            $intResizeWidth = $intWidth * ($intResizeHeight / $intHeight);
        elseif($intResizeWidth <= 0)
        {
            $intResizeWidth = 150;
            $intResizeHeight=$intHeight * ($intResizeWidth / $intWidth);
        }
        elseif($resizeCut)
        {
            if($intWidth / $intResizeWidth > $intHeight / $intResizeHeight)
                $intWidth = $intResizeWidth * $intHeight / $intResizeHeight;
            else
                $intHeight = $intResizeHeight * $intWidth / $intResizeWidth;
        }
        elseif($resizeReality)
        {
            if($intWidth / $intResizeWidth > $intHeight / $intResizeHeight)
                $intResizeHeight = $intHeight * $intResizeWidth / $intWidth;
            else
                $intResizeWidth = $intWidth * $intResizeHeight / $intHeight;
        }

        //check the image size
        if($intWidth <= $intResizeWidth && $intHeight <= $intResizeHeight)
        {
            return "noNeedResize";
        }

        $image1 = imagecreatetruecolor($intResizeWidth,$intResizeHeight); //生成一张调整图
        imagealphablending($image1, false);//取消默认的混色模式
        imagesavealpha($image1,true);//设定保存完整的 alpha 通道信息
        $backgroundColor = imagecolorallocatealpha($image1,255,255,255,127);
        imageFilledRectangle($image1,0,0,$intResizeWidth-1,$intResizeHeight-1,$backgroundColor);

        $aryImageInfo=getimagesize($filename,$aryImageInfo);
        switch ($aryImageInfo[2])
        {
            case 1:
                $image2 = imagecreatefromgif($filename);//将上传图片赋值给image2
                break;
            case 2:
                $image2 = imagecreatefromjpeg($filename);
                break;
            case 3:
                $image2 = imagecreatefrompng($filename);
                break;
            case 6:
                $image2 = imagecreatefromwbmp($filename);
                break;
            default:
            {
                return  "imageTypeError";
            }
        }
        //判断是否图片复制成功
        if(!$image2)
        {
            return "imageTypeError";
        }

        //imagecopyresized($image1,$image2,0,0,0,0,$intResizeWidth,$intResizeHeight,$intWidth,$intHeight); //全图拷贝
        imagecopyresampled($image1,$image2,0,0,0,0,$intResizeWidth,$intResizeHeight,$intWidth,$intHeight); //全图平滑拷贝

        if(!@file_exists($strSaveDir))
        {
            if(!@mkdir($strSaveDir,0777))
                return "mkdirError";
        }

        switch ($aryImageInfo[2])
        {
            case 1:
                //$isOK = @imagegif($image1,$saveFilename);//保存调整图
                $isOK = @imagepng($image1,$saveFilename,100);//保存调整图
                break;
            case 2:
                $isOK = @imagejpeg($image1,$saveFilename,100);//保存调整图
                break;
            case 3:
                $isOK = @imagepng($image1,$saveFilename,100);//保存调整图
                break;
            case 6:
                $isOK = @imagewbmp($image1,$saveFilename,100);//保存调整图
                break;
            default:
                return  "imageTypeError";
        }

        if($isOK)
            return "success";
        else
            return "error";
    }

    //添加图片水印
    function watermark($objFile)
    {
        $aryImageInfo=getimagesize($filename,$aryImageInfo);
        switch ($aryImageInfo[2])
        {
            case 1:
                $sourceImage = imagecreatefromgif($filename);
                break;
            case 2:
                $sourceImage = imagecreatefromjpeg($filename);
                break;
            case 3:
                $sourceImage = imagecreatefrompng($filename);
                break;
            case 6:
                $sourceImage = imagecreatefromwbmp($filename);
                break;
            default:
                return "imageTypeError";
                exit;
        }
        //判断是否图片复制成功
        if(!$sourceImage)
            return "imageTypeError";

        //设置水印位置
        if($this->intWatermarkType!=2)//文字水印
        {
            $ary = imagettfbbox(ceil($this->intWatermarkSize),0,$this->strWatermarkFont,$this->strWatermarkString);//取得使用 TrueType 字体的文本的范围
            $intWaterWidth = $ary[4] - $ary[6];
            $intWaterHeight = $ary[7] - $ary[1];
            unset($ary);
        }
        else//图片水印
        {
            $aryWaterImageInfo=getimagesize($this->strWatermarkImage,$aryWaterImageInfo);
            $intWaterWidth = $aryWaterImageInfo[0];
            $intWaterHeight = $aryWaterImageInfo[1];
        }
        //水印是否超过图片大小
        if( ($aryImageInfo[0]<$intWaterWidth) || ($aryImageInfo[1]<$intWaterHeight) )
        {
            return "success";
        }

        switch($this->strPosition)
        {
            case 'random':
                $posX = rand(0,($aryImageInfo[0] - $intWaterWidth));
                $posY = rand(50,($aryImageInfo[1] - $intWaterHeight));
                break;
            case 'lt':
                $posX = 0;
                $posY = 50;
                break;
            case 'rt':
                $posX = $aryImageInfo[0] - $intWaterWidth;
                $posY = 50;
                break;
            case 'lb':
                $posX = 0;
                $posY = $aryImageInfo[1] - $intWaterHeight;
                break;
            case 'ct':
                $posX = ($aryImageInfo[0] - $intWaterWidth) / 2;
                $posY = 50;
                break;
            case 'cb':
                $posX = ($aryImageInfo[0] - $intWaterWidth) / 2;
                $posY = $aryImageInfo[1] - $intWaterHeight;
                break;
            case 'lc':
                $posX = 0;
                $posY = ($aryImageInfo[1] - $intWaterHeight) / 2;
                break;
            case 'rc':
                $posX = $aryImageInfo[0] - $intWaterWidth;
                $posY = ($aryImageInfo[1] - $intWaterHeight) / 2;
                break;
            case 'cc':
                $posX = ($aryImageInfo[0] - $intWaterWidth) / 2;
                $posY = ($aryImageInfo[1] - $intWaterHeight) / 2;
                break;
            case 'rb':
            default:
                $posX = $aryImageInfo[0] - $intWaterWidth;
                $posY = $aryImageInfo[1] - $intWaterHeight;
                break;
        }

        if($this->intWatermarkType!=2)//文字水印
        {
            $white=imagecolorallocatealpha($sourceImage,255,255,255,60);
            imagettftext($sourceImage,$this->intWatermarkSize,0,$posX,$posY,$white,$this->strWatermarkFont,$this->strWatermarkString);
        }
        else//加水印图片
        {
            switch ($aryWaterImageInfo[2])
            {
                case 1:
                    $waterImage = imagecreatefromgif($this->strWatermarkImage);
                    break;
                case 2:
                    $waterImage = imagecreatefromjpeg($this->strWatermarkImage);
                    break;
                case 3:
                    $waterImage = imagecreatefrompng($this->strWatermarkImage);
                    break;
                case 6:
                    $waterImage = imagecreatefromwbmp($this->strWatermarkImage);
                    break;
                default:
                    return "typeError";
                    exit;
            }
            //判断是否图片复制成功
            if(!$waterImage)
                return "imageTypeError";

            imagealphablending($sourceImage, true);
            imagecopy($sourceImage,$waterImage,$posX,$posY,0,0,$aryWaterImageInfo[0],$aryWaterImageInfo[1]);
            imagedestroy($waterImage);
        }

        switch ($aryImageInfo[2])
        {
        case 1:
            //imagegif($sourceImage, $filename);
            imagejpeg($sourceImage, $filename,100);
            break;
        case 2:
            imagejpeg($sourceImage, $filename,100);
            break;
        case 3:
            imagepng($sourceImage, $filename,100);
            break;
        case 6:
            imagewbmp($sourceImage, $filename,100);
            //imagejpeg($sourceImage, $filename);
        break;
        }

        //覆盖原上传文件
        imagedestroy($sourceImage);
        return "success";
    }

    /**根据url保存图片
     * @param strUrl 需要抓取的图片url
     * @param saveFilename 生成新的图片文件名
     * @return String 图片地址
     * @exception Exception 无异常处理
    */
    public static function saveViaUrl($strUrl,$saveFilename)
    {
        $ary = @get_headers($strUrl);
        if(empty($ary))
            return false;
        $headers = implode("||",$ary);
        if(strpos($headers,"image/")===false)
            return false;
        $str = file_get_contents($strUrl);
        $handle = fopen($saveFilename, "w");
        if(!fwrite($handle, $str)){print "Permission deny";exit;}
        fclose($handle);
        return $saveFilename;
    }
}
?>