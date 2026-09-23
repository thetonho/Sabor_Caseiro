<?php
declare(strict_types=1);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sabor Caseiro - Início</title>

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

  <!-- ===== CONTEÚDO PRINCIPAL (HERO) ===== -->
  <main class="hero-section d-flex align-items-center py-5">
    <div class="container">
      <div class="row align-items-center g-5">
        
        <!-- Lado Esquerdo: Texto Hero -->
        <div class="col-lg-6">
          <div class="badge-pill mb-3">
            Comida caseira & saudável
          </div>
          <h1 class="hero-title">
            Sua <span class="text-accent">marmita</span> com sabor de casa
          </h1>
          <p class="hero-subtitle">
            Alimentação de verdade, preparada diariamente com ingredientes selecionados e o tempero afetuoso que você merece.
          </p>
          <div class="mt-4">
            <a href="montarmarmita.php" class="btn btn-cta">
              Montar Marmita <i class="bi bi-arrow-right"></i>
            </a>
          </div>
        </div>

        <!-- Lado Direito: Card "Cardápio do Dia" -->
        <div class="col-lg-6 d-flex justify-content-center">
          <div class="menu-card">
            <h2 class="menu-card-title">Cardápio do dia</h2>
            
            <div class="menu-card-img-wrap">
              <img src="https://placehold.co/600x400/png?text=Foto+do+Prato" alt="Frango empanado com acompanhamentos" class="menu-card-img">
            </div>

            <div class="menu-card-content">
              <h3 class="menu-card-dish">Frango empanado</h3>
              <p class="menu-card-subtitle">acompanhado por:</p>
              <p class="menu-card-desc">arroz, batata rústica, creme de milho e frango empanado</p>
              <div class="d-flex justify-content-between align-items-center gap-3 mb-3">
                <span class="menu-card-size fw-semibold"></span>
                <strong class="menu-card-price fs-4"></strong>
              </div>
              <button id="add-marmita-dia" type="button" class="btn btn-cta w-100">
                Adicionar ao carrinho <i class="bi bi-cart-plus"></i>
              </button>
            </div>
          </div>
        </div>

      </div>
    </div>
  </main>

  <!-- ===== CONTATO / RODAPÉ ===== -->
  <footer class="site-footer" id="contato-loja">
    <div class="container">
      <div class="store-footer-grid">
        <div>
          <h2 id="footer-store-name">Sabor Caseiro</h2>
          <p id="footer-store-description">Comida caseira feita com carinho.</p>
        </div>
        <div class="store-footer-contact">
          <a id="footer-address" class="store-contact-item d-none" href="#" target="_blank" rel="noopener noreferrer"><i class="bi bi-geo-alt-fill"></i><span></span></a>
          <a id="footer-phone" class="store-contact-item d-none" href="#"><i class="bi bi-telephone-fill"></i><span></span></a>
          <a id="footer-instagram" class="store-contact-item d-none" href="#" target="_blank" rel="noopener noreferrer"><i class="bi bi-instagram"></i><span></span></a>
        </div>
      </div>
      <div class="store-footer-bottom">© <span id="footer-year"></span> <span id="footer-store-name-bottom">Sabor Caseiro</span></div>
    </div>
  </footer>

  <a id="floating-whatsapp" class="floating-whatsapp d-none" href="#" target="_blank" rel="noopener noreferrer" aria-label="Falar com a loja pelo WhatsApp">
    <i class="bi bi-whatsapp"></i><span>WhatsApp</span>
  </a>

  <!-- Bootstrap JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
  <!-- JavaScript Customizado -->
  <script src="https://cdn.jsdelivr.net/npm/@supabase/supabase-js@2"></script>
  <script src="supabase.js"></script>
  <script src="integration.js"></script>
  <script src="animations.js"></script>
</body>
</html>