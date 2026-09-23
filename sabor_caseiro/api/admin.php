<?php
declare(strict_types=1);
require_once __DIR__.'/../config.php';

if(!bearer()) json_out(['error'=>'Não autenticado'],401);
$r=$_GET['recurso']??'';
$m=$_SERVER['REQUEST_METHOD'];

if($r==='dashboard'&&$m==='GET'){
    $tz=new DateTimeZone('America/Sao_Paulo');
    $inicio=(new DateTimeImmutable('today',$tz))->format(DateTimeInterface::ATOM);
    $fim=(new DateTimeImmutable('tomorrow',$tz))->format(DateTimeInterface::ATOM);
    $filtro='data_pedido=gte.'.q($inicio).'&data_pedido=lt.'.q($fim);
    $pedidos=sb('GET','pedidos?select=id,usuario_id,status,valor_total,data_pedido,usuarios(nome)&'.$filtro.'&order=data_pedido.desc')['data']??[];
    $clientes=sb('GET','usuarios?select=id&tipo=eq.Cliente')['data']??[];
    $tamanhos=sb('GET','tamanhos_marmita?select=id,nome,preco,disponivel,ordem&order=ordem.asc')['data']??[];
    $ids=array_values(array_filter(array_map(fn($x)=>$x['id']??null,$pedidos)));
    $itens=[];
    if($ids){
        $lista='('.implode(',',array_map('intval',$ids)).')';
        $itens=sb('GET','itens_pedido?select=pedido_id,quantidade&pedido_id=in.'.q($lista))['data']??[];
    }
    $validos=array_values(array_filter($pedidos,fn($x)=>($x['status']??'')!=='Cancelado'));
    $faturamento=array_reduce($validos,fn($a,$x)=>$a+(float)($x['valor_total']??0),0.0);
    $emPreparo=count(array_filter($pedidos,fn($x)=>($x['status']??'')==='Em Preparo'));
    $marmitas=array_reduce($itens,fn($a,$x)=>$a+(int)($x['quantidade']??0),0);
    json_out([
        'faturamento_hoje'=>$faturamento,
        'pedidos_hoje'=>count($pedidos),
        'em_preparo'=>$emPreparo,
        'marmitas_vendidas'=>$marmitas,
        'clientes'=>count($clientes),
        'pedidos_recentes'=>array_slice($pedidos,0,5),
        'tamanhos'=>$tamanhos
    ]);
}

if($r==='pedidos'&&$m==='GET') json_out(sb('GET','pedidos?select=*,usuarios(nome,email)&order=data_pedido.desc')['data']);
if($r==='clientes'&&$m==='GET') json_out(sb('GET','usuarios?select=*&tipo=eq.Cliente&order=nome.asc')['data']);
if($r==='ingredientes'&&$m==='GET') json_out(sb('GET','ingredientes?select=*&order=categoria.asc,ordem.asc')['data']);

