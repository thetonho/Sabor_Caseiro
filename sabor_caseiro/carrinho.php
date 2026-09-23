<?php
declare(strict_types=1);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sabor Caseiro - Carrinho</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

  <!-- Estilos Customizados -->
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <!-- ===== HEADER ===== -->
  <header class="site-header">
    <div class="container-fluid px-4">
      <div class="d-flex align-items-center justify-content-between py-2">

        <!-- Logo e Navegação -->
        <div class="d-flex align-items-center gap-4">
          <a href="index.php" class="navbar-brand me-2">
            <img src="./img/logoooo.png" alt="Sabor Caseiro" class="logo-img">
          </a>
          <nav class="d-none d-md-flex gap-4">
            <a href="index.php" class="nav-link-custom">Início</a>
            <a href="montarmarmita.php" class="nav-link-custom">Montar Marmita</a>
          </nav>
        </div>

        <!-- Carrinho e Autenticação -->
        <div class="d-flex align-items-center gap-3 gap-md-4">

          <!-- Carrinho -->
          <a href="carrinho.php" class="cart-btn" aria-label="Carrinho">
            <i class="bi bi-cart-fill"></i>
            <span class="cart-badge">0</span>
          </a>

          <a href="login.php" class="nav-link-custom">Entrar</a>
          <a href="cadastro.php" class="nav-link-custom">Cadastrar</a>
        </div>

      </div>
    </div>
  </header>

  <!-- ===== CONTEÚDO DO CARRINHO ===== -->
  <main class="cart-section">
    <div class="container">

      <!-- ESTADO: CARRINHO VAZIO -->
      <div class="cart-empty text-center py-5">
        <h2 class="cart-empty-title">Seu carrinho está vazio</h2>
        <p class="cart-empty-subtitle">Que tal pedir uma marmita deliciosa?</p>
        <a href="montarmarmita.php" class="btn btn-cta">
          Montar Marmita <i class="bi bi-arrow-right"></i>
        </a>
      </div>

      <!-- ESTADO: CARRINHO COM ITENS (Exemplo estrutural)
      <div class="cart-items">
        <div class="cart-item">
          ...
        </div>
      </div>
      -->

    </div>
  </main>

  <!-- Bootstrap JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
  <!-- JavaScript Customizado -->
  <script src="https://cdn.jsdelivr.net/npm/@supabase/supabase-js@2"></script>
  <script src="supabase.js"></script>
  <script src="integration.js"></script>
  <script src="animations.js"></script>
</body>
</html>