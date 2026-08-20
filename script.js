document.addEventListener("DOMContentLoaded", () => {
  // =========================================================
  // 1. SISTEMA DE TEMA (CLARO / ESCURO)
  // =========================================================
  const themeToggleBtn = document.getElementById("theme-toggle");
  const currentTheme = localStorage.getItem("theme");

  // Aplica o tema salvo previamente (se houver)
  if (currentTheme === "dark") {
    document.documentElement.setAttribute("data-theme", "dark");
    updateThemeIcon(true);
  }

  if (themeToggleBtn) {
    themeToggleBtn.addEventListener("click", () => {
      const isDark = document.documentElement.getAttribute("data-theme") === "dark";

      if (isDark) {
        document.documentElement.removeAttribute("data-theme");
        localStorage.setItem("theme", "light");
        updateThemeIcon(false);
      } else {
        document.documentElement.setAttribute("data-theme", "dark");
        localStorage.setItem("theme", "dark");
        updateThemeIcon(true);
      }
    });
  }

  function updateThemeIcon(isDark) {
    if (!themeToggleBtn) return;
    const icon = themeToggleBtn.querySelector("i") || themeToggleBtn;
    
    if (isDark) {
      icon.classList.remove("bi-moon-stars-fill");
      icon.classList.add("bi-sun-fill");
    } else {
      icon.classList.remove("bi-sun-fill");
      icon.classList.add("bi-moon-stars-fill");
    }
  }

  // =========================================================
  // 2. SISTEMA DO CARRINHO
  // =========================================================
  let cartCount = 0;

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
  // 3. MOSTRAR / OCULTAR SENHA
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