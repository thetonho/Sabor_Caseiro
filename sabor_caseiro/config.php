<?php
declare(strict_types=1);
const SUPABASE_URL='https://bbguspmkegjrsyfcqaxy.supabase.co';
const SUPABASE_PUBLISHABLE_KEY='sb_publishable_9K73pJ8leAiRtwM13jp0fA_yh88wmV6';
function json_out($data,int $status=200):never{http_response_code($status);header('Content-Type: application/json; charset=utf-8');echo json_encode($data,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);exit;}
function body():array{$v=json_decode(file_get_contents('php://input'),true);return is_array($v)?$v:[];}
function bearer():?string{$h=$_SERVER['HTTP_AUTHORIZATION']??'';return preg_match('/^Bearer\s+(.+)$/i',$h,$m)?$m[1]:null;}
function sb(string $method,string $path,?array $payload=null,bool $auth=true,array $headers=[]):array{
 $token=$auth?bearer():null;$hs=['apikey: '.SUPABASE_PUBLISHABLE_KEY,'Authorization: Bearer '.($token?:SUPABASE_PUBLISHABLE_KEY),'Accept: application/json'];
 if($payload!==null)$hs[]='Content-Type: application/json';$hs=array_merge($hs,$headers);$ch=curl_init(SUPABASE_URL.'/rest/v1/'.$path);
 curl_setopt_array($ch,[CURLOPT_RETURNTRANSFER=>true,CURLOPT_CUSTOMREQUEST=>$method,CURLOPT_HTTPHEADER=>$hs,CURLOPT_POSTFIELDS=>$payload!==null?json_encode($payload,JSON_UNESCAPED_UNICODE):null]);
 $raw=curl_exec($ch);$code=(int)curl_getinfo($ch,CURLINFO_HTTP_CODE);if($raw===false)json_out(['error'=>'Falha ao conectar ao Supabase.'],500);curl_close($ch);$data=$raw===''?null:json_decode($raw,true);if($code>=400)json_out(['error'=>$data['message']??$data['hint']??'Erro no Supabase','details'=>$data],$code);return ['status'=>$code,'data'=>$data];
}
function q(string $v):string{return rawurlencode($v);}
