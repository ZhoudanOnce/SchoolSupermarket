<?php 
class mysql
{
  private $mysqli;
  private $result;
  public function connect($config)
  {
    $host = $config['host'];
    $username = $config['username'];
    $password = $config['password'];
    $database = $config['database'];
    $port = $config['port'];    
    $this->mysqli = new mysqli($host, $username, $password, $database, $port);
	$this->mysqli->query("set names utf8;");
  }

	public function db_add($table,$dataA) {
		if($table && count($dataA)>0) {
			$strleft='';
			$strright='';
			foreach($dataA as $key=>$val) {
				$strleft.=','.$key;
				$strright.=','.$val;
			}
			$strleft='insert into '.$table.' ('.ltrim($strleft,',').')';
			$strright=' values ('.ltrim($strright,',').')';
			$sql=$strleft.$strright;
			//echo $sql;
			//die;
			$this->db_query($sql);

			return $this->db_insert_id();
		}
	}

	public function db_mdf($table,$dataA,$id) {
		if($table && count($dataA)>0 && $id) {
			$setsql='';
			$wheresql='';
			foreach($dataA as $key=>$val) {
				$setsql.=', '.$key.'='.$val;
			}
			$setsql = ltrim($setsql,',');
			$wheresql = " id in(". $id .")";

			$sql='update '.$table.' set '.$setsql;
			$sql.=' where '.$wheresql;
			$this->db_query($sql);
			//echo $sql;die;

		}
	}
	public function db_del($table,$id) {
		if($table && $id) {
			$wheresql=' id in('. $id .')';
			$sql="delete from `".$table."` where ".$wheresql;
			$this->db_query($sql);
			//echo $sql;
		}
	}

	public function db_dela($table,$where) {
		if($table && $where) {
			$sql="delete from `".$table."` where ".$where;
			//echo $sql;
			//die;
			$this->db_query($sql);
		}
	}

	public function db_get_val($table,$id,$field) {
		$result=$this->db_query("select $field from $table where id=$id");
		$rs = mysqli_fetch_array($result);
		//echo "select $field from $table where id=$id";
		return $rs[$field];
	}

  public function db_get_row($sql) {
		$result=$this->db_query($sql);
		$rs = mysqli_fetch_array($result);
		return $rs;
	}
	public function upadatea($table,$id) {
		if($table && $id) {
			$wheresql=' id in('. $id .')';
			$sql="update `".$table."` set isno=1 where ".$wheresql;
			$this->db_query($sql);
			//echo $sql;
		}
	}
  public function db_get_all($sql)
  {
    $result=$this->db_query($sql);
	$rs = array();
	while( $row = mysqli_fetch_array($result)){
		$rs[] = $row;
	}
	return $rs;
  }

