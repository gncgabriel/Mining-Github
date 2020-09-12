<?php
session_start();
require_once __DIR__.'./search_repositories_github/csv.php';

$dir = __DIR__;
$pages = 100;

if(isset($argv[1])){
    $pages = $argv[1];
}else if(isset($_GET['pages'])){
    $pages = $_GET['pages'];
}

if(isset($argv[2])){
    $dir = $argv[2];
}else if(isset($_GET['dir'])){
    $pages = $_GET['dir'];
}

//Diretório para o CSV, Número máximo de páginas
createCsv($dir, $pages);
?>