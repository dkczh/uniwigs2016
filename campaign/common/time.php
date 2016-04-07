<?
class Time
{
    /*function Time()
    {
    }*/

    /**自动显示某个频道、栏目最新新闻
     * @param channelDir－频道和栏目的绝对路径名，用来定义频道和栏目。
     * @param n1－新闻的开始序号
     * @param n2－新闻的结束序号
     * @return array 符合条件的数据
     * @exception Exception 无异常处理
    */
    public static function getMicroTime()
    {
        list($usec, $sec) = explode(" ", microtime());
        return ((float)$usec + (float)$sec);
    }

    public static function format()
    {
    }
}
?>