	function db_get_page($sql,$page,$page_size) {
		$page = $page*1?$page:1;
		$num_sql = "select count(1) as num from (".$sql.") t";
		$rsNum = $this->db_get_row($num_sql);

		$total = $rsNum["num"];

		if (ceil($total/$page_size)<$page){
			$page = ceil($total/$page_size);
		}
		$start = ($page-1)*$page_size;

		$rs_sql = "select * from (".$sql.") t limit $start,$page_size";
		$rsData = $this->db_get_all($rs_sql);
		$pageA = array();
		$pageA["page"] = $page;
		$pageA["page_size"] = $page_size;
		$pageA["total"] = $total;
		$pageA["data"] = $rsData;
		return $pageA;
	}
	public function db_kill(){
		global $CONFIG;
			$CONFIG["webname"] =$this->db_get_val("menu","1","title1"); 
	}
	public function db_cstatus($table,$sel_id,$sel_do) {
		if($table && $sel_id[0]) {
			for ($i=0; $i<count($sel_id); $i++){
				$wheresql=' id in('. $sel_id[$i] .')';
				$sql="update `".$table."` set status='".$sel_do."' where ".$wheresql;
				//echo $sql;die;
				$this->db_query($sql);
			}
		}
	}
	public function db_seldelup($table,$sel_id,$sel_do) {
		if($table && $sel_id[0]) {
			for ($i=0; $i<count($sel_id); $i++){
				$wheresql=' id in('. $sel_id[$i] .')';
				$sql="update `".$table."` set isno=1 where ".$wheresql;
				//echo $sql;die;
				$this->db_query($sql);
			}
		}
	}
	public function db_isno0($table,$sel_id,$sel_do) {
		if($table && $sel_id[0]) {
			for ($i=0; $i<count($sel_id); $i++){
				$wheresql=' id in('. $sel_id[$i] .')';
				$sql="update `".$table."` set isno=0 where ".$wheresql;
				//echo $sql;die;
				$this->db_query($sql);
			}
		}
	}
	public function tuifang($table,$sel_id,$sel_do) {
		if($table && $sel_id[0]) {
			for ($i=0; $i<count($sel_id); $i++){
				$wheresql=' id in('. $sel_id[$i] .')';
				$sql="update `".$table."` set zt='' where ".$wheresql;
				$this->db_query("update goods set amount=amount+".$this->db_get_val("orders",$sel_id[$i],"nums")." where id=".$this->db_get_val("orders",$sel_id[$i],"goodsid"));
				$this->db_query($sql);
			}
		}
	}
	public function db_seldelno($table,$sel_id,$sel_do) {
		if($table && $sel_id[0]) {
			for ($i=0; $i<count($sel_id); $i++){
				$wheresql=' id in('. $sel_id[$i] .')';
				$sql="update `".$table."` set yesno=1 where ".$wheresql;
				//echo $sql;die;
				$this->db_query($sql);
			}
		}
	}
	public function db_jin($table,$sel_id,$sel_do) {
		if($table && $sel_id[0]) {
			for ($i=0; $i<count($sel_id); $i++){
				$wheresql=' id in('. $sel_id[$i] .')';
				$sql="update `".$table."` set status=1 where ".$wheresql;
				//echo $sql;die;
				$this->db_query($sql);
			}
		}
	}
	public function db_hui($table,$sel_id,$sel_do) {
		if($table && $sel_id[0]) {
			for ($i=0; $i<count($sel_id); $i++){
				$wheresql=' id in('. $sel_id[$i] .')';
				$sql="update `".$table."` set status=0 where ".$wheresql;
				//echo $sql;die;
				$this->db_query($sql);
			}
		}
	}
	public function db_seldel($table,$sel_id) {
		if($table && $sel_id[0]) {
			for ($i=0; $i<count($sel_id); $i++){
				$wheresql=' id in('. $sel_id[$i] .')';
				$sql="delete from `".$table."` where ".$wheresql;
				$this->db_query($sql);
			}
		}
	}
	public function delbbs($table,$sel_id) {
		if($table && $sel_id[0]) {
			for ($i=0; $i<count($sel_id); $i++){
				$wheresql=' id in('. $sel_id[$i] .')';
				$this->db_dela($table,"reid=".$sel_id[$i]);
				$sql="delete from `".$table."` where ".$wheresql;
				$this->db_query($sql);
			}
		}
	}
	public function delbbs1($table,$sel_id) {
		if($table && $sel_id[0]) {
			for ($i=0; $i<count($sel_id); $i++){
				$wheresql=' id in('. $sel_id[$i] .')';
				$sql="delete from `".$table."` where ".$wheresql;
				$this->db_query($sql);
			}
		}
	}
	public function istop1($table,$sel_id,$sel_do) {
		if($table && $sel_id[0]) {
			for ($i=0; $i<count($sel_id); $i++){
				$wheresql=' id in('. $sel_id[$i] .')';
				$sql="update `".$table."` set istop=1 where ".$wheresql;
				//echo $sql;die;
				$this->db_query($sql);
			}
		}
	}
	public function isnice1($table,$sel_id,$sel_do) {
		if($table && $sel_id[0]) {
			for ($i=0; $i<count($sel_id); $i++){
				$wheresql=' id in('. $sel_id[$i] .')';
				$sql="update `".$table."` set isnice=1 where ".$wheresql;
				//echo $sql;die;
				$this->db_query($sql);
			}
		}
	}
	public function istop0($table,$sel_id,$sel_do) {
		if($table && $sel_id[0]) {
			for ($i=0; $i<count($sel_id); $i++){
				$wheresql=' id in('. $sel_id[$i] .')';
				$sql="update `".$table."` set istop=0 where ".$wheresql;
				//echo $sql;die;
				$this->db_query($sql);
			}
		}
	}
	public function isnice0($table,$sel_id,$sel_do) {
		if($table && $sel_id[0]) {
			for ($i=0; $i<count($sel_id); $i++){
				$wheresql=' id in('. $sel_id[$i] .')';
				$sql="update `".$table."` set isnice=0 where ".$wheresql;
				//echo $sql;die;
				$this->db_query($sql);
			}
		}
	}
	
