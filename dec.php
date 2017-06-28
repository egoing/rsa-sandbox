<?php
if(isset($_POST['encrypted'])){
openssl_private_decrypt(base64_decode($_POST['encrypted']), $decrypted, $_POST['privKey']);
}
?>
<html>
<head>
<meta charset="utf-8">
<style>
textarea{
	display:block;
	width:100%;
	height:200px;
	margin-bottom:1rem;
}
</style>
</head>
<body>
<form method="post" action="dec.php">
<h1>암호화된  텍스트</h1>
<textarea name="encrypted"><?=isset($_POST['encrypted']) ? $_POST['encrypted'] : '' ?></textarea>
<h1>비밀키</h1>
<textarea name="privKey"><?=isset($_POST['privKey']) ? $_POST['privKey'] : '' ?></textarea>
<h1>결과<h1>
<textarea name="result"><?=$decrypted?></textarea>
<input type="submit">
</form>
<body>
</html>
