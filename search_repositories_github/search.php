<?php
require_once __DIR__ . './query.php';
require_once __DIR__ . './conection.php';
require_once __DIR__ . './formats.php';

function searchRepositories($token, $pages = 0, $first = null, $stars = null)
{

  set_error_handler(
    function ($errno, $errstr, $errfile, $errline) {
      throw new ErrorException($errstr, $errno, 0, $errfile, $errline);
    }
  );

  $query = new Query();

  $nodes = array();
  $pageAtual = 0;

  $after = null;

  $timeInit = microtime(true);
  while (($pageAtual < $pages)) {
    ob_start();
    try {
      $timeWhile = microtime(true);

      $nextQuery['query'] = $query->mountQuery($stars, $first, $after);
      $result = executaQuery($nextQuery, $token);
      $after = $result["data"]["search"]["pageInfo"]["endCursor"];
      $nodes[] = formatNode($result['data']['search']['nodes']);
      $next_page = $result["data"]["search"]["pageInfo"]["hasNextPage"];
      $pageAtual++;

      $timeSearchPage = round((microtime(true) - $timeWhile), 2);
      $timeTotal = round((microtime(true) - $timeInit) / 60, 2);
      echo "\nPágina $pageAtual carregada.\nTempo Total Gasto: $timeTotal minutos.\n\n";
    } catch (Exception $e) {
      echo "\n\nTentando Novamente";
    }

    ob_flush();
    ob_end_flush();
  }
  $timeExec = round((microtime(true) - $timeInit) / 60, 2);
  $_SESSION['timeExec'] = $timeExec;
  return $nodes;
}