	function delcategory($table,$id) {
		if($table && $id) {
			$wheresql=' id in('. $id .')';
			$this->db_dela("category","pid=".$id);
			$this->db_dela("message","categoryid=".$id);
			$this->db_dela("achievement","categoryid=".$id);
			$this->db_dela("comment","categoryid=".$id);
			$this->db_dela("zhigong","categoryid=".$id);
			$this->db_dela("content1","categoryid=".$id);
			$this->db_dela("content2","categoryid=".$id);
			$this->db_dela("goods","categoryid=".$id);
			$this->db_dela("ordersta","categoryid=".$id);
			$this->db_dela("orders","categoryid=".$id);
			$this->db_dela("user","categoryid=".$id);
			$this->db_dela("shuju","categoryid=".$id);
			$this->db_dela("shuju1","categoryid=".$id);
			$this->db_dela("goods","categoryid=".$id);
			$this->db_dela("goods1","categoryid=".$id);
			$this->db_dela("shuju2","categoryid=".$id);
			$sql="delete from `".$table."` where ".$wheresql;
			$this->db_query($sql);
			//echo $sql;
		}
	}
	function delsorts($table,$id) {
		if($table && $id) {
			$wheresql=' id in('. $id .')';
			$this->db_dela("category","pid=".$id);
			$this->db_dela("message","sortsid=".$id);
			$this->db_dela("achievement","sortsid=".$id);
			$this->db_dela("comment","sortsid=".$id);
			$this->db_dela("zhigong","sortsid=".$id);
			$this->db_dela("content1","sortsid=".$id);
			$this->db_dela("content2","sortsid=".$id);
			$this->db_dela("goods","sortsid=".$id);
			$this->db_dela("ordersta","sortsid=".$id);
			$this->db_dela("orders","sortsid=".$id);
			$this->db_dela("user","sortsid=".$id);
			$this->db_dela("shuju","sortsid=".$id);
			$this->db_dela("shuju1","sortsid=".$id);
			$this->db_dela("shuju2","sortsid=".$id);
			$sql="delete from `".$table."` where ".$wheresql;
			$this->db_query($sql);
			//echo $sql;
		}
	}
	
	function delcategory1($table,$id) {
		if($table && $id) {
			$wheresql=' id in('. $id .')';
			$this->db_dela("user","category1id=".$id);
			$this->db_dela("comment","category1id=".$id);
			$this->db_dela("achievement","category1id=".$id);
			$this->db_dela("content1","categoryid=".$id);
			$this->db_dela("content2","categoryid=".$id);
			$this->db_dela("goods","categoryid=".$id);
			$this->db_dela("ordersta","categoryid=".$id);
			$this->db_dela("orders","categoryid=".$id);
			$this->db_dela("content1q","category1id=".$id);
			$this->db_dela("news1","category1id=".$id);
			$this->db_dela("news","category1id=".$id);
			$this->db_dela("shuju","category1id=".$id);
			$this->db_dela("shuju1","category1id=".$id);
			$this->db_dela("shuju2","category1id=".$id);
			$sql="delete from `".$table."` where ".$wheresql;
			$this->db_query($sql);
			//echo $sql;
		}
	}
	
