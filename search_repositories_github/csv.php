<?php 
require_once __DIR__ . './search.php';
function createCsv($dir, $pages = null, $stars = null)
{

  $data = searchRepositories($pages, $stars);
  $header = array_keys($data[0][0]);
  $fileContent = '';
  $fileContent .= implode(',', $header);
  $fileContent .= "\r\n";
  $qtdResut = 0;
  foreach ($data as $d => $dv) {
    foreach ($data[$d] as $key => $val) {
      $fileContent .= implode(',', array_values($val));
      $fileContent .= "\r\n";
      $qtdResut++;
    }
  }
  $file = fopen($dir . '/repositorios.csv', 'w+');
  fwrite($file, $fileContent);
  fclose($file);

  echo 'A consulta na API do Git demorou ' . $_SESSION['timeExec'] . ' minutos e trouxe ' . $qtdResut . ' resultados';
}
