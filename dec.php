<?php
if(isset($_POST['encrypted'])){
openssl_private_decrypt(base64_decode($_POST['encrypted']), $decrypted, $_POST['privKey']);
}
?>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<?php
require_once 'nav.php';
?>
<form method="post" action="dec.php">
<h2>암호화된  텍스트</h2>
<textarea name="encrypted"><?=isset($_POST['encrypted']) ? $_POST['encrypted'] : '' ?></textarea>
<h2>비밀키</h2>
<textarea name="privKey"><?=isset($_POST['privKey']) ? $_POST['privKey'] : '' ?></textarea>
<h2>결과</h2>
<textarea name="result"><?=$decrypted?></textarea>
<input type="submit">
</form>
<body>
</html>
