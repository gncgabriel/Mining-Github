<?php
session_start();
ini_set('max_execution_time', 0);
require_once __DIR__ . './search_repositories_github/csv.php';
require_once __DIR__ . './search_repositories_github/search.php';

$dir = __DIR__;
$pages = 200;

$token = "TOKEN DE ACESSO";

if (isset($argv[1])) {
    $token = $argv[1];
} else if (isset($_GET['token'])) {
    $token = $_GET['token'];
}

ob_start();

echo "\nIniciando buscas de repositórios\r\n";

ob_flush();
ob_end_flush();

$data = searchRepositories($token, $pages, 5);

if (count($data) > 0) {
    echo "\nRepositórios carregados com sucesso\n";
    echo 'Todo o processo de consulta na API demorou ' . $_SESSION['timeExec'] . ' minutos';
    //Diretório para o CSV, Número máximo de páginas
    createCsv($data, $dir, $pages);
}
