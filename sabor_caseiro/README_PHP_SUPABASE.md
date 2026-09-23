# Sabor Caseiro — PHP + Supabase

O design original foi preservado. O projeto continua usando Supabase (PostgreSQL/Auth/RLS), mas operações sensíveis passam pelo PHP.

## O que ficou em PHP
- criação/finalização de pedidos;
- recálculo de preços no servidor (não confia no preço do navegador);
- taxa de entrega buscada no banco;
- consultas e alterações do painel administrativo;
- validação de status de pedido;
- endpoints preparados para perfil e dados públicos.

## O que ficou em JavaScript
- interface, carrinho temporário e navegação;
- Supabase Auth (login/cadastro/sessão), pois o SDK do navegador gerencia a sessão muito bem;
- renderização dinâmica das telas.

## Requisitos
- PHP 8+ com extensão cURL;
- servidor PHP/Apache (Live Server sozinho NÃO executa PHP);
- banco Supabase criado com `banco_supabase.sql`.

## Rodar localmente
No terminal, dentro da pasta do projeto:

`php -S localhost:8000`

Depois abra `http://localhost:8000/`.

## Segurança
`config.php` contém apenas a Publishable Key. Nunca coloque Secret/Service Role Key no frontend ou neste pacote. As requisições autenticadas encaminham o access token do usuário, portanto o RLS do Supabase continua valendo.


## Páginas PHP
As páginas principais agora usam extensão `.php`: `index.php`, `login.php`, `cadastro.php`, `carrinho.php`, `administrador.php` e as etapas `montarmarmita*.php`. Todos os links e redirecionamentos internos foram atualizados para `.php`. O design/CSS foi preservado.

Execute com `php -S localhost:8000` e abra `http://localhost:8000/index.php`.
