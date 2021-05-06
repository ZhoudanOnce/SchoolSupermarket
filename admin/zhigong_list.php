<?php 
	include_once("inc.php");
	$tb_name = "zhigong";
	$page = $_REQUEST["page"]?$_REQUEST["page"]:1;
	$where_sql = " 1=1 ";
if ($_REQUEST["classifyid"]) {
		$where_sql .= " and classifyid =". $_REQUEST["classifyid"] ." ";
	}
	if ($_REQUEST["zname"]) {$where_sql .= " and zname like '%". $_REQUEST["zname"] ."%' ";}
	if ($_REQUEST["username"]) {$where_sql .= " and username like '%". $_REQUEST["username"] ."%' ";}
	if ($_REQUEST["sortsid"]){$where_sql .= " and sortsid=" . $_REQUEST["sortsid"];}
	$list = $mysql->db_get_page("select * from $tb_name where $where_sql order by id desc", $page,12);
	include_once ROOT_PATH."/common/page.php";
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
              <form id="Form1" name="Form1" action="?" method="get">
				  &nbsp;
<select name="classifyid">
                  <option value="">-- 请选择片区 --</option>
                  <?php
                    $classifya = $mysql->db_get_all("select * from classify order by id asc");
					foreach($classifya as $row) {
                    ?>
                  <option value="<?php echo $row["id"];?>" <?php if($_REQUEST["classifyid"]==$row["id"]){echo ' selected="selected" ';}?>><?php echo $row["title"];?></option>
                  <?php } ?>
                  </select>
              <input type="text" name="username" class="text" value="<?php echo $_REQUEST["username"]; ?>" placeholder="输入工号"/> <input type="text" name="zname" class="text" value="<?php echo $_REQUEST["zname"]; ?>" placeholder="输入姓名"/>
                <button type="submit"  id="chaxun" class="btn">查询</button>  
              </form></td></tr></table>
          </td><td width="1%">&nbsp;</td></tr>
			<tr>
				<td width="1%">&nbsp;</td>
				<td width="96%">
                <form action="?" method="post" name="lsm" id="lsm">
                <input type="hidden" name="chk" value="ok" />
                <input type="hidden" name="sortsid" value="<?php echo $_REQUEST["sortsid"]; ?>"/>
                <input type="hidden" name="username" value="<?php echo $_REQUEST["username"]; ?>"/>
                <input type="hidden" name="zname" value="<?php echo $_REQUEST["zname"]; ?>"/>
					<table width="100%">
						<td colspan="2">
                        
							<table width="100%"  class="cont tr_color">
								<tr>
								  <th width="30" align="center"></th>
                                  <th width="82">照片</th>
								  <th width="150">工号</th>
		
								  <th width="100">姓名</th>
									<th width="60">性别</th>
								  <th width="120">电话</th>
								  <th width="130">片区</th>
								  
								  <th width="120">操作</th>
							  </tr>
                                <?php
									foreach($list["data"] as $row) {
								?>
								<tr align="center" class="d"><td><input type="checkbox" name="sel_id[]" id="sel_id" value="<?php echo $row['id'];?>"></td>
									<td><?php if(!empty($row['img'])){?><img src="<?php echo __PUBLIC__;?>/Upload/<?php echo $row["img"];?>" height="60" width="50"/><?php }?></td>
									<td align="center"><?php echo $row['username'];?></td>
								
									<td align="center"><?php echo $row['zname'];?></td>
									<td align="center"><?php echo $row['sex'];?></td>
									<td align="center"><?php echo $row['tel'];?></td>
<td align="center"><?php echo $mysql->db_get_val("classify",$row["classifyid"],"title")?></td>
									<td><a href="<?php echo $tb_name;?>_edit.php?id=<?php echo $row['id'];?>">修改</a></td>
								</tr>
                                <?php } ?>
                                <tr align="center" class="d">
                                <td></td>
									<td colspan="11" align="left">&nbsp;&nbsp;<input type="checkbox" id="sel_all" value="yes"  onClick="select_all(this.form)"><strong>全选</strong>  <select name="sel_do" size="1" id="sel_do">
                                  <option value="">选择状态</option>
                                  <option value="$mysql->delzhigong">删除</option>
                                  </select>
                                  <input type="submit" value="操作" onClick="return sel_click(this.form)"></td>
                                </tr>
							</table>
						</td>
					</tr>
					</table></form>
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
</body>
</html>