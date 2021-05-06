<?php 
	include_once("inc.php");
	$tb_name = "gongying";
	$page = $_REQUEST["page"]?$_REQUEST["page"]:1;
	$where_sql = "1=1";
	if ($_REQUEST["title"]) {
		$where_sql .= " and title like '%". $_REQUEST["title"] ."%' ";
	}
	
	$list = $mysql->db_get_page("select * from $tb_name where $where_sql order by id asc", $page,10);
	if ($page*1>$list["page"]*1){
		$page = $list["page"];
	}
	$Page = new PageWeb($list["total"],$list["page_size"], "&title=".$_REQUEST["title"], $page);
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
              <form id="pagerForm" action="?" method="post">
                <input type="hidden" name="pageNum" value="<?php echo $page; ?>"/>
                <input type="text" name="title" class="text" value="<?php echo $_REQUEST["title"]; ?>" placeholder="输入名称"/>
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
								  <th>名称</th>
                                  <th>负责人</th>
                                  <th>电话</th>
                                  <th>地址</th>
                                  <th width="120">操作</th>
							  </tr>
                                <?php
									foreach($list["data"] as $row) {
								?>
								<tr align="center" class="d">
								  <td><?php echo $row['title'];?></td>
                                  <td><?php echo $row['gname'];?></td>
                                  <td><?php echo $row['tel'];?></td>
                                  <td><?php echo $row['address'];?></td>
                                    <td align="center"><a href="<?php echo $tb_name;?>_edit.php?id=<?php echo $row['id'];?>">编辑</a>　<a href="?id=<?php echo $row['id'];?>&act=del" onclick='return confirm("真的要删除?不可恢复!");'>删除</a></td>
								</tr>
                                <?php } ?>
							</table>
						</td>
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