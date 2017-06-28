<?php
if(isset($_POST['plain'])){
openssl_public_encrypt($_POST['plain'], $encrypted, $_POST['public']);
}
?>
<html>
<head>
<meta charset="utf-8">
<style>
textarea{
	display:block;
	width:100%;
	height:100px;
	margin-bottom:1rem;
}
</style>
</head>
<body>
<form method="post" action="enc.php">
<h1>암호화 할 텍스트</h1>
<textarea name="plain"><?=isset($_POST['plain']) ? $_POST['plain'] : '' ?></textarea>
<h1>공개키</h1>
<textarea name="public"><?=isset($_POST['public']) ? $_POST['public'] : '' ?></textarea>
<h1>결과<h1>
<textarea name="result"><?=base64_encode($encrypted)?></textarea>
<input type="submit">
</form>
<body>
</html>