if($r==='tamanhos'&&$m==='GET') json_out(sb('GET','tamanhos_marmita?select=*&order=ordem.asc')['data']);
if($r==='tamanho'&&$m==='POST'){
    $b=body();
    if(empty($b['nome'])||!isset($b['preco'])) json_out(['error'=>'Nome e preço são obrigatórios.'],422);
    $payload=['nome'=>trim((string)$b['nome']),'descricao'=>$b['descricao']??null,'preco'=>(float)$b['preco'],'max_carboidratos'=>(int)($b['max_carboidratos']??1),'max_proteinas'=>(int)($b['max_proteinas']??1),'max_acompanhamentos'=>(int)($b['max_acompanhamentos']??1),'max_saladas'=>(int)($b['max_saladas']??0),'disponivel'=>(bool)($b['disponivel']??true),'ordem'=>(int)($b['ordem']??0)];
    json_out(sb('POST','tamanhos_marmita',$payload,true,['Prefer: return=representation'])['data'],201);
}
if($r==='tamanho'&&$m==='PATCH'){
    $id=$_GET['id']??'';if(!$id)json_out(['error'=>'Tamanho inválido.'],422);
    json_out(sb('PATCH','tamanhos_marmita?id=eq.'.q($id),body(),true,['Prefer: return=representation'])['data']);
}
if($r==='tamanho'&&$m==='DELETE'){
    $id=$_GET['id']??'';if(!$id)json_out(['error'=>'Tamanho inválido.'],422);
    sb('DELETE','tamanhos_marmita?id=eq.'.q($id),null,true);json_out(['success'=>true]);
}
if($r==='configuracoes'&&$m==='GET'){
    $x=sb('GET','configuracoes_loja?select=*&order=id.asc&limit=1')['data']??[];json_out($x[0]??null);
}
if($r==='configuracoes'&&$m==='PATCH'){
    $b=body();$x=sb('GET','configuracoes_loja?select=id&order=id.asc&limit=1')['data']??[];
    if(!$x) json_out(['error'=>'Configuração da loja não encontrada. Execute o seed do banco.'],404);
    $id=(int)$x[0]['id'];
    $permitidos=['nome_loja','descricao','telefone','whatsapp','endereco','taxa_entrega','pedido_minimo','tempo_entrega_min','tempo_entrega_max','aberto','mensagem_fechado','instagram','marmita_dia_nome','marmita_dia_descricao','marmita_dia_imagem_url','marmita_dia_ativa'];
    $payload=array_intersect_key($b,array_flip($permitidos));
    json_out(sb('PATCH','configuracoes_loja?id=eq.'.q((string)$id),$payload,true,['Prefer: return=representation'])['data']);
}
if($r==='clientes_resumo'&&$m==='GET'){
    $clientes=sb('GET','usuarios?select=id,nome,email,telefone&tipo=eq.Cliente&order=nome.asc')['data']??[];
    $pedidos=sb('GET','pedidos?select=usuario_id,valor_total,status')['data']??[];
    $map=[];foreach($pedidos as $o){if(($o['status']??'')==='Cancelado')continue;$uid=$o['usuario_id']??null;if(!$uid)continue;if(!isset($map[$uid]))$map[$uid]=['pedidos'=>0,'total'=>0.0];$map[$uid]['pedidos']++;$map[$uid]['total']+=(float)($o['valor_total']??0);}
    foreach($clientes as &$c){$r0=$map[$c['id']]??['pedidos'=>0,'total'=>0.0];$c['pedidos']=$r0['pedidos'];$c['total_gasto']=$r0['total'];}unset($c);json_out($clientes);
}

if($r==='ingrediente'&&$m==='POST'){
    $b=body();
    if(empty($b['nome'])||empty($b['categoria'])) json_out(['error'=>'Nome e categoria são obrigatórios.'],422);
    $payload=[
        'nome'=>trim((string)$b['nome']),
        'categoria'=>$b['categoria'],
        'descricao'=>$b['descricao']??null,
        'preco_adicional'=>(float)($b['preco_adicional']??0),
        'disponivel'=>(bool)($b['disponivel']??true)
    ];
    json_out(sb('POST','ingredientes',$payload,true,['Prefer: return=representation'])['data'],201);
}

if($r==='ingrediente'&&$m==='PATCH'){
    $id=$_GET['id']??'';
    if(!$id) json_out(['error'=>'Ingrediente inválido.'],422);
    json_out(sb('PATCH','ingredientes?id=eq.'.q($id),body(),true,['Prefer: return=representation'])['data']);
}

if($r==='ingrediente'&&$m==='DELETE'){
    $id=$_GET['id']??'';
    if(!$id) json_out(['error'=>'Ingrediente inválido.'],422);
    sb('DELETE','ingredientes?id=eq.'.q($id),null,true);
    json_out(['success'=>true]);
}

