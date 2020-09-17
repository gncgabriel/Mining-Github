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

  $next_page = true;
  $nodes = array();
  $pageAtual = 0;

  $after = null;

  $timeInit = microtime(true);
  $errs = 0;
  while (($pageAtual < $pages)) {
    ob_start();
    try {
      $nextQuery['query'] = $query->mountQuery($stars, $first, $after);
      $result = executaQuery($nextQuery, $token);
      $after = $result["data"]["search"]["pageInfo"]["endCursor"];
      $nodes[] = formatNode($result['data']['search']['nodes']);
      $next_page = $result["data"]["search"]["pageInfo"]["hasNextPage"];
      $pageAtual++;
      echo "\nPágina $pageAtual Carregada. Token Remaining: " . $result['data']['rateLimit']['remaining'];
    } catch (Exception $e) {
      // var_dump($result);
      // var_dump($e);
      echo "\nTentando Novamente";
    }

    ob_flush();
    ob_end_flush();
  }
  $timeExec = round((microtime(true) - $timeInit) / 60, 2);
  $_SESSION['timeExec'] = $timeExec;
  return $nodes;
}
