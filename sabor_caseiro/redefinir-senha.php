<?php declare(strict_types=1); ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nova senha - Sabor Caseiro</title>
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
      <h2 class="signup-title">Criar nova senha</h2>
      <p class="signup-subtitle m-0" id="reset-status">Digite sua nova senha abaixo.</p>
    </div>
    <form id="reset-form">
      <div class="mb-3">
        <label for="nova-senha" class="form-label-custom">Nova senha</label>
        <div class="password-wrap">
          <input type="password" class="form-control form-control-custom" id="nova-senha" minlength="6" autocomplete="new-password" required>
          <i class="bi bi-eye-slash password-toggle"></i>
        </div>
      </div>
      <div class="mb-4">
        <label for="confirmar-senha" class="form-label-custom">Confirmar nova senha</label>
        <div class="password-wrap">
          <input type="password" class="form-control form-control-custom" id="confirmar-senha" minlength="6" autocomplete="new-password" required>
          <i class="bi bi-eye-slash password-toggle"></i>
        </div>
      </div>
      <button type="submit" class="btn btn-cta w-100" id="reset-submit">Salvar nova senha</button>
      <p class="login-link mt-3"><a href="login.php">Voltar para o login</a></p>
    </form>
  </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/@supabase/supabase-js@2"></script>
<script src="supabase.js"></script>
<script src="integration.js"></script>
<script src="animations.js"></script>
<script>
document.addEventListener('DOMContentLoaded', async () => {
  if (typeof passwordEyes === 'function') passwordEyes();
  const form = document.getElementById('reset-form');
  const btn = document.getElementById('reset-submit');
  const status = document.getElementById('reset-status');

  // O SDK processa os tokens do link de recuperação e cria a sessão temporária.
  await new Promise(resolve => setTimeout(resolve, 250));
  const { data: { session } } = await window.db.auth.getSession();
  if (!session) {
    status.textContent = 'Este link é inválido ou expirou. Solicite um novo link de recuperação.';
    form.querySelectorAll('input, button[type="submit"]').forEach(el => el.disabled = true);
    return;
  }

  form.addEventListener('submit', async (e) => {
    e.preventDefault();
    const senha = document.getElementById('nova-senha').value;
    const confirmar = document.getElementById('confirmar-senha').value;
    if (senha !== confirmar) return typeof toast === 'function' ? toast('As senhas não coincidem.', true) : alert('As senhas não coincidem.');
    if (senha.length < 6) return typeof toast === 'function' ? toast('A senha deve ter pelo menos 6 caracteres.', true) : alert('A senha deve ter pelo menos 6 caracteres.');
    btn.disabled = true;
    btn.textContent = 'Salvando...';
    const { error } = await window.db.auth.updateUser({ password: senha });
    if (error) {
      btn.disabled = false;
      btn.textContent = 'Salvar nova senha';
      return typeof toast === 'function' ? toast(error.message, true) : alert(error.message);
    }
    if (typeof toast === 'function') toast('Senha alterada com sucesso!');
    await window.db.auth.signOut();
    setTimeout(() => window.location.href = 'login.php', 1000);
  });
});
</script>
</body>
</html>
