<?php
if(isset($_POST['plain'])){
openssl_public_encrypt($_POST['plain'], $encrypted, $_POST['public']);
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

<form method="post" action="enc.php">
<h2>암호화 할 텍스트</h2>
<textarea name="plain"><?=isset($_POST['plain']) ? $_POST['plain'] : '' ?></textarea>
<h2>공개키</h2>
<textarea name="public"><?=isset($_POST['public']) ? $_POST['public'] : '' ?></textarea>
<h2>결과</h2>
<textarea name="result"><?=base64_encode($encrypted)?></textarea>
<input type="submit">
</form>
<body>
</html>
