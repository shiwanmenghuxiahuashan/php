<?php

function getIni()
{
    $ini_path = './setup.ini';
    return parse_ini_file($ini_path);
}


$dbConfig = getIni();
var_dump($dbConfig);
die();
// $db =new pdo($dsn,$user,$pwd,array(PDO::ATTR_PERSISTENT=>true));
