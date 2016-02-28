<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Aptoide download link generator</title>
<link rel="stylesheet" type="text/css" href="view.css" media="all">
<script type="text/javascript" src="view.js"></script>

</head>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$url = $_POST['url'];
	$url = str_ireplace('http://m.', 'http://', $url);
	preg_match('/http:\/\/(.*).store.aptoide/', $url, $store);
	$store = $store[1];
	preg_match_all('#(?<=/)[^/]+#', $url, $apk);
	$url2 = str_replace('http://', 'http://m.', $url);
	$data = file_get_contents($url2);
	preg_match('/MD5:<\/strong> (.*)<\/div>/', $data, $md5);
	$md5 = $md5[1];
preg_match('/Version: (.*) \|/', $data, $ver);
$aptoide = json_decode(file_get_contents("http://webservices.aptoide.com/webservices/getApkInfo/" . $store . "/" . $apk[0][3] . "/" . urlencode($ver[1]) . "/json"));
$download = $aptoide->apk->path;
$download2 = $aptoide->apk->altpath;
   }
?>
<body id="main_body" >
	
	<img id="top" src="top.png" alt="">
	<div id="form_container">
	
		<h1><a>Aptoide url</a></h1>
		<form id="form_1107159" class="appnitro"  method="post" action="">
					<div class="form_description">
			<h2>Aptoide download link generator</h2>
			<p>Enter full app url<br><br>Example: http://apps.store.aptoide.com/app/market/com.snapchat.android/778/16259570/Snapchat</p>
		</div>						
			<ul >
			
					<li id="li_1" >
		<label class="description" for="element_1">URL (including http://)</label>
		<div>
			<input id="element_1" name="url" class="element text large" type="text" maxlength="255" value="<?php $_SERVER["PHP_SELF"]; ?>"/> 
		</div> 
		</li>
			
					<li class="buttons">
			    <input type="hidden" name="form_id" value="1107159" />
			    
				<center><input id="saveForm" class="button_text" type="submit" name="submit" value="get download link" /></center>
		</li>
			</ul>
		</form>	
		<div id="footer">
			<?php if(isset($url)) {
		echo '<a href="http://pool.apk.aptoide.com/' . $store . '/' . str_replace('.', '-', $apk[0][3]) . '-' . $apk[0][4] . '-' . $apk[0][5] . '-' . $md5 . '.apk"><h2>Download link 1</h2></a><br>';
		echo '<a href="' . $download . '"><h2>Download link 2</h2></a><br>';
		echo '<a href="' . $download2 . '"><h2>Download link 3</h2></a><br>'; } ?>
		</div>
	</div>
	<img id="bottom" src="bottom.png" alt="">
	<center> thanks to phpform.org </center>
	</body>
</html>