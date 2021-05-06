<?php
$data = array();
if($_POST["account"]){$data["account"] = "'".$_POST["account"]."'";}
if($_POST["password"]){$data["password"] = "'".$_POST["password"]."'";}
if($_POST["nickname"]){$data["nickname"] = "'".$_POST["nickname"]."'";}
if($_POST["tel"]){$data["tel"] = "'".$_POST["tel"]."'";}
if($_POST["sex"]){$data["sex"] = "'".$_POST["sex"]."'";}
if($_POST["email"]){$data["email"] = "'".$_POST["email"]."'";}
if($_POST["address"]){$data["address"] = "'".$_POST["address"]."'";}
if($_POST["username"]){$data["username"] = "'".$_POST["username"]."'";}
if($_POST["categoryid"]){$data["categoryid"] = "'".$_POST["categoryid"]."'";}
if($_POST["category1id"]){$data["category1id"] = "'".$_POST["category1id"]."'";}
if($_POST["title"]){$data["title"] = "'".$_POST["title"]."'";}
if($_POST["content"]){$data["content"] = "'".$_POST["content"]."'";}
if($_POST["pid"]){$data["pid"] = "'".$_POST["pid"]."'";}
if($_POST["url"]){$data["url"] = "'".$_POST["url"]."'";}


if($_POST["s1"]){$data["categoryid"] = "'".$_POST["s1"]."'";}
if($_POST["s2"]){$data["category1id"] = "'".$_POST["s2"]."'";}
if(!empty($_FILES['img']['name'])){
	$file = $_FILES['img'];
	$name = $file['name'];
	$type = strtolower(substr($name,strrpos($name,'.')+1));
	$allow_type = array('jpg','jpeg','gif','png');
	if(!in_array($type, $allow_type)){
		goBakMsg("类型不正确");
	}
	$upload_path = ROOT_PATH.'/Public/Upload/';
	$mu=mt_rand(1,10000000);
	if(move_uploaded_file($file['tmp_name'],$upload_path.$mu.".".$type)){
		$fileName =$mu.".".$type;
	}else
	{//echo "Failed!";
	}
	$data["img"] = "'".$fileName."'";	
}
if(!empty($_FILES['video']['name'])){
	$file1 = $_FILES['video'];
	$name1 = $file1['name'];
	$type1 = strtolower(substr($name1,strrpos($name1,'.')+1));
	$allow_type1 = array('mp4');
	if(!in_array($type1, $allow_type1)){
		goBakMsg("类型不正确");
	}
	$upload_path1 = ROOT_PATH.'/Public/Upload/';
	$mu1=mt_rand(1,10000000);
	if(move_uploaded_file($file1['tmp_name'],$upload_path1.$mu1.".".$type1)){
		$fileName1 =$mu1.".".$type1;
	}else{
		//echo "Failed!";
	}
	$data["video"] = "'".$fileName1."'";
}
if(!empty($_FILES['download']['name'])){
	$fileb = $_FILES['download'];
	$nameb = $fileb['name'];
	$typeb = strtolower(substr($nameb,strrpos($nameb,'.')+1));
	$upload_pathb = ROOT_PATH.'/Public/Upload/';
	$mub=mt_rand(1,10000000);
	if(move_uploaded_file($fileb['tmp_name'],$upload_pathb.$mub.".".$typeb)){
		$fileNameb =$mub.".".$typeb;
	}else{
		//echo "Failed!";
	}
	$data["download"] = "'".$fileNameb."'";	
}
?>