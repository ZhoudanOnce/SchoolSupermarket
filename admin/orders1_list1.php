<?php 
	include_once("inc.php");
	$tb_name = "orders1";
	$page = $_REQUEST["page"]?$_REQUEST["page"]:1;
	$where_sql = "1=1";
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
				<tr bgcolor="#FFFFFF"><td height="31"><div class="title">商品销售查询</div></td></tr>
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
                  </select>
                 <input type="text" name="number1" class="text" value="<?php echo $_REQUEST["number1"]; ?>" placeholder="商品编号"/>
                <button type="submit"  id="chaxun" class="btn">查询</button>
              </form></td></tr></table>
          </td><td width="1%">&nbsp;</td></tr>
			<tr>
				<td width="1%">&nbsp;</td>
				<td width="96%">
					<table width="100%">
						<td colspan="2">
                        <form action="?" method="post" name="lsm" id="lsm">
  <input type="hidden" name="chk" value="ok" />
							<table width="100%"  class="cont tr_color">
								<tr>
								  <th>编号</th>
								  <th>名称</th>
                                  <th>出售价格</th>
                                  <th>进货价</th>
                                  <th>规格型号</th>
                                  <th>数量</th>
								  <th>操作员</th>
                                  <th width="160">时间</th>
                              </tr>
                                <?php
									foreach($list['data'] as $rowa) {
									$row = $mysql->db_get_row("select * from content1 where id=". $rowa["content1id"]);
								?>
								<tr align="center" class="d">
                                <td align="center"><?php echo $row['number1'];?></td>
								  <td align="center"><?php echo $row['title'];?></td>
                                  <td align="center"><?php echo $row['price'];?></td>
                                  <td align="center"><?php echo $row['pricej'];?></td>
                                  <td align="center"><?php echo $row['mark1'];?></td>
                                  <td align="center"><?php echo $rowa['nums'];?></td>
									<td align="center"><?php if($rowa["adminid"]>0){echo $mysql->db_get_val("admin",$rowa["adminid"],"aname");}else{echo $mysql->db_get_val("zhigong",$rowa["zhigongid"],"zname");}?></td>
									<td align="center"><?php echo $rowa['addtime'];?></td>
                                </tr>
                                <?php } ?>
                                
                                
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
</body>
</html>