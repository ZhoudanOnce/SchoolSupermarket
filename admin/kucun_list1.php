<?php 
	include_once("inc.php");
	$tb_name = "kucun";
	$page = $_REQUEST["page"]?$_REQUEST["page"]:1;
	$where_sql = "1=1 and nums>0";
	if ($_REQUEST["number1"]) {
		$where_sql .= " and number1 like '%". $_REQUEST["number1"] ."%' ";
	}
	if ($_REQUEST["gongyingid"]) {
		$where_sql .= " and gongyingid =". $_REQUEST["gongyingid"] ." ";
	}
	if ($_REQUEST["title"]) {
		$where_sql .= " and title like '%". $_REQUEST["title"] ."%' ";
	}
	if ($_REQUEST["categoryid"]) {
		$where_sql .= " and categoryid =". $_REQUEST["categoryid"] ." ";
	}
	if ($_REQUEST["classifyid"]) {
		$where_sql .= " and classifyid =". $_REQUEST["classifyid"] ." ";
	}
	$list = $mysql->db_get_page("select * from $tb_name where $where_sql order by id desc", $page,10);
	if ($page*1>$list["page"]*1){
		$page = $list["page"];
	}
	$Page = new PageWeb($list["total"],$list["page_size"], "&title=".$_REQUEST["title"]."&number1=".$_REQUEST["number1"]."&categoryid=".$_REQUEST["categoryid"]."&gongyingid=".$_REQUEST["gongyingid"]."&classifyid=".$_REQUEST["classifyid"], $page);
	$page_show = $Page->show(); 
?>
<?php include_once("base.php");?>
<body>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td width="17" rowspan="2" valign="top" bgcolor="#FFFFFF"></td>
		<td valign="top">
			<table width="100%" height="31" border="0" cellpadding="0" cellspacing="0">
				<tr bgcolor="#FFFFFF"><td height="31"><div class="title">选择商品</div></td></tr>
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
                <input type="hidden" name="pageNum" value="<?php echo $page; ?>"/>
                <input type="hidden" name="ordersid" value="<?php echo $_REQUEST["ordersid"]; ?>"/>
                  
                  <select name="gongyingid">
                  <option value="">-- 请选择供应商 --</option>
                  <?php
                    $gongyinga = $mysql->db_get_all("select * from gongying order by id asc");
					foreach($gongyinga as $row) {
                    ?>
                  <option value="<?php echo $row["id"];?>" <?php if($_REQUEST["gongyingid"]==$row["id"]){echo ' selected="selected" ';}?>><?php echo $row["title"];?></option>
                  <?php } ?>
                  </select>
                <select name="categoryid">
                  <option value="">-- 请选择分类 --</option>
                  <?php
                    $categoryA = $mysql->db_get_all("select * from category order by id asc");
					foreach($categoryA as $row) {
                    ?>
                  <option value="<?php echo $row["id"];?>" <?php if($_REQUEST["categoryid"]==$row["id"]){echo ' selected="selected" ';}?>><?php echo $row["title"];?></option>
                  <?php } ?>
                  </select> 
				  <select name="classifyid">
                  <option value="">-- 请选择片区 --</option>
                  <?php
                    $classifya = $mysql->db_get_all("select * from classify order by id asc");
					foreach($classifya as $row) {
                    ?>
                  <option value="<?php echo $row["id"];?>" <?php if($_REQUEST["classifyid"]==$row["id"]){echo ' selected="selected" ';}?>><?php echo $row["title"];?></option>
                  <?php } ?>
                  </select>
				  <input type="text" name="title" class="text" value="<?php echo $_REQUEST["title"]; ?>" placeholder="商品名称"/>
                 <input type="text" name="number1" class="text" value="<?php echo $_REQUEST["number1"]; ?>" placeholder="商品编号"/>
                <button type="submit"  id="chaxun" class="btn">查询</button> <input name="button" type="button" class="btn" onClick="javascript:history.back();" value="返回">
              </form></td></tr></table>
          </td><td width="1%">&nbsp;</td></tr>
			<tr>
				<td width="1%">&nbsp;</td>
				<td width="96%">
					<table width="100%">
						<td colspan="2">
                        	<table width="100%"  class="cont tr_color">
								<tr>
								  <th>片区</th>
								<th>编号</th>
								  <th>名称</th>
                                  <th>销售价</th>
                                  <th>数量</th>
                                  
                                  <th width="120">操作</th>
							  </tr>
                                <?php
									foreach($list["data"] as $row) {
								?>
								<tr align="center" class="d">
								  <td align="center"><?php echo $mysql->db_get_val("classify",$row["classifyid"],"title")?></td>
									<td align="center"><?php echo $row['number1'];?></td>
								  <td align="center"><?php echo $mysql->db_get_val("content1",$row["content1id"],"title")?></td>
                                  <td align="center"><?php echo $mysql->db_get_val("content1",$row["content1id"],"price")?></td>
                                  <td align="center"><?php echo $row['nums'];?></td>
                                  
                                  <td><a href="orders1_edit.php?kucunid=<?php echo $row['id'];?>&ordersid=<?php echo $_REQUEST["ordersid"];?>&content1id=<?php echo $row['content1id'];?>&classifyid=<?php echo $row['classifyid'];?>">添加</a></td>
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
	if ($_REQUEST["act"]=="del") {
		$rs = $mysql->db_get_row("select * from $tb_name where id=". $_REQUEST["id"]);
		$mysql->db_query("update content1 set nums=nums-".$rs["nums"]." where id=".$rs["content1id"]);
		$mysql->db_del($tb_name,$_REQUEST["id"]);
		urlMsg("操作成功", $tb_name."_list.php");
	}
?>
</body>
</html>