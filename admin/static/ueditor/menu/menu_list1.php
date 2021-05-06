<?php 
	include_once("inc.php");
	$tb_name = "menu";
	$where_sql = "pid=0 and isno=1 and type=0 and auth=".$_REQUEST['auth'];
	$page = $_REQUEST["page"]?$_REQUEST["page"]:1;
	//echo "select * from $tb_name where $where_sql order by grade asc";
	$list = $mysql->db_get_page("select * from $tb_name where $where_sql order by grade asc", $page,100);
	if ($page*1>$list["page"]*1){
		$page = $list["page"];
	}
	$Page = new PageWeb($list["total"],$list["page_size"], "&auth=".$_REQUEST['auth'], $page);
	$page_show = $Page->show(); 
	
	
	if ($_POST){
		for ($i=0; $i<count($_POST["id"]); $i++){
			$data["title"] = "'".$_POST["title"][$i]."'";
			$data["grade"] = "'".$_POST["grade"][$i]."'";
			$data["isno"] = "'".$_POST["isno"][$i]."'";
			$mysql->db_mdf($tb_name,$data,$_POST["id"][$i]);
		}
		urlMsg("操作完成", $tb_name."_list1.php?auth=".$_POST["auth"]);
	}
	
?>
<?php include_once("base.php");?>
<body>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td width="17" rowspan="2" valign="top" bgcolor="#FFFFFF"></td>
		<td valign="top">
			<table width="100%" height="31" border="0" cellpadding="0" cellspacing="0">
				<tr bgcolor="#FFFFFF"><td height="31"><div class="title"><a href="<?php echo $tb_name;?>_edit.php?auth=<?php echo $_REQUEST['auth'];?>">添加</a></div></td></tr>
			</table>
		</td>
		<td width="16" rowspan="2" bgcolor="#FFFFFF"></td>
	</tr>
	<tr>
	<td valign="top" bgcolor="#F7F8F9">
		<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
			<tr><td colspan="4" height="10"></td></tr>
			<tr>
				<td width="1%">&nbsp;</td>
				<td width="96%">
					<table width="100%">
						<td colspan="2">
                        <form name="form1" method="post" action="?" onSubmit="return checkadd()">
                        <input type="hidden" name="auth" value="<?php echo $_REQUEST["auth"];?>" />
                        <input type="hidden" name="pid" value="0" />
							<table width="100%"  class="cont tr_color">
								<tr>
									<th width="300">id</th>
								  <th width="300">名称</th><th width="200">排序</th>
                                  <th width="200">是否显示</th>
									<th width="" align="left">操作</th>
							  </tr>
                                <?php
									foreach($list["data"] as $row) {
								?>
								<tr align="center" class="d"><input type="hidden" name="id[]" value="<?php echo $row["id"];?>"/><td align="center"><?php echo $row["id"];?></td>
								  <td align="center"><input type="text" name="title[]" value="<?php echo $row["title"];?>" /></td>
                                  
                                  <td><input type="text" name="grade[]" value="<?php echo $row["grade"];?>"  style="width:50px;"/></td>
                                  <td align="center"><input type="text" name="isno[]" value="<?php echo $row["isno"];?>" /></td>
									<td align="left"><a href="<?php echo $tb_name;?>_edit.php?id=<?php echo $row['id'];?>&auth=<?php echo $row['auth'];?>">编辑</a>　<a href="?id=<?php echo $row['id'];?>&act=del&auth=<?php echo $row['auth'];?>" onclick='return confirm("真的要删除?不可恢复!");'>删除</a></td>
								</tr>
                                <?php } ?>
                                <tr>
								  <th></th><th width="120"><input class="btn" type="submit" value="提交" /></th>
									<th width=""></th>
							  </tr>
                                
							</table>
                            </form>
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
		$mysql->db_dela($tb_name,"pid=".$_REQUEST["id"]);
		urlMsg("操作成功", $tb_name."_list1.php?auth=".$_REQUEST['auth']);
	}
?>
</body>
</html>