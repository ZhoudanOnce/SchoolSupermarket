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
	$list = $mysql->db_get_page("select * from $tb_name where $where_sql ", $page,10);
	if ($page*1>$list["page"]*1){
		$page = $list["page"];
	}
	$Page = new PageWeb($list["total"],$list["page_size"], "&title=".$_REQUEST["title"]."&categoryid=".$_REQUEST["categoryid"]."&gongyingid=".$_REQUEST["gongyingid"]."&classifyid=".$_REQUEST["classifyid"], $page);
	$page_show = $Page->show(); 
?>
<?php include_once("base.php");?>
<style>
	.content_opeartion{
		cursor: pointer;
		color:blue;
	}
	.content_opeartion:hover{
		text-decoration: underline
	}
	#gwc-box{
		width:100%;
		display:flex;
		flex-direction: column;
	}
	.gwc-table td{
		text-align: center;
	}
	#gwc-title{
		margin:10px 0;
	}
	#gwc_button_jz{
		margin:10px 0 5px 0;
		padding:5px;
		color : white;
		background-color:#71c577;
		align-self: flex-end;
		padding:10px 20px;
	}
</style>
<body>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td width="17" rowspan="2" valign="top" bgcolor="#FFFFFF"></td>
		<td valign="top">
			<table width="100%" height="31" border="0" cellpadding="0" cellspacing="0">
				<tr bgcolor="#FFFFFF"><td height="31"><div class="title">超市商品</div></td></tr>
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
                    $categoryA = $mysql->db_get_all("select * from category order by number1 asc");
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
                                  <th>规格型号</th>
                                  <th width="100">数量</th>
                                  <th>操作</th>
							  </tr>
                                <?php
									foreach($list["data"] as $row) {
								?>
								<tr align="center" class="d">
                                <td><img src="<?php echo __PUBLIC__;?>/Upload/<?php echo $row["img"];?>" height="70" width="70"/></td>
								<td align="center"><?php echo $row['number1'];?></td>
								<td align="center"><?php echo $row['title'];?></td>
                            	<td align="center"><?php echo $row['price'];?></td>
                                <td align="center"><?php echo $row['mark1'];?></td>
                                <td align="center"><?php echo $row['nums'];?></td>
                                <td align="center">
									<?php 
										if($row['nums']>0) echo "<span shop_id='". $row['id'] ."' class='content_opeartion'>添加购物车</span>";
										else echo "<span>没有货了</span>";
									?>
								  </td>
								</tr>
                                <?php } ?>
							</table>
							<div id="gwc-box">
								<div id="gwc-title" class="title">购物车</div>
								<table class="cont tr_color gwc-table">
									<thead>
										<tr>
											<th>商品名称</th>
											<th>数量</th>
											<th>单价</th>
											<th>小计</th>
										</tr>
									</thead>
									<tbody id="gwc_show">
									</tbody>
								</table>
								<div style="cursor: pointer;" onclick="buy_action()" id="gwc_button_jz">结账<span id="gwc_money"></span></div>
							</div>
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
<script>

	var gwc_array = {};

	$(".content_opeartion").click(function(){
		let this_number = $(this).parent().prev().text();
		if(this_number <= 0){
			$(this).removeClass("content_opeartion");
			$(this).text("没有货了");
			return;
		};
		if(this_number == 1){
			$(this).parent().prev().text(this_number-1);
			$(this).removeClass("content_opeartion");
			$(this).text("没有货了");
			bug_add($(this).attr("shop_id"),
				$(this).parent().prev().prev().prev().prev().text(),
				$(this).parent().prev().prev().prev().text())
			return;
		};
		$(this).parent().prev().text(this_number-1);
		bug_add($(this).attr("shop_id"),
				$(this).parent().prev().prev().prev().prev().text(),
				$(this).parent().prev().prev().prev().text())
	});

	//这个是添加购物车方法 包括添加事件：1数组添加 2表格计算 3金额计算
	function bug_add(shop_id,name,price){
		if(gwc_array[shop_id]){
			gwc_array[shop_id].number += 1;
		}
		else{
			var shop_info = {};
			shop_info["name"] = name;
			shop_info["number"] = 1;
			shop_info["price"] = price;
			gwc_array[shop_id] = shop_info;
		}
		set_gwc_table();
	}

	//计算并绘制表格 2结算后面加上余额 
	//这个地方ik应该为kv 不过能正常运行 尽量就不要去动
	function set_gwc_table(){
		$("#gwc_show").empty();
		let gwc_money = 0;
		$.each(gwc_array,(i,k)=>{
			$("#gwc_show").append(`
				<tr>
					<td>${k["name"]}</td>
					<td>${k["number"]}</td>
					<td>${k["price"]}</td>
					<td>${k["number"] * k["price"]}</td>
				</tr>
			`);
			gwc_money += k["number"] * k["price"];
		});
		$("#gwc_money").text(` ${gwc_money}元`);
	}

	//购买事件 清空键值对 发送请求到服务器 清除结账元
	function buy_action(){
		$.each(gwc_array,(k,v)=>{
			buy_shop(k,v["number"]);
		});
		$("#gwc_show").empty();
		$("#gwc_money").text("");
		gwc_array = {};
		alert("购买成功！");
	}

	//这个是最后的购买方法
	function buy_shop(id,number){
		$.ajax({
			url:"./shop_buy.php",
			type:"POST",
			data:{
				shop_id : id,
				shop_number : number
			}
		});
	}
	
</script>
</body>
</html>


