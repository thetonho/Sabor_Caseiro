<?php require_once __DIR__.'/../config.php';
$r=$_GET['recurso']??'';
$map=['tamanhos'=>'tamanhos_marmita?select=*&disponivel=eq.true&order=ordem.asc','ingredientes'=>'ingredientes?select=*&disponivel=eq.true&order=categoria.asc,ordem.asc','config'=>'configuracoes_loja?select=*&limit=1'];
if(!isset($map[$r]))json_out(['error'=>'Recurso inválido'],400);json_out(sb('GET',$map[$r],null,false)['data']);
