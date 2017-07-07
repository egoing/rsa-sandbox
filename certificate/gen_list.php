<?php
require_once('./config.php');
define('AES_256_CBC', 'aes-256-cbc');
$encryption_key = base64_decode($ase_key); //openssl_random_pseudo_bytes(32);
$str = '';
$html = '';
if(isset($_POST['data'])){
	$result = explode("\n",$_POST['data']);
	for($i=0; $i<count($result); $i++){
		$row = explode(',',$result[$i]);
		$iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length(AES_256_CBC));
		$sname = openssl_encrypt($row[0], AES_256_CBC, $encryption_key, 0, $iv);
		$iv64 = base64_encode($iv);
		$mail = $row[1];
		$enc = urlencode("$sname:$iv64");
		$str.="$enc,$mail\n";
		$iframe = isset($_GET['preview']) ? "<iframe src=\"1st.php?name={$enc}\"></iframe>" : '';
		$html.="
			<li>
				<a href=\"1st.php?name={$enc}&download\">{$row[0]}, {$row[1]}</a>
				{$iframe}
			</li>";	
	}
}
?>
<!doctype html>
<html>
<head>
<style>
body{padding:0;margin:0}
textarea{width:100%; height:5rem;}
ul{padding:0}
iframe{display:block; width:100%; height:50rem}
</style>
</head>
<body>
<form method="post">
<textarea name="data"><?=isset($_POST['data']) ? $_POST['data'] : ''?></textarea>
<input type="submit">
</form>
<textarea><?=htmlspecialchars($str)?></textarea>
<ul>
	<?=$html?>
</ul>
</body>
</html>
