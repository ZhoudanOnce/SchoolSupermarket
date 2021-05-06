<?php 
	include_once("inc.php");
	$tb_name = "content1";
	$page = $_REQUEST["page"]?$_REQUEST["page"]:1;
	$where_sql = "1=1";
	if ($_REQUEST["title"]) {
		$where_sql .= " and title like '%". $_REQUEST["title"] ."%' ";
	}
	if ($_REQUEST["gongyingid"]) {
		$where_sql .= " and gongyingid =". $_REQUEST["gongyingid"] ." ";
	}
	if ($_REQUEST["number1"]) {
		$where_sql .= " and number1 like '%". $_REQUEST["number1"] ."%' ";
	}
	if ($_REQUEST["categoryid"]) {
		$where_sql .= " and categoryid =". $_REQUEST["categoryid"] ." ";
	}
	$list = $mysql->db_get_page("select * from $tb_name where $where_sql order by id desc", $page,10);
	if ($page*1>$list["page"]*1){
		$page = $list["page"];
	}
	$Page = new PageWeb($list["total"],$list["page_size"], "&title=".$_REQUEST["title"]."&number1=".$_REQUEST["number1"]."&categoryid=".$_REQUEST["categoryid"]."&gongyingid=".$_REQUEST["gongyingid"], $page);
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
              <input type="hidden" name="type" value="<?php echo $_REQUEST['type']?>" />
                <input type="hidden" name="pageNum" value="<?php echo $page; ?>"/>
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
                  </select> <input type="text" name="title" class="text" value="<?php echo $_REQUEST["title"]; ?>" placeholder="名称"/>
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
								  <th>编号</th>
								  <th>名称</th>
                                  <th>供应商</th>
                                  <th width="100">数量</th>
                                  <th width="100">操作</th>
							  </tr>
                                <?php
									foreach($list["data"] as $row) {
								?>
								<tr align="center" class="d">
								  <td align="center"><?php echo $row['number1'];?></td>
								  <td align="center"><?php echo $row['title'];?></td>
                                  <td align="center"><?php echo $mysql->db_get_val("gongying",$row["gongyingid"],"title")?></td>
                                  <td align="center"><?php echo $row['nums'];?></td>
                                  <td align="center"><?php if($_REQUEST['type']=="入库"){?><a href="crk_edit.php?pid=<?php echo $row['pid'];?>&content1id=<?php echo $row['id'];?>&type=<?php echo $_REQUEST['type'];?>">加入</a><?php }else{?><a href="crk_edit1.php?pid=<?php echo $row['pid'];?>&content1id=<?php echo $row['id'];?>&type=<?php echo $_REQUEST['type'];?>">加入</a><?php }?></td>
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
		$mysql->db_del($tb_name,$_REQUEST["id"]);
		urlMsg("操作成功", $tb_name."_list.php");
	}
?>
</body>
</html>