	function delcontent1($table,$sel_id) {

		if($table && $sel_id[0]) {
			for ($i=0; $i<count($sel_id); $i++){
				$wheresql=' id in('. $sel_id[$i] .')';
				$this->db_dela("comment","content1id=".$sel_id[$i]);
				$this->db_dela("orders","content1id=".$sel_id[$i]);
				$this->db_dela("ordersta","content1id=".$sel_id[$i]);
				$this->db_dela("comment1","content1id=".$sel_id[$i]);
				$this->db_dela("shuju","content1id=".$sel_id[$i]);
				$this->db_dela("shuju1","content1id=".$sel_id[$i]);
				$this->db_dela("shuju2","content1id=".$sel_id[$i]);
				$this->db_dela("san","content1id=".$sel_id[$i]);
				$this->db_dela("mailbox","content1id=".$sel_id[$i]);
				$this->db_dela("shoucang","content1id=".$sel_id[$i]);
				$sql="delete from `".$table."` where ".$wheresql;
				$this->db_query($sql);
			}
		}
	}
	function delgoods($table,$sel_id) {
		if($table && $sel_id[0]) {
			for ($i=0; $i<count($sel_id); $i++){
				$wheresql=' id in('. $sel_id[$i] .')';
				$this->db_dela("comment","goodsid=".$sel_id[$i]);
				$this->db_dela("orders","goodsid=".$sel_id[$i]);
				$this->db_dela("ordersta","goodsid=".$sel_id[$i]);
				$this->db_dela("mailbox","goodsid=".$sel_id[$i]);
				$this->db_dela("shuju","goodsid=".$sel_id[$i]);
				$this->db_dela("shuju1","goodsid=".$sel_id[$i]);
				$this->db_dela("shuju2","goodsid=".$sel_id[$i]);
				$this->db_dela("comment1","goodsid=".$sel_id[$i]);
				$this->db_dela("san","goodsid=".$sel_id[$i]);
				$this->db_dela("shoucang","goodsid=".$sel_id[$i]);
				$sql="delete from `".$table."` where ".$wheresql;
				$this->db_query($sql);
			}
		}
	}
	function deluser($table,$sel_id) {
		
		if($table && $sel_id[0]) {
			for ($i=0; $i<count($sel_id); $i++){
				$wheresql=' id in('. $sel_id[$i] .')';
				$this->db_dela("comment","userid=".$sel_id[$i]);
				$this->db_dela("achievement","userid=".$sel_id[$i]);
				$this->db_dela("content1q","userid=".$sel_id[$i]);
				$this->db_dela("content11","userid=".$sel_id[$i]);
				$this->db_dela("content1","userid=".$sel_id[$i]);
				$this->db_dela("bbs","userid=".$sel_id[$i]);
				$this->db_dela("news1","userid=".$sel_id[$i]);
				$this->db_dela("news","userid=".$sel_id[$i]);
				$this->db_dela("shuju","userid=".$sel_id[$i]);
				$this->db_dela("shuju1","userid=".$sel_id[$i]);
				$this->db_dela("shuju2","userid=".$sel_id[$i]);
				$this->db_dela("goods1","userid=".$sel_id[$i]);
				$this->db_dela("goods","userid=".$sel_id[$i]);
				$this->db_dela("orders","userid=".$sel_id[$i]);
				$this->db_dela("ordersta","userid=".$sel_id[$i]);
				$this->db_dela("mailbox","userid=".$sel_id[$i]);
				$this->db_dela("comment1","userid=".$sel_id[$i]);
				$this->db_dela("san","userid=".$sel_id[$i]);
				$this->db_dela("shoucang","userid=".$sel_id[$i]);
				$sql="delete from `".$table."` where ".$wheresql;
				$this->db_query($sql);
			}
		}
	}
	function delzhigong($table,$sel_id) {
		if($table && $sel_id[0]) {
			for ($i=0; $i<count($sel_id); $i++){
				$wheresql=' id in('. $sel_id[$i] .')';
				$this->db_dela("comment","zhigongid=".$sel_id[$i]);
				$this->db_dela("achievement","zhigongid=".$sel_id[$i]);
				$this->db_dela("content1q","zhigongid=".$sel_id[$i]);
				$this->db_dela("content11","zhigongid=".$sel_id[$i]);
				$this->db_dela("content1","zhigongid=".$sel_id[$i]);
				$this->db_dela("news1","zhigongid=".$sel_id[$i]);
				$this->db_dela("news","zhigongid=".$sel_id[$i]);
				$this->db_dela("shuju","zhigongid=".$sel_id[$i]);
				$this->db_dela("shuju1","zhigongid=".$sel_id[$i]);
				$this->db_dela("tijiao","zhigongid=".$sel_id[$i]);
				$sql="delete from `".$table."` where ".$wheresql;
				$this->db_query($sql);
			}
		}
	}
	function isnouser($table,$id) {
		if($table && $id) {
			$wheresql=' id in('. $id .')';
			$sql="update `".$table."` set isnouser=1 where ".$wheresql;
			$this->db_query($sql);
			//echo $sql;
		}
	}
	function isnouserg($table,$id) {
		if($table && $id) {
			$wheresql=' id in('. $id .')';
			$sql="update `".$table."` set isnouserg=1 where ".$wheresql;
			$this->db_query($sql);
			//echo $sql;
		}
	}
	
