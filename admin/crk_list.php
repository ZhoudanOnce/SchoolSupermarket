<?php 
	include_once("inc.php");
	$tb_name = "crk";
	$page = $_REQUEST["page"]?$_REQUEST["page"]:1;
	$where_sql = "1=1";
	if ($_REQUEST["status"]) {
		if($_REQUEST["status"]==1){$orderby = " totals desc ";}
		if($_REQUEST["status"]==2){$orderby = " nums desc ";}
	}else{$orderby = " id desc ";}
	if ($_REQUEST["number1"]) {
		$where_sql .= " and number1 like '%". $_REQUEST["number1"] ."%' ";
	}
	if ($_REQUEST["keywords"]) {
		$where_sql .= " and cnumber1 like '%". $_REQUEST["keywords"] ."%' ";
	}
	if ($_REQUEST["type"]) {
		$where_sql .= " and type like '%". $_REQUEST["type"] ."%' ";
	}
	if ($_REQUEST["stime"]) {
		$where_sql .= " and addtime >='". $_REQUEST["stime"]."'";
	} 
	if ($_REQUEST["etime"]) {
		$where_sql .= " and addtime <='". $_REQUEST["etime"]."'";
	} 
	$list = $mysql->db_get_page("select * from $tb_name where $where_sql order by $orderby", $page,10);
	if ($page*1>$list["page"]*1){
		$page = $list["page"];
	}
	$Page = new PageWeb($list["total"],$list["page_size"], "&keywords=".$_REQUEST["keywords"]."&number1=".$_REQUEST["number1"]."&type=".$_REQUEST["type"]."&stime=".$_REQUEST["stime"]."&etime=".$_REQUEST["etime"]."&status=".$_REQUEST["status"], $page);
	$page_show = $Page->show(); 

?>
<?php include_once("base.php");?>
<body>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td width="17" rowspan="2" valign="top" bgcolor="#FFFFFF"></td>
		<td valign="top">
			<table width="100%" height="31" border="0" cellpadding="0" cellspacing="0">
				<tr bgcolor="#FFFFFF"><td height="31"><div class="title"><?php if($_REQUEST['type']=="入库"){?><a href="content1_list1.php?type=<?php echo $_REQUEST['type']?>">添加</a><?PHP }else{?><a href="kucun_list1.php?type=<?php echo $_REQUEST['type']?>">添加</a><?php }?></div></td></tr>
			</table>
		</td>
		<td width="16" rowspan="2" bgcolor="#FFFFFF"></td>
	</tr>
	<tr>
	<td valign="top" bgcolor="#F7F8F9">
		<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
			<tr><td colspan="4" height="10"></td></tr>
            <tr><td width="1%">&nbsp;</td><td width="96%">
            <table width="100%" class="cont">
			<tr>
            <td>
              <form id="pagerForm" action="?" method="get">
                <input type="hidden" name="type" value="<?php echo $_REQUEST['type']?>" />
                
                <input type="text" name="keywords" class="text" value="<?php echo $_REQUEST["keywords"]; ?>" placeholder="输入编号"/>
                <input type="text" name="number1" class="text" value="<?php echo $_REQUEST["number1"]; ?>" placeholder="输入商品编号"/>
                <input type="text" onFocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" class="text"  value='<?php echo $_REQUEST["stime"];?>' id='stime' name='stime'  placeholder="开始时间" >
                <input type="text" onFocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" class="text"  value='<?php echo $_REQUEST["etime"];?>' id='etime' name='etime'  placeholder="结束时间" >
                <button type="submit"  id="chaxun" class="btn">查询</button>
              </form></td></tr></table>
          </td><td width="1%">&nbsp;</td></tr>
			<tr>
				<td width="1%">&nbsp;</td>
				<td width="96%">
					<table width="100%">
						<td colspan="2">
							<table width="100%"  class="cont tr_color">
								<tr>
                                  <th><?php echo $_REQUEST['type'];?>编号</th>
                                  <th>商品编号</th>
								  <th>商品</th>
                                  <th>数量</th>
                                  <th>价格</th>
                                  <th>总计</th>
                                  <th>日期</th>
								  <th width="160">操作</th>
							  </tr>
                                <?php
									foreach($list['data'] as $row) {
								?>
								<tr align="center" class="d">
								  <td align="center"><?php echo $row['cnumber1'];?></td>
                                  <td align="center"><?php echo $row['number1'];?></td>
									<td align="center"><?php echo $mysql->db_get_val("content1",$row["content1id"],"title")?></td>
									<td align="center"><?php echo $row['nums'];?></td>
                                    <td align="center"><?php echo $row['mprice'];?></td>
                                    <td align="center"><?php echo $row['totals'];?></td>
                                    <td align="center"><?php echo $row['begintime'];?></td>
                                    <td><a href="?id=<?php echo $row['id'];?>&act=del&type=<?php echo $_REQUEST['type'];?>" onclick='return confirm("真的要删除?!");'>删除</a></td>
								</tr>
                                <?php } ?>
							</table>
						</td>
					</tr>
					</table>
					<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
                        <tr>
                          <td align="center"><?php echo $page_show;?></td>
                        </tr>
                      </table>    
					</td>
					<td width="1%">&nbsp;</td>
				</tr>
				<tr><td height="20"></td></tr>
			</table>
		</td>
	</tr>
</table>
<?php

$act = !empty($_GET['act']) ? trim($_GET['act']) : '';
  if($act == 'del')
	{
		$rs1 = $mysql->db_get_row("select * from $tb_name where id=". $_REQUEST["id"]);
		//$mysql->db_query("update content1 set amount=amount-".$rs1["nums"]." where id=". $rs1["content1id"]);
		$mysql->db_del($tb_name,$_REQUEST["id"]);
		urlMsg("操作成功", $tb_name."_list.php?type=".$_REQUEST['type']);
		die;
	}
?>
</body>
</html>