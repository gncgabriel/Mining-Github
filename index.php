<?php
session_start();
require_once __DIR__ . './search_repositories_github/csv.php';
require_once __DIR__ . './search_repositories_github/search.php';

$dir = __DIR__;
$pages = 100;
$token = "TOKEN DE ACESSO";

if (isset($argv[1])) {
    $pages = $argv[1];
} else if (isset($_GET['pages'])) {
    $pages = $_GET['pages'];
}

if (isset($argv[2])) {
    $dir = $argv[2];
} else if (isset($_GET['dir'])) {
    $dir = $_GET['dir'];
}

if (isset($argv[3])) {
    $token = $argv[3];
} else if (isset($_GET['token'])) {
    $token = $_GET['token'];
}

ob_start();

echo "\nIniciando buscas de repositórios\r\n";

ob_flush();
ob_end_flush();

$data = searchRepositories($token, $pages);

echo "\nRepositórios carregados com sucesso\n";
echo 'A consulta na API do Git demorou ' . $_SESSION['timeExec'] . ' minutos';
//Diretório para o CSV, Número máximo de páginas
createCsv($data, $dir, $pages);