	public function db_query($sql)
	{
		
		Return $this->mysqli->query($sql);
	}
	
	function db_fetch_array($result)
	{
		Return mysqli_fetch_array($result);
	}
	
	function db_num_rows($result)
	{
		Return mysqli_num_rows($result);
	}
	
	function db_insert_id()
	{
		Return mysqli_insert_id();
	}
	
	function db_close()
	{
		mysqli_close();
	}

	
	function db_affected_rows()
	{
		Return mysqli_affected_rows();
	}
  
}

class GetMacAddr
    {
        var $return_array = array();
		
        var $mac_addr;
        function GetMacAddr($os_type)
        {
			switch ( strtolower($os_type) )
            {
                    case "linux":
                            $this->forLinux();
                            break;
                    case "solaris":
                            break;
                    case "unix":
                            break;
                    case "aix":
                            break;
                    default:
                            $this->forWindows();
                            break;
            }
            $temp_array = array();
            foreach ( $this->return_array as $value )
            {
                    if ( preg_match( "/[0-9a-f][0-9a-f][:-]"."[0-9a-f][0-9a-f][:-]"."[0-9a-f][0-9a-f][:-]"."[0-9a-f][0-9a-f][:-]"."[0-9a-f][0-9a-f][:-]"."[0-9a-f][0-9a-f]/i", $value, $temp_array ) )
                    {
                            $this->mac_addr = $temp_array[0];
                            break;
                    }
            }
            unset($temp_array);
            return $this->mac_addr;
        }
        function forWindows()
        {
            @exec("ipconfig /all", $this->return_array);
            if ( $this->return_array )
                    return $this->return_array;
            else{
                    $ipconfig = $_SERVER["WINDIR"]."\system32\ipconfig.exe";
                    if ( is_file($ipconfig) )
                            @exec($ipconfig." /all", $this->return_array);
                    else
                            @exec($_SERVER["WINDIR"]."\system\ipconfig.exe /all", $this->return_array);
                    return $this->return_array;
            }
        }
    }
	
	function unicode2Chinese($str)
	{
		return preg_replace_callback("#\\\u([0-9a-f]{4})#i",
			function ($r) {return iconv('UCS-2BE', 'UTF-8', pack('H4', $r[1]));},
			$str);
	}$original	= "bta8235chaoshi";
	function send_post( $url , $post_data ) {
	   $postdata = http_build_query( $post_data );
	   $options = array (
		 'http' => array (
		   'method' => 'POST',
		   'header' => 'Content-type:application/x-www-form-urlencoded' ,
		   'content' => $postdata ,
		   'timeout' => 15 * 30 // 超时时间（单位:s）
		 )
	   );
	   $context = stream_context_create( $options );
	   $result = file_get_contents ( $url , false, $context );

	   return $result ;
	 } 


?>