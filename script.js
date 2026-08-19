document.addEventListener("DOMContentLoaded", () => {
  // =========================================================
  // 1. SISTEMA DO CARRINHO (APENAS BOTÃO DE MARMITA)
  // =========================================================
  let cartCount = 0;

  // Seleciona APENAS os botões que possuem a classe .btn-add-cart
  const btnAddCart = document.querySelectorAll(".btn-add-cart");
  const cartBtnFooter = document.querySelector(".site-footer .bi-cart-fill")?.parentElement;
  const cartBadgeHeader = document.querySelector(".cart-badge");

  function atualizarCarrinho() {
    if (cartBadgeHeader) {
      cartBadgeHeader.textContent = cartCount;
    }

    if (cartBtnFooter) {
      cartBtnFooter.style.position = "relative";
      cartBtnFooter.setAttribute("data-count", cartCount);
    }
  }

  // Só adiciona ao carrinho se for o botão do produto
  btnAddCart.forEach((button) => {
    button.addEventListener("click", (e) => {
      e.preventDefault();
      cartCount++;

      atualizarCarrinho();
      alert(`Marmita adicionada ao carrinho! Total: ${cartCount}`);
    });
  });

  if (cartBtnFooter) {
    cartBtnFooter.addEventListener("click", () => {
      if (cartCount === 0) {
        alert("Seu carrinho está vazio. Monte sua marmita primeiro!");
      } else {
        alert(`Você tem ${cartCount} marmita(s) no carrinho!`);
      }
    });
  }

  // =========================================================
  // 2. MOSTRAR / OCULTAR SENHA
  // =========================================================
  const passwordToggles = document.querySelectorAll(".password-toggle");

  passwordToggles.forEach((toggle) => {
    toggle.addEventListener("click", function () {
      const input = this.previousElementSibling;

      if (input && (input.type === "password" || input.type === "text")) {
        if (input.type === "password") {
          input.type = "text";
          this.classList.remove("bi-eye-slash");
          this.classList.add("bi-eye");
        } else {
          input.type = "password";
          this.classList.remove("bi-eye");
          this.classList.add("bi-eye-slash");
        }
      }
    });
  });
});
