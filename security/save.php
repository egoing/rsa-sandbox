<?php
$data = file_get_contents('data');
file_put_contents("data", $data."\n".$_POST['important_information']);
 ?>
