<?php 
function formatNode($nodes)
{
  foreach ($nodes as $arr => $node) {
    $formated[$arr]['Nome do Repositório'] = $node['name'];
    $formated[$arr]['Username do Proprietário'] = $node['owner']['login'];
    
    $formated[$arr]['Estrelas'] = $node['stargazers']['totalCount'];
    $formated[$arr]['Última Atualização'] = formatDate($node['updatedAt']);
    $formated[$arr]['Pull Requests'] = $node['pullRequests']['totalCount'];
    $formated[$arr]['Releases'] = $node['releases']['totalCount'];
    $formated[$arr]['Anos de Vida'] = (intval(date('Y')) - intval(formatDate($node['createdAt'], 'Y')));


    try{
      $formated[$arr]['Linguagem Primaria'] = $node['primaryLanguage']['name'];
    }catch(Exception $e){
      $formated[$arr]['Linguagem Primaria'] = "Não Informado";
    }

    try {
      $formated[$arr]['Percentual de Issues Fechadas'] = round(intval($node['issuesCloseds']['totalCount']) / intval($node['issues']['totalCount']), 2) * 100;
    } catch (Exception $e) {
      $formated[$arr]['Percentual de Issues Fechadas'] = 0;
    }
  }
  return $formated;
}


function formatDate($date, $format = 'd/m/Y')
{
  $oldDate = new DateTime($date);
  $newDate = $oldDate->format($format);
  return $newDate;
}
