<?php

function createCsv($data, $dir, $pages = null, $stars = null)
{
  $header = array_keys($data[0][0]);
  $fileContent = '';
  $fileContent .= implode(',', $header);
  $fileContent .= "\r\n";
  $qtdResut = 0;
  ob_start();
  echo "\n\nGerando CSV em: $dir\n\n";
  ob_flush();
  ob_end_flush();
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

  ob_start();
  echo "\nArquivo CSV gerado com sucesso\n";
  ob_flush();
  ob_end_flush();
}
