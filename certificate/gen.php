<?php
require_once('./config.php');
define('AES_256_CBC', 'aes-256-cbc');
$encryption_key = base64_decode($ase_key); //openssl_random_pseudo_bytes(32);
$str = '';
$html = '';
if (isset($_POST['data']))
{
    $result = explode("\n", $_POST['data']);
    for ($i = 0; $i < count($result); $i++)
    {
        $row = explode(',', $result[$i]);
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length(AES_256_CBC));
        $name = $row[0];
        $type = $_POST['type'];
        $created = $_POST['created'];
        $period = $_POST['period'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $slogan = $_POST['slogan'];
        $json = json_encode(['name'=>$name, 'type'=>$type, 'created'=>$created, 'period'=>$period, 'title'=>$title, 'description'=>$description, 'slogan'=>$slogan]);
        $encriptedOriginalData = openssl_encrypt($json, AES_256_CBC, $encryption_key, 0, $iv);
        $iv64 = base64_encode($iv);
        $mail = $row[1];
        $enc = urlencode("$encriptedOriginalData:$iv64");
        $str .= "$enc,$mail\n";
        $iframe = isset($_GET['preview']) ? "<iframe src=\"index.php?name={$enc}&xkdlq={$_GET['xkdlq']}\"></iframe>" : '';
        $html .= "
			<li>
				<a href=\"index.php?name={$enc}&xkdlq={$_GET['xkdlq']}&download\">{$row[0]}, {$row[1]}</a>
				{$iframe}
			</li>";
    }
}
?>
<!doctype html>
<html>
<head>
    <link href='https://spoqa.github.io/spoqa-han-sans/css/SpoqaHanSans-kr.css' rel='stylesheet' type='text/css'>
    <style>
        body {
            padding: 1rem;
            margin: 0;
        }
        * {
            font-family: 'Spoqa Han Sans', 'Spoqa Han Sans JP', 'Sans-serif';
            font-weight: 400;
            font-size:1.2rem;
        }

        input {
            width:100%;
        }
        textarea {
            width: 100%;
            height: 10rem;
        }

        ul {
            padding: 0
        }

        iframe {
            display: block;
            width: 100%;
            height: 50rem
        }
    </style>
</head>
<body>
<form method="post">
    <p>
        <input type="text" name="slogan" value="<?=htmlspecialchars(isset($_POST['slogan']) ? $_POST['slogan'] : '')?>">
    </p>
    <p>
        <input type="text" name="title" value="<?=htmlspecialchars(isset($_POST['title']) ? $_POST['title'] : '')?>"  placeholder="제목">
    </p>
    <p>
        <select name="type">
            <option value="start"<?=isset($_POST[type]) && $_POST[type] === 'start' ? ' selected="selected"' : ''?>>시작</option>
            <option value="progression"<?=isset($_POST[type]) && $_POST[type] === 'progression' ? ' selected="selected"' : ''?>>진행</option>
            <option value="complete"<?=isset($_POST[type]) && $_POST[type] === 'complete' ? ' selected="selected"' : ''?>>완주</option>
        </select>
    </p>
    <p>
        <input type="text" name="period" value="<?=htmlspecialchars(isset($_POST['period']) ? $_POST['period'] : '')?>" placeholder="진행일 ex) 2016년 6월 1일 ~ 6월 30일">
    </p>
    <p>
        <input type="text" name="description" value="<?=htmlspecialchars(isset($_POST['description']) ? $_POST['description'] : '')?>" placeholder="설명 ex) 구글과 생활코딩이 함께하는 코딩야학 1기 과정을 수료했기에 이 수료증을 수여합니다.">
    </p>
    <p>
        <input type="text" name="created" value="<?=htmlspecialchars(isset($_POST['created']) ? $_POST['created'] : '')?>" placeholder="발행일 ex) 2016년 6월 1일">
    </p>
    <p>
        <textarea name="data" placeholder="수령자
ex)
egoing, egoing@gg.com
k8805, k8805@kk.com"><?=htmlspecialchars(isset($_POST['data']) ? $_POST['data'] : '')?></textarea>
    </p>

    <p>
        <input type="submit">
    </p>
</form>
<p>
    <textarea><?= ($str) ?></textarea>
</p>
<ul>
    <?= $html ?>
</ul>
</body>
</html>
