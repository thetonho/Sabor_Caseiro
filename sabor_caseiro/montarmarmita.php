<?php
declare(strict_types=1);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sabor Caseiro - Montar Marmita</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>
<body>
<header class="site-header">
  <div class="container-fluid px-3 px-md-4">
    <div class="d-flex align-items-center justify-content-between py-2 header-inner">
      <div class="d-flex align-items-center gap-3 gap-md-4">
        <a href="index.php" class="navbar-brand me-0 me-md-2"><img src="./img/logoooo.png" alt="Sabor Caseiro" class="logo-img"></a>
        <nav class="d-none d-md-flex gap-4"><a href="index.php" class="nav-link-custom">Início</a><a href="montarmarmita.php" class="nav-link-custom">Montar Marmita</a></nav>
      </div>
      <div class="d-flex align-items-center gap-2 gap-md-4 header-actions">
        <a href="carrinho.php" class="cart-btn" aria-label="Carrinho"><i class="bi bi-cart-fill"></i><span class="cart-badge">0</span></a>
        <a href="login.php" class="nav-link-custom">Entrar</a><a href="cadastro.php" class="nav-link-custom d-none d-sm-inline">Cadastrar</a>
      </div>
    </div>
  </div>
</header>
<main class="container py-4 py-md-5 marmita-builder" id="marmita-builder">
  <div class="text-center mb-4"><h2 class="mb-2">Monte sua marmita</h2><p class="text-secondary mb-0">Escolha do seu jeito. Os limites e preços vêm direto do cardápio.</p></div>
  <div id="marmita-steps" class="marmita-steps mb-4" aria-label="Etapas da montagem"></div>
  <section class="marmita-stage" aria-live="polite">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2 mb-4">
      <div><h3 id="marmita-stage-title" class="marmita-section-title mb-1">Escolha o tamanho</h3><p id="marmita-stage-help" class="text-secondary mb-0"></p></div>
      <span id="marmita-limit" class="marmita-limit d-none"></span>
    </div>
    <div id="marmita-options" class="row g-3 g-md-4"></div>
  </section>
  <div class="marmita-summary marmita-summary-single mt-4">
    <button type="button" id="marmita-back" class="btn-back-marmita" disabled><i class="bi bi-arrow-left"></i> Voltar</button>
    <div class="summary-total"><span>Valor total</span><strong>R$ 0,00</strong></div>
    <button type="button" id="marmita-next" class="btn-next-marmita">Continuar <i class="bi bi-arrow-right"></i></button>
  </div>
</main>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@supabase/supabase-js@2"></script>
<script src="supabase.js"></script>
<script src="integration.js"></script>
  <script src="animations.js"></script>
</body>
</html>