if($r==='status'&&$m==='PATCH'){
    $id=$_GET['id']??'';
    $b=body();
    $ok=['Pendente','Em Preparo','Saiu para Entrega','Entregue','Cancelado'];
    if(!$id) json_out(['error'=>'Pedido inválido.'],422);
    if(!in_array($b['status']??'',$ok,true)) json_out(['error'=>'Status inválido.'],422);
    json_out(sb('PATCH','pedidos?id=eq.'.q($id),['status'=>$b['status']],true,['Prefer: return=representation'])['data']);
}


if($r==='marmitas_dia'&&$m==='GET'){
    json_out(sb('GET','marmitas_do_dia?select=*,tamanhos_marmita(*),marmitas_do_dia_ingredientes(id,ingrediente_id,quantidade,ingredientes(*))&order=criado_em.desc')['data']??[]);
}
if($r==='marmita_dia'&&$m==='POST'){
    $b=body();
    if(empty($b['nome'])||empty($b['tamanho_id'])) json_out(['error'=>'Nome e tamanho são obrigatórios.'],422);
    $publicar=(bool)($b['publicada']??false);
    if($publicar) sb('PATCH','marmitas_do_dia?publicada=eq.true',['publicada'=>false],true);
    $payload=['nome'=>trim((string)$b['nome']),'descricao'=>$b['descricao']??null,'tamanho_id'=>(int)$b['tamanho_id'],'preco_promocional'=>($b['preco_promocional']??null)===''?null:($b['preco_promocional']??null),'imagem_url'=>$b['imagem_url']??null,'disponivel'=>(bool)($b['disponivel']??true),'publicada'=>$publicar];
    $nova=sb('POST','marmitas_do_dia',$payload,true,['Prefer: return=representation'])['data']??[];
    if(!$nova) json_out(['error'=>'Não foi possível criar a marmita.'],500);
    $id=(int)$nova[0]['id'];
    foreach(array_unique(array_map('intval',$b['ingredientes']??[])) as $iid) if($iid>0) sb('POST','marmitas_do_dia_ingredientes',['marmita_dia_id'=>$id,'ingrediente_id'=>$iid,'quantidade'=>1],true);
    json_out($nova[0],201);
}
if($r==='marmita_dia'&&$m==='PATCH'){
    $id=(int)($_GET['id']??0);$b=body();if(!$id)json_out(['error'=>'Marmita inválida.'],422);
    $publicar=(bool)($b['publicada']??false);
    if($publicar) sb('PATCH','marmitas_do_dia?publicada=eq.true&id=neq.'.q((string)$id),['publicada'=>false],true);
    $permitidos=['nome','descricao','tamanho_id','preco_promocional','imagem_url','disponivel','publicada'];$payload=array_intersect_key($b,array_flip($permitidos));
    sb('PATCH','marmitas_do_dia?id=eq.'.q((string)$id),$payload,true,['Prefer: return=representation']);
    if(array_key_exists('ingredientes',$b)){
        sb('DELETE','marmitas_do_dia_ingredientes?marmita_dia_id=eq.'.q((string)$id),null,true);
        foreach(array_unique(array_map('intval',$b['ingredientes']??[])) as $iid) if($iid>0) sb('POST','marmitas_do_dia_ingredientes',['marmita_dia_id'=>$id,'ingrediente_id'=>$iid,'quantidade'=>1],true);
    }
    json_out(['success'=>true]);
}
if($r==='marmita_dia_publicar'&&$m==='PATCH'){
    $id=(int)($_GET['id']??0);if(!$id)json_out(['error'=>'Marmita inválida.'],422);
    sb('PATCH','marmitas_do_dia?publicada=eq.true',['publicada'=>false],true);
    sb('PATCH','marmitas_do_dia?id=eq.'.q((string)$id),['publicada'=>true,'disponivel'=>true],true);
    json_out(['success'=>true]);
}
if($r==='marmita_dia'&&$m==='DELETE'){
    $id=(int)($_GET['id']??0);if(!$id)json_out(['error'=>'Marmita inválida.'],422);
    sb('DELETE','marmitas_do_dia?id=eq.'.q((string)$id),null,true);json_out(['success'=>true]);
}

json_out(['error'=>'Operação inválida'],400);
