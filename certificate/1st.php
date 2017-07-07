<?php
require_once('./config.php');
define('AES_256_CBC', 'aes-256-cbc');
$encryption_key = base64_decode($ase_key); //openssl_random_pseudo_bytes(32);
$parts = explode(':', $_GET['name']);
print_r($parts);
$dec = openssl_decrypt($parts[0], AES_256_CBC, $encryption_key, 0, base64_decode($parts[1]));
?>
<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>clients</title>
    <style>
        @font-face {
            font-family: 'NanumMyeongjo';
            font-style: normal;
            font-weight: 400;
            src: url(//fonts.gstatic.com/ea/nanummyeongjo/v4/NanumMyeongjo-Regular.eot);
            src: url(//fonts.gstatic.com/ea/nanummyeongjo/v4/NanumMyeongjo-Regular.eot?#iefix) format('embedded-opentype'),
            url(//fonts.gstatic.com/ea/nanummyeongjo/v4/NanumMyeongjo-Regular.woff2) format('woff2'),
            url(//fonts.gstatic.com/ea/nanummyeongjo/v4/NanumMyeongjo-Regular.woff) format('woff'),
            url(//fonts.gstatic.com/ea/nanummyeongjo/v4/NanumMyeongjo-Regular.ttf) format('truetype');
        }
        @page { margin: 0; font-family: 'TimesNewRoman', 'Times New Roman', '나눔명조', 'NanumMyeongjo';}
        body { margin: 0; background-color: #ffffff; font-family: 'TimesNewRoman', 'Times New Roman', '나눔명조', 'NanumMyeongjo';}
        p { margin: 0; text-align: center; }
        #container {
            margin: 0 auto; display: block; padding: 0;
            background-image: url('/certificate_of_completion.png');
            background-repeat: no-repeat;
            background-position: center;
            height: 793px;
        }
        #inner {
            margin: 0 auto; display: block; text-align: center;
            padding-top: 340px; font-size: 38pt; color: #E8B348;
        }
        img { margin: 0 auto; display: block; }
    </style>
</head>
<body>
    <p>
        <div id="container">
            <div id="inner">
               <?=htmlspecialchars($dec)?> 
            </div>
        </div>
    </p>
</body>
</html>
