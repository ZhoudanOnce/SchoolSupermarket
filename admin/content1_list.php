<?php 
	include_once("inc.php");
	$tb_name = "content1";
	$page = $_REQUEST["page"]?$_REQUEST["page"]:1;
	$where_sql = "status=0";
	if ($_REQUEST["title"]) {
		$where_sql .= " and title like '%". $_REQUEST["title"] ."%' ";
	}
	if ($_REQUEST["classifyid"]) {
		$where_sql .= " and classifyid =". $_REQUEST["classifyid"] ." ";
	}
	if ($_REQUEST["categoryid"]) {
		$where_sql .= " and categoryid =". $_REQUEST["categoryid"] ." ";
	}
	if ($_REQUEST["gongyingid"]) {
		$where_sql .= " and gongyingid =". $_REQUEST["gongyingid"] ." ";
	}
	$list = $mysql->db_get_page("select * from $tb_name where $where_sql order by id desc", $page,10);
	if ($page*1>$list["page"]*1){
		$page = $list["page"];
	}
	$Page = new PageWeb($list["total"],$list["page_size"], "&title=".$_REQUEST["title"]."&categoryid=".$_REQUEST["categoryid"]."&gongyingid=".$_REQUEST["gongyingid"]."&classifyid=".$_REQUEST["classifyid"], $page);
	$page_show = $Page->show(); 
?>
<?php include_once("base.php");?>
<body>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td width="17" rowspan="2" valign="top" bgcolor="#FFFFFF"></td>
		<td valign="top">
			<table width="100%" height="31" border="0" cellpadding="0" cellspacing="0">
				<tr bgcolor="#FFFFFF"><td height="31"><div class="title"><a href="<?php echo $tb_name;?>_edit.php">添加</a></div></td></tr>
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
                  </select> <input type="text" name="title" class="text" value="<?php echo $_REQUEST["title"]; ?>"/>
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
								  <th>图片</th>
                                  <th>编号</th>
								  <th>名称</th>
                                  <th>销售价</th>
                                  <th>进货价</th>
                                  <th>规格型号</th>
                                  <th width="100">数量</th>
								  <th width="120">操作</th>
							  </tr>
                                <?php
									foreach($list["data"] as $row) {
								?>
								<tr align="center" class="d">
                                <td><img src="<?php echo __PUBLIC__;?>/Upload/<?php echo $row["img"];?>" height="70" width="70"/></td>
								  <td align="center"><?php echo $row['number1'];?></td>
								  <td align="center"><?php echo $row['title'];?></td>
                                  <td align="center"><?php echo $row['price'];?></td>
                                  <td align="center"><?php echo $row['pricej'];?></td>
                                  <td align="center"><?php echo $row['mark1'];?></td>
                                  <td align="center"><?php echo $row['nums'];?></td>
								  <td><a href="<?php echo $tb_name;?>_edit.php?id=<?php echo $row['id'];?>">编辑</a>　 <a href="?id=<?php echo $row['id'];?>&act=del" onclick='return confirm("真的要删除?不可恢复!");'>删除</a></td>
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
		$mysql->db_query("update $tb_name set status=1 where id=".$_REQUEST["id"]);
		urlMsg("操作成功", $tb_name."_list.php");
	}
?>
</body>
</html>