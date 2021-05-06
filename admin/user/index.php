<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php include_once("inc.php");?><?php echo $CONFIG["webname"];?></title>
<link rel="stylesheet" href="<?php echo __ADMIN__;?>/skin/index/css/base.css" />
<link rel="stylesheet" type="text/css" href="<?php echo __ADMIN__;?>/skin/index/css/jquery.dialog.css" />
<link rel="stylesheet" href="<?php echo __ADMIN__;?>/skin/index/css/index.css" />
    <style>
        .layui-layer-title{background:url(<?php echo __ADMIN__;?>/skin/index/images/righttitlebig.png) repeat-x;font-weight:bold;color:#46647e; border:1px solid #c1d3de;height: 33px;line-height: 33px;}
    </style>

</head>
<body>
<div id="container">
	<div id="hd">
    	<div class="hd-wrap ue-clear">
        	<div class="top-light"></div>
            <h1 class="logo"><?php echo $CONFIG["webname"];?></h1>
            <div class="login-info ue-clear">
                <div class="welcome ue-clear"><span><?php echo $CONFIG["webname"];?></div>
            </div>
            <div class="toolbar ue-clear">
				<a  class="home-btn"><?php echo "今天是 " . date("Y-m-d");?></a>
                <a href="<?php echo __ADMIN__;?>/logincheck.php?type=logout"  class="home-btn" target="_top">退出</a>
            </div>
        </div>
    </div>
    <div id="bd">
    	<div class="wrap ue-clear">
        	<div class="sidebar">
            	<h2 class="sidebar-header"><p>功能导航</p></h2>
                <ul class="nav">
                	<li class="office current"><div class="nav-header"><a href="main.php" target="right" class="ue-clear"><span>首页</span><i class="icon"></i></a></div></li>
                    <?php $i = 1;$class_art = $mysql->db_get_all("select * from menu where pid=0 and isno=0 and type=0 and auth=3 order by grade asc limit 12");foreach($class_art as $row4) {?>
                    <li <?php if($i==1){?>class="land"<?php }else{?>class="train"<?php }?>><div class="nav-header"><a href="JavaScript:;" class="ue-clear" ><span><?php echo $row4['title'];?></span><i class="icon hasChild"></i></a></div>
                        <ul class="subnav">
                        	<?php $class1_art = $mysql->db_get_all("select * from menu where pid=".$row4["id"]." and isno=0 order by grade asc limit 18");foreach($class1_art as $row5) {?>
                            <li><a href='<?php echo $row5['url'];?>' target='right'><?php echo $row5['title'];?></a></li>
                            <?php }?>
                        </ul>
                    </li>
                    <?php $i=$i+1;  }?>
                    
                </ul>
            </div>
            <div class="content">
            	<iframe src="main.php" id="iframe" width="100%" height="100%" frameborder="0" name="right" style="min-width: 1000px"></iframe>
            </div>
        </div>
    </div>
</div>
</body>
<script type="text/javascript" src="<?php echo __ADMIN__;?>/skin/index/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo __ADMIN__;?>/skin/index/js/core.js"></script>
<script type="text/javascript" src="<?php echo __ADMIN__;?>/skin/index/js/jquery.dialog.js"></script>
<script type="text/javascript" src="<?php echo __ADMIN__;?>/skin/index/js/index.js"></script>
<script src="<?php echo __ADMIN__;?>/skin/index/js/layer_v2.1/layer/layer.js"></script>
<script type="text/javascript">
    function openlayer(id){
        layer.open({
            type: 2,
            title: '修改密码',
            shadeClose: false,
            shade: 0.5,
            skin: 'layui-layer-rim',
//            maxmin: true,
            closeBtn:2,
            area: ['35%', '40%'],
            content: 'password.html'
            //iframe的url
        });
    }
</script>
</html>
