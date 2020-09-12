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


  $token1 = 'ab86ac2ca95ae4a56ac305ea2194b918c8016935';
  $token2 = 'b95af5e71fd7b7e696d2ba03a7d6c01adfd649d9';
  $token = $token1;

  $query = new Query();

  $next_page = true;
  $nodes = array();
  $pageAtual = 0;

  $after = null;

  $timeInit = microtime(true);
  $errs = 0;
  while (($pageAtual <= $pages)) {
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
    } catch (Exception $e) {
    }
  }
  $timeExec = round((microtime(true) - $timeInit) / 60, 2);
  $_SESSION['timeExec'] = $timeExec;
  return $nodes;
}
