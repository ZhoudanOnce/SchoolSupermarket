<?php 
	include_once("inc.php");
	$tb_name = "menu";
	$page = $_REQUEST["page"]?$_REQUEST["page"]:1;
	$where_sql = "isno=0 and auth=".$_REQUEST['auth'];
	if ($_REQUEST["pid"]) {
		$where_sql .= " and pid =". $_REQUEST["pid"] ." ";
	}else{$where_sql .= " and pid >0";}
	
	if ($_REQUEST["title"]) {
		$where_sql .= " and title like '%". $_REQUEST["title"] ."%' ";
	}
	$list = $mysql->db_get_page("select * from $tb_name where $where_sql order by grade asc", $page,1000);
	if ($page*1>$list["page"]*1){
		$page = $list["page"];
	}
	$Page = new PageWeb($list["total"],$list["page_size"], "&title=".$_REQUEST["title"]."&pid=".$_REQUEST["pid"], $page);
	$page_show = $Page->show(); 
if ($_POST){
		for ($i=0; $i<count($_POST["id"]); $i++){
			$data["title"] = "'".$_POST["title"][$i]."'";
			$data["grade"] = "'".$_POST["grade"][$i]."'";
			$data["url"] = "'".$_POST["url"][$i]."'";
			$data["isno"] = "'".$_POST["isno"][$i]."'";
			$mysql->db_mdf($tb_name,$data,$_POST["id"][$i]);
		}
		urlMsg("操作完成", $tb_name."1_list.php?auth=".$_POST["auth"]."&pid=".$_POST["pid"]);
	}
	
?>
<?php include_once("base.php");?>
<body>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td width="17" rowspan="2" valign="top" bgcolor="#FFFFFF"></td>
		<td valign="top">
			<table width="100%" height="31" border="0" cellpadding="0" cellspacing="0">
				<tr bgcolor="#FFFFFF"><td height="31"><div class="title"><a href="menu1_edit.php?auth=<?php echo $_REQUEST['auth'];?>&pid=<?php echo $_REQUEST['pid'];?>">添加</a></div></td></tr>
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
                <input type="hidden" name="auth" value="<?php echo $_REQUEST["auth"]; ?>"/>
                <select name="pid">
                  <option value="">-- 请选择 --</option>
                  <?php
                    $menuA = $mysql->db_get_all("select * from menu where isno=0 and auth=".$_REQUEST['auth']." and pid=0 order by grade asc");
					foreach($menuA as $row) {
                    ?>
                  <option value="<?php echo $row["id"];?>" <?php if($_REQUEST["pid"]==$row["id"]){echo ' selected="selected" ';}?>><?php echo $row["title"];?></option>
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
                        <form name="form1" method="post" action="?" onSubmit="return checkadd()">
                        <input type="hidden" name="auth" value="<?php echo $_REQUEST["auth"];?>" />
                        <input type="hidden" name="pid" value="<?php echo $_REQUEST["pid"];?>" />
							<table width="100%"  class="cont tr_color">
								<tr>
									<th width="300">名称</th>
                                    <th width="300">网址</th>
                                    <th width="200">排序</th>
                                    <th width="200">是否显示</th>
									<th width="" align="left">操作</th>
								</tr>
                                <?php
									foreach($list["data"] as $row) {
								?>
								<tr align="center" class="d">
									<td><input type="text" name="title[]" value="<?php echo $row["title"];?>" /></td><input type="hidden" name="id[]" value="<?php echo $row["id"];?>"/><td align="center"><input type="text" name="url[]" value="<?php echo $row["url"];?>" /></td>
                                    <td align="center"><input type="text" name="grade[]" value="<?php echo $row["grade"];?>" /></td>
                                    
                                    <td align="center"><input type="text" name="isno[]" value="<?php echo $row["isno"];?>" /></td>
									<td align="left"><a href="menu1_edit.php?pid=<?php echo $row['pid'];?>&id=<?php echo $row['id'];?>&auth=<?php echo $row['auth'];?>">编辑</a> 　<a href="?id=<?php echo $row['id'];?>&act=del&pid=<?php echo $row['pid'];?>&auth=<?php echo $row['auth'];?>" onclick='return confirm("真的要删除?不可恢复!");'>删除</a></td>
								</tr>
                                <?php } ?>
                                <tr>
								  <th></th><th width="120"><input class="btn" type="submit" value="提交" /></th>
									<th width=""></th>
							</table></form>
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
		$mysql->db_del("menu",$_REQUEST["id"]);
		urlMsg("操作成功", "menu1_list.php?pid=".$_REQUEST['pid']."&auth=".$_REQUEST["auth"]);
	}
?>
</body>
</html>