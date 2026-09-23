<?php require_once __DIR__.'/../config.php';
if(!bearer())json_out(['error'=>'Não autenticado'],401);$uid=$_GET['id']??'';if(!$uid)json_out(['error'=>'ID obrigatório'],400);
if($_SERVER['REQUEST_METHOD']==='GET')json_out(sb('GET','usuarios?select=*&id=eq.'.q($uid).'&limit=1')['data']);
if($_SERVER['REQUEST_METHOD']==='PATCH')json_out(sb('PATCH','usuarios?id=eq.'.q($uid),body(),true,['Prefer: return=representation'])['data']);json_out(['error'=>'Método inválido'],405);
