<?php
require_once __DIR__ . './query.php';
require_once __DIR__ . './conection.php';
require_once __DIR__ . './formats.php';

function searchRepositories($pages = 0, $stars = null, $first = null)
{

  ini_set('max_execution_time', 0);

  set_error_handler(
    function ($errno, $errstr, $errfile, $errline) {
      throw new ErrorException($errstr, $errno, 0, $errfile, $errline);
    }
  );


  $token1 = '712b574c70b8c3597e57e2890cc7cc66f2d7e283';
  $token2 = '2da37cb04d54dcc3824182c6938898b1314d88e4';
  $token = $token1;

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
      if ($result['data']['rateLimit']['remaining'] == 0) {
        $token = $token2;
      }
      $after = $result["data"]["search"]["pageInfo"]["endCursor"];
      $nodes[] = formatNode($result['data']['search']['nodes']);
      $next_page = $result["data"]["search"]["pageInfo"]["hasNextPage"];
      $pageAtual++;

      echo "\nPágina $pageAtual Carregada";

    } catch (Exception $e) {
      echo "\nTentando Novamente";
    }
    ob_flush();
    ob_end_flush();
  }
  $timeExec = round((microtime(true) - $timeInit) / 60, 2);
  $_SESSION['timeExec'] = $timeExec;
  return $nodes;
}
