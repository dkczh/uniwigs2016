<?php
class ConnDB
{
    /**
    * Description: 连接数据库
    * @Copyright: KETAI (c) 2008
    * Author: chiwm
    * Create: 2008-6-11
    * Amendment Record:

    * sampel
    include_once("./common/conn_db.php");
    $conn = new ConnDB('dbname');
    $ary = $conn->query(sql);
    */

    var $conn;
    private $strDB;

    /**连接数据库 connDB
     * @param strDB 选择数据库
     * @return connection
     * @exception Exception 无异常处理
    */
    function ConnDB($strDB="",$strSite="THE1727",$dbcharset="utf8")
    {
        include_once(dirname(__FILE__)."/constant.php");
        include_once(dirname(__FILE__)."/log.php");
        $this->conn = @mysql_connect(constant($strSite."_IP"),constant($strSite."_USER"),constant($strSite."_PASSWORD"));
		if($this->conn===false)
		{
			Log::out("connect db:".$strDB." error","E");
			return false;
		}

        //字符集设置
        $serverset = $dbcharset ? 'character_set_connection='.$dbcharset.', character_set_results='.$dbcharset.', character_set_client=binary' : '';
        $serverset .= @mysql_get_server_info($this->conn) > '5.0.1' ? ((empty($serverset) ? '' : ',').'sql_mode=\'\'') : '';
        @mysql_query("SET $serverset", $this->conn);

        if($strDB!="")
        {
            $this->strDB = $strDB;
            if(!mysql_select_db($strDB))
                Log::out("select db:".$strDB." error","E");
    	}
    }
    /**设置数据库
     * @return boolen 数据库是否设置成功
     * @exception Exception 无异常处理
    */
    function setDB($db)
    {
        if($this->conn!=false && $db!="")
        {
            if(!mysql_select_db($db))
            {
                Log::out("select db:".$db." error","E");
                return false;
            }
            else
                return true;
        }
        else
        {
            Log::out("select db:".$db." error","E");
            return false;
        }
    }
    /**关闭连接数据库 closeDB
     * @return void
     * @exception Exception 无异常处理
    */
    function close()
    {
        return $this->closeDB();
    }
    function closeDB()
    {
        if($this->conn!=false)
        {
            mysql_close($this->conn);
            $this->conn=false;
        }
    }
    /**查询数据 querySql
     * @param strSql sql语句
     * @return array 所有数据
     * @exception Exception 错误返回false
    */
    function query($strSql)
    {
        return $this->querySql($strSql);
    }

    function querySql($strSql="")
    {
        if($strSql=="") return false;
        if($this->conn=="")
            $result = mysql_query($strSql);
        else{
            $result = mysql_query($strSql,$this->conn);
        }
        if($result==false)
        {
            Log::out("sql=".$strSql,"E");
            return false;
        }
        $err = mysql_error();
        if($err)
        {
            Log::out("sql=".$strSql,"E");
            return false;
        }
        $i=0;
        $aryRtn=array();
        while($row = mysql_fetch_array($result))
        {
            $aryRtn[$i]=$row;
            $i++;
        }
        return $aryRtn;
	}
    /**查询数据 executeSql
     * @param strSql sql语句
     * @return boolen 执行成功返回true
     * @exception Exception 错误返回false
    */
    function execute($strSql)
    {
        return $this->executeSql($strSql);
    }

    function executeSql($strSql="")
    {
        if($strSql=="") return false;
        $result = mysql_query($strSql);
        if($result==false)
        {
            Log::out("sql=".$strSql,"E");
        }
        else
        {
            if($this->needSync)
                DBSync::record($strSql,$this->strDB,$this->arySyncTables);
        }
        return $result;
    }

    /**查询数据 getAffectedRows
     * @return int 执行成功返回>0数字
     * @exception Exception 错误返回0
    */
    function getAffectedRows()
    {
        if($this->conn=="")
            $intNum = mysql_affected_rows();
        else
            $intNum = mysql_affected_rows($this->conn);
        return $intNum;
    }

    /**查询数据 getAffectedRows
     * @return int 执行成功返回>0数字
     * @exception Exception 错误返回0
    */
    private $arySyncTables;
    private $needSync;
    function setSync($needSync=true,$aryTables=null)
    {
        $this->needSync = $needSync;
        $this->arySyncTables = $aryTables;
        if($needSync)
            include_once(dirname(__FILE__)."/db_sync.php");
    }
}
?>
