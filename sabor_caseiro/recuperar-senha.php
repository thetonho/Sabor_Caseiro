<?php declare(strict_types=1); ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Recuperar senha - Sabor Caseiro</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>
<body>
<main class="signup-wrap d-flex align-items-center justify-content-center py-5 min-vh-100">
  <div class="signup-form-inner">
    <div class="d-flex align-items-center justify-content-center gap-2 mb-3">
      <img src="./img/logoooo.png" alt="Sabor Caseiro" class="logo-img-card">
      <span class="brand-name fs-5">Sabor Caseiro</span>
    </div>
    <div class="text-center mb-4">
      <h2 class="signup-title">Esqueci minha senha</h2>
      <p class="signup-subtitle m-0">Digite seu e-mail e enviaremos um link para criar uma nova senha.</p>
    </div>
    <form id="recovery-form">
      <div class="mb-4">
        <label for="email" class="form-label-custom">E-mail</label>
        <input type="email" class="form-control form-control-custom" id="email" placeholder="seu@email.com" autocomplete="email" required>
      </div>
      <button type="submit" class="btn btn-cta w-100" id="recovery-submit">Enviar link de recuperação</button>
      <p class="login-link mt-3"><a href="login.php"><i class="bi bi-arrow-left"></i> Voltar para o login</a></p>
    </form>
  </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/@supabase/supabase-js@2"></script>
<script src="supabase.js"></script>
<script src="integration.js"></script>
<script src="animations.js"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('recovery-form');
  const btn = document.getElementById('recovery-submit');
  form?.addEventListener('submit', async (e) => {
    e.preventDefault();
    const email = document.getElementById('email').value.trim();
    btn.disabled = true;
    btn.textContent = 'Enviando...';
    try {
      const redirectTo = new URL('redefinir-senha.php', window.location.href).href;
      const { error } = await window.db.auth.resetPasswordForEmail(email, { redirectTo });
      if (error) throw error;
      if (typeof toast === 'function') toast('Se o e-mail estiver cadastrado, você receberá o link de recuperação.');
      form.reset();
    } catch (err) {
      if (typeof toast === 'function') toast(err.message || 'Não foi possível enviar o e-mail.', true);
      else alert(err.message || 'Não foi possível enviar o e-mail.');
    } finally {
      btn.disabled = false;
      btn.textContent = 'Enviar link de recuperação';
    }
  });
});
</script>
</body>
</html>
