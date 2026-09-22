document.addEventListener("DOMContentLoaded", () => {

  /* =========================================================
     CONFIGURAÇÕES / BANCO LOCAL
     ========================================================= */

  const STORAGE = {
    theme: "saborcaseiro_theme",
    menu: "saborcaseiro_menu",
    dailyMenu: "saborcaseiro_daily_menu",
    cart: "saborcaseiro_cart",
    orders: "saborcaseiro_orders",
    customers: "saborcaseiro_customers",
    marmita: "saborcaseiro_marmita"
  };

  const defaultMenu = [
    {
      id: "marmita-p",
      name: "Marmita Pequena",
      price: 15,
      description: "Arroz, feijão, proteína e acompanhamento.",
      active: true,
      image: ""
    },
    {
      id: "marmita-m",
      name: "Marmita Média",
      price: 18,
      description: "Arroz, feijão, proteína e acompanhamento.",
      active: true,
      image: ""
    },
    {
      id: "marmita-g",
      name: "Marmita Grande",
      price: 22,
      description: "Arroz, feijão, proteína e acompanhamento.",
      active: true,
      image: ""
    }
  ];

  const defaultProteins = [
    {
      id: "prot-frango",
      name: "Frango Empanado",
      description: "Peito de frango empanado temperado.",
      image: ""
    },
    {
      id: "prot-carne",
      name: "Carne de Panela",
      description: "Carne bovina cozida lentamente.",
      image: ""
    },
    {
      id: "prot-peixe",
      name: "Peixe Grelhado",
      description: "Filé de tilápia grelhado.",
      image: ""
    },
    {
      id: "prot-ovo",
      name: "Ovo Cozido",
      description: "Ovos cozidos.",
      image: ""
    },
    {
      id: "prot-strogonoff",
      name: "Strogonoff de Frango",
      description: "Strogonoff de frango cremoso.",
      image: ""
    }
  ];

  const defaultCarbs = [
    {
      id: "carb-arroz",
      name: "Arroz Branco",
      description: "100 gramas de arroz branco",
      image: ""
    },
    {
      id: "carb-integral",
      name: "Arroz Integral",
      description: "100 gramas de arroz integral",
      image: ""
    },
    {
      id: "carb-feijao",
      name: "Feijão Carioca",
      description: "100 gramas de feijão carioca",
      image: ""
    },
    {
      id: "carb-preto",
      name: "Feijão Preto",
      description: "100 gramas de feijão preto",
      image: ""
    },
    {
      id: "carb-macarrao",
      name: "Macarrão",
      description: "100 gramas de macarrão",
      image: ""
    }
  ];

  const defaultAccompaniments = [
    {
      id: "acomp-batata",
      name: "Batata Rústica",
      description: "Batata assada temperada.",
      image: ""
    },
    {
      id: "acomp-pure",
      name: "Purê de Batata",
      description: "Purê de batata cremoso.",
      image: ""
    },
    {
      id: "acomp-legumes",
      name: "Legumes",
      description: "Legumes selecionados.",
      image: ""
    }
  ];


  /* =========================================================
     FUNÇÕES AUXILIARES
     ========================================================= */

  function getData(key, fallback) {
    try {
      const data = localStorage.getItem(key);
      return data ? JSON.parse(data) : fallback;
    } catch {
      return fallback;
    }
  }

  function saveData(key, data) {
    localStorage.setItem(key, JSON.stringify(data));
  }

  function money(value) {
    return Number(value || 0).toLocaleString("pt-BR", {
      style: "currency",
      currency: "BRL"
    });
  }

  function generateId(prefix = "id") {
    return `${prefix}-${Date.now()}-${Math.random()
      .toString(36)
      .substring(2, 7)}`;
  }


  /* =========================================================
     INICIALIZAÇÃO
     ========================================================= */

  if (!localStorage.getItem(STORAGE.menu)) {
    saveData(STORAGE.menu, defaultMenu);
  }

  if (!localStorage.getItem("saborcaseiro_proteins")) {
    saveData("saborcaseiro_proteins", defaultProteins);
  }

  if (!localStorage.getItem("saborcaseiro_carbs")) {
    saveData("saborcaseiro_carbs", defaultCarbs);
  }

  if (!localStorage.getItem("saborcaseiro_accompaniments")) {
    saveData(
      "saborcaseiro_accompaniments",
      defaultAccompaniments
    );
  }

  if (!localStorage.getItem(STORAGE.orders)) {
    saveData(STORAGE.orders, [
      {
        id: 1024,
        customer: "João Silva",
        items: "2 marmitas",
        total: 38,
        status: "preparing",
        statusLabel: "Em preparo"
      },
      {
        id: 1023,
        customer: "Maria Oliveira",
        items: "1 marmita",
        total: 32,
        status: "delivery",
        statusLabel: "Entrega"
      },
      {
        id: 1022,
        customer: "Carlos Souza",
        items: "1 marmita",
        total: 25,
        status: "finished",
        statusLabel: "Concluído"
      }
    ]);
  }

  if (!localStorage.getItem(STORAGE.customers)) {
    saveData(STORAGE.customers, [
      {
        id: generateId("cliente"),
        name: "João Silva",
        email: "joao@email.com",
        phone: "(16) 99999-9999",
        address: "",
        orders: 12,
        spent: 380
      },
      {
        id: generateId("cliente"),
        name: "Maria Oliveira",
        email: "maria@email.com",
        phone: "(16) 98888-8888",
        address: "",
        orders: 8,
        spent: 256
      }
    ]);
  }


  /* =========================================================
     TEMA
     ========================================================= */

  const themeToggleBtn = document.getElementById("theme-toggle");

  function updateThemeIcon(isDark) {
    if (!themeToggleBtn) return;

    const icon =
      themeToggleBtn.querySelector("i") ||
      themeToggleBtn;

    icon.classList.toggle("bi-moon-stars-fill", !isDark);
    icon.classList.toggle("bi-sun-fill", isDark);
  }

  const savedTheme =
    localStorage.getItem(STORAGE.theme);

  if (savedTheme === "dark") {
    document.documentElement.setAttribute(
      "data-theme",
      "dark"
    );
    updateThemeIcon(true);
  } else {
    updateThemeIcon(false);
  }

  if (themeToggleBtn) {
    themeToggleBtn.addEventListener("click", () => {

      const isDark =
        document.documentElement.getAttribute(
          "data-theme"
        ) === "dark";

      if (isDark) {
        document.documentElement.removeAttribute(
          "data-theme"
        );

        localStorage.setItem(
          STORAGE.theme,
          "light"
        );

        updateThemeIcon(false);

      } else {

        document.documentElement.setAttribute(
          "data-theme",
          "dark"
        );

        localStorage.setItem(
          STORAGE.theme,
          "dark"
        );

        updateThemeIcon(true);
      }
    });
  }


  /* =========================================================
     NAVEGAÇÃO DO PAINEL ADMINISTRATIVO
     ========================================================= */

  const sidebarItems =
    document.querySelectorAll(".sidebar-item");

  const adminSections =
    document.querySelectorAll(".admin-section");

  function openAdminSection(sectionId) {

    adminSections.forEach(section => {
      section.classList.remove(
        "active-section"
      );
    });

    sidebarItems.forEach(item => {
      item.classList.remove("active");
    });

    const section =
      document.getElementById(sectionId);

    if (section) {
      section.classList.add(
        "active-section"
      );
    }

    const sidebarButton =
      document.querySelector(
        `.sidebar-item[data-section="${sectionId}"]`
      );

    if (sidebarButton) {
      sidebarButton.classList.add("active");
    }

    if (sectionId === "pedidos") {
      renderOrders();
    }

    if (sectionId === "cardapio") {
      renderMenuAdmin();
    }

    if (sectionId === "clientes") {
      renderCustomers();
    }

    if (sectionId === "dashboard") {
      updateDashboard();
    }
  }

  sidebarItems.forEach(item => {
    item.addEventListener("click", () => {
      openAdminSection(
        item.dataset.section
      );
    });
  });

  document
    .querySelectorAll("[data-section-link]")
    .forEach(button => {

      button.addEventListener("click", () => {
        openAdminSection(
          button.dataset.sectionLink
        );
      });

    });


  /* =========================================================
     CARDÁPIO DO DIA
     ========================================================= */

  const publishButton =
    [...document.querySelectorAll(".btn-cta")]
      .find(button =>
        button.textContent
          .toLowerCase()
          .includes("enviar cardápio")
      );

  if (publishButton) {

    publishButton.addEventListener(
      "click",
      publishDailyMenu
    );
  }

  function publishDailyMenu() {

    const menu =
      getData(STORAGE.menu, defaultMenu);

    const activeMenus =
      menu.filter(item => item.active);

    if (!activeMenus.length) {
      alert(
        "Não existem marmitas ativas no cardápio."
      );
      return;
    }

    const current =
      getData(STORAGE.dailyMenu, null);

    const defaultDish =
      current || {
        title: "Frango empanado",
        description:
          "arroz, batata rústica, creme de milho e frango empanado",
        image:
          "https://placehold.co/600x400/png?text=Foto+do+Prato"
      };

    saveData(
      STORAGE.dailyMenu,
      {
        ...defaultDish,
        publishedAt: new Date().toISOString()
      }
    );

    alert(
      "Cardápio do dia enviado para a página inicial!"
    );

    renderDailyMenuPreview();
  }


  /* =========================================================
     PÁGINA INICIAL - CARDÁPIO DO DIA
     ========================================================= */

  function renderDailyMenuPreview() {

    const daily =
      getData(STORAGE.dailyMenu, null);

    if (!daily) return;

    const dish =
      document.querySelector(".menu-card-dish");

    const desc =
      document.querySelector(".menu-card-desc");

    const image =
      document.querySelector(".menu-card-img");

    if (dish) {
      dish.textContent = daily.title;
    }

    if (desc) {
      desc.textContent = daily.description;
    }

    if (image && daily.image) {
      image.src = daily.image;
    }
  }

  renderDailyMenuPreview();


  /* =========================================================
     CARDÁPIO ADMINISTRATIVO
     ========================================================= */

  function renderMenuAdmin() {

    const section =
      document.getElementById("cardapio");

    if (!section) return;

    const container =
      section.querySelector(".row.g-4");

    if (!container) return;

    const menu =
      getData(STORAGE.menu, defaultMenu);

    container.innerHTML = "";

    menu.forEach(item => {

      const col =
        document.createElement("div");

      col.className =
        "col-lg-4 col-md-6";

      col.innerHTML = `
        <div class="menu-admin-card">

          <div class="menu-admin-image">
            ${
              item.image
                ? `<img src="${item.image}"
                        alt="${item.name}"
                        style="width:100%;height:100%;object-fit:cover;">`
                : `<i class="bi bi-egg-fried"></i>`
            }
          </div>

          <div class="menu-admin-info">

            <div class="d-flex justify-content-between gap-2">
              <h3>${item.name}</h3>

              <span class="${item.active ? "available" : "unavailable"}">
                ${item.active ? "Ativo" : "Inativo"}
              </span>
            </div>

            <p>${item.description}</p>

            <strong>${money(item.price)}</strong>

            <div class="menu-actions">

              <button
                class="btn-outline-custom edit-menu"
                data-id="${item.id}">
                <i class="bi bi-pencil"></i>
                Editar
              </button>

              <button
                class="delete-btn delete-menu"
                data-id="${item.id}">
                <i class="bi bi-trash"></i>
              </button>

            </div>

          </div>

        </div>
      `;

      container.appendChild(col);
    });

    const addButton =
      section.querySelector(
        ".section-header .btn-cta"
      );

    if (addButton) {
      addButton.onclick = () => {
        openMenuEditor(null);
      };
    }

    section
      .querySelectorAll(".edit-menu")
      .forEach(button => {

        button.addEventListener("click", () => {

          const menu =
            getData(
              STORAGE.menu,
              defaultMenu
            );

          const item =
            menu.find(
              m => m.id === button.dataset.id
            );

          if (item) {
            openMenuEditor(item);
          }

        });

      });

    section
      .querySelectorAll(".delete-menu")
      .forEach(button => {

        button.addEventListener("click", () => {

          const confirmed =
            confirm(
              "Tem certeza que deseja excluir esta marmita?"
            );

          if (!confirmed) return;

          let menu =
            getData(
              STORAGE.menu,
              defaultMenu
            );

          menu =
            menu.filter(
              item =>
                item.id !== button.dataset.id
            );

          saveData(
            STORAGE.menu,
            menu
          );

          renderMenuAdmin();
          updateDashboard();

        });

      });
  }


  /* =========================================================
     EDITOR DE MARMITA
     ========================================================= */

  function openMenuEditor(item) {

    removeModal();

    const isNew = !item;

    const modal =
      document.createElement("div");

    modal.id = "admin-custom-modal";

    modal.innerHTML = `

      <div class="admin-modal-backdrop"></div>

      <div class="admin-modal">

        <div class="admin-modal-header">

          <div>
            <h2>
              ${isNew
                ? "Adicionar marmita"
                : "Editar marmita"}
            </h2>

            <p>
              Configure a marmita e seus acompanhamentos.
            </p>
          </div>

          <button
            class="admin-modal-close">
            &times;
          </button>

        </div>

        <form id="menu-editor-form">

          <div class="admin-form-grid">

            <div>
              <label>Nome da marmita</label>

              <input
                id="menu-name"
                required
                value="${item?.name || ""}"
                placeholder="Ex: Marmita Pequena">
            </div>

            <div>
              <label>Preço</label>

              <input
                id="menu-price"
                type="number"
                step="0.01"
                min="0"
                required
                value="${item?.price || ""}"
                placeholder="15.00">
            </div>

          </div>

          <div>
            <label>Descrição</label>

            <textarea
              id="menu-description"
              rows="3"
              placeholder="Descrição da marmita">${item?.description || ""}</textarea>
          </div>

          <div>
            <label>URL da imagem</label>

            <input
              id="menu-image"
              value="${item?.image || ""}"
              placeholder="https://...">
          </div>

          <div class="admin-switch">

            <label>
              <input
                type="checkbox"
                id="menu-active"
                ${item?.active !== false ? "checked" : ""}>
              <span>Marmita disponível para venda</span>
            </label>

          </div>


          <!-- ACOMPANHAMENTOS -->

          <div class="ingredient-manager">

            <div class="ingredient-header">

              <div>
                <h3>Acompanhamentos</h3>
                <p>
                  Adicione, edite, exclua e ative
                  os acompanhamentos desta marmita.
                </p>
              </div>

              <button
                type="button"
                class="btn-cta"
                id="add-accompaniment">
                <i class="bi bi-plus-lg"></i>
                Adicionar
              </button>

            </div>

            <div
              id="accompaniment-list"
              class="ingredient-list">
            </div>

          </div>


          <!-- PROTEÍNAS -->

          <div class="ingredient-manager">

            <div class="ingredient-header">

              <div>
                <h3>Proteínas</h3>
                <p>
                  Gerencie as opções de proteína.
                </p>
              </div>

              <button
                type="button"
                class="btn-cta"
                id="add-protein">
                <i class="bi bi-plus-lg"></i>
                Adicionar
              </button>

            </div>

            <div
              id="protein-list"
              class="ingredient-list">
            </div>

          </div>


          <!-- CARBOIDRATOS -->

          <div class="ingredient-manager">

            <div class="ingredient-header">

              <div>
                <h3>Carboidratos</h3>
                <p>
                  Gerencie as opções de carboidrato.
                </p>
              </div>

              <button
                type="button"
                class="btn-cta"
                id="add-carb">
                <i class="bi bi-plus-lg"></i>
                Adicionar
              </button>

            </div>

            <div
              id="carb-list"
              class="ingredient-list">
            </div>

          </div>


          <div class="admin-modal-footer">

            <button
              type="button"
              class="btn-outline-custom"
              id="cancel-menu">
              Cancelar
            </button>

            <button
              type="submit"
              class="btn-cta">
              <i class="bi bi-check-lg"></i>
              Salvar
            </button>

          </div>

        </form>

      </div>
    `;

    document.body.appendChild(modal);

    renderIngredientList(
      "accompaniment",
      "acompanhamentos",
      "#accompaniment-list"
    );

    renderIngredientList(
      "protein",
      "proteínas",
      "#protein-list"
    );

    renderIngredientList(
      "carb",
      "carboidratos",
      "#carb-list"
    );

    modal
      .querySelector(".admin-modal-close")
      .onclick = () => removeModal();

    modal
      .querySelector(".admin-modal-backdrop")
      .onclick = () => removeModal();

    modal
      .querySelector("#cancel-menu")
      .onclick = () => removeModal();

    modal
      .querySelector("#add-accompaniment")
      .onclick = () => {
        openIngredientEditor(
          "accompaniment"
        );
      };

    modal
      .querySelector("#add-protein")
      .onclick = () => {
        openIngredientEditor(
          "protein"
        );
      };

    modal
      .querySelector("#add-carb")
      .onclick = () => {
        openIngredientEditor(
          "carb"
        );
      };


    modal
      .querySelector("#menu-editor-form")
      .addEventListener("submit", e => {

        e.preventDefault();

        let menu =
          getData(
            STORAGE.menu,
            defaultMenu
          );

        const newItem = {
          id:
            item?.id ||
            generateId("marmita"),

          name:
            document
              .getElementById("menu-name")
              .value.trim(),

          price:
            Number(
              document
                .getElementById("menu-price")
                .value
            ),

          description:
            document
              .getElementById("menu-description")
              .value.trim(),

          image:
            document
              .getElementById("menu-image")
              .value.trim(),

          active:
            document
              .getElementById("menu-active")
              .checked
        };

        if (isNew) {
          menu.push(newItem);
        } else {
          menu =
            menu.map(m =>
              m.id === item.id
                ? newItem
                : m
            );
        }

        saveData(
          STORAGE.menu,
          menu
        );

        removeModal();
        renderMenuAdmin();
        updateDashboard();

        alert(
          "Marmita salva com sucesso!"
        );
      });
  }


  /* =========================================================
     INGREDIENTES
     ========================================================= */

  const ingredientStorage = {
    accompaniment:
      "saborcaseiro_accompaniments",

    protein:
      "saborcaseiro_proteins",

    carb:
      "saborcaseiro_carbs"
  };

  function renderIngredientList(
    type,
    label,
    selector
  ) {

    const list =
      document.querySelector(selector);

    if (!list) return;

    const items =
      getData(
        ingredientStorage[type],
        []
      );

    list.innerHTML = "";

    if (!items.length) {

      list.innerHTML = `
        <div class="empty-ingredients">
          Nenhum ${label.slice(0, -1)}
          cadastrado.
        </div>
      `;

      return;
    }

    items.forEach(item => {

      const row =
        document.createElement("div");

      row.className =
        "ingredient-row";

      row.innerHTML = `

        <div class="ingredient-main">

          ${
            item.image
              ? `<img src="${item.image}"
                      alt="${item.name}">`
              : `<div class="ingredient-icon">
                   <i class="bi bi-egg-fried"></i>
                 </div>`
          }

          <div>
            <strong>${item.name}</strong>
            <small>${item.description}</small>
          </div>

        </div>

        <div class="ingredient-actions">

          <button
            type="button"
            class="ingredient-edit"
            data-type="${type}"
            data-id="${item.id}">
            <i class="bi bi-pencil"></i>
          </button>

          <button
            type="button"
            class="ingredient-delete"
            data-type="${type}"
            data-id="${item.id}">
            <i class="bi bi-trash"></i>
          </button>

        </div>
      `;

      list.appendChild(row);
    });


    list
      .querySelectorAll(".ingredient-edit")
      .forEach(button => {

        button.onclick = () => {

          const items =
            getData(
              ingredientStorage[
                button.dataset.type
              ],
              []
            );

          const item =
            items.find(
              x =>
                x.id ===
                button.dataset.id
            );

          openIngredientEditor(
            button.dataset.type,
            item
          );
        };

      });


    list
      .querySelectorAll(".ingredient-delete")
      .forEach(button => {

        button.onclick = () => {

          if (
            !confirm(
              "Excluir este item?"
            )
          ) return;

          let items =
            getData(
              ingredientStorage[
                button.dataset.type
              ],
              []
            );

          items =
            items.filter(
              x =>
                x.id !==
                button.dataset.id
            );

          saveData(
            ingredientStorage[
              button.dataset.type
            ],
            items
          );

          renderIngredientList(
            button.dataset.type,
            "",
            getIngredientSelector(
              button.dataset.type
            )
          );
        };

      });
  }


  function getIngredientSelector(type) {

    if (type === "accompaniment")
      return "#accompaniment-list";

    if (type === "protein")
      return "#protein-list";

    return "#carb-list";
  }


  function openIngredientEditor(
    type,
    item = null
  ) {

    removeModal("ingredient-modal");

    const labels = {
      accompaniment:
        "Acompanhamento",

      protein:
        "Proteína",

      carb:
        "Carboidrato"
    };

    const modal =
      document.createElement("div");

    modal.id =
      "ingredient-modal";

    modal.innerHTML = `

      <div class="admin-modal-backdrop"></div>

      <div class="admin-modal admin-modal-small">

        <div class="admin-modal-header">

          <div>
            <h2>
              ${item ? "Editar" : "Adicionar"}
              ${labels[type]}
            </h2>

            <p>
              Cadastre a opção que aparecerá
              para seus clientes.
            </p>
          </div>

          <button
            class="admin-modal-close">
            &times;
          </button>

        </div>

        <form id="ingredient-form">

          <label>Nome</label>

          <input
            id="ingredient-name"
            required
            value="${item?.name || ""}"
            placeholder="${labels[type]}">

          <label>Descrição</label>

          <textarea
            id="ingredient-description"
            rows="3"
            placeholder="Descrição">${item?.description || ""}</textarea>

          <label>Imagem</label>

          <input
            id="ingredient-image"
            value="${item?.image || ""}"
            placeholder="https://...">

          <div class="admin-modal-footer">

            <button
              type="button"
              class="btn-outline-custom"
              id="cancel-ingredient">
              Cancelar
            </button>

            <button
              type="submit"
              class="btn-cta">
              Salvar
            </button>

          </div>

        </form>

      </div>
    `;

    document.body.appendChild(modal);

    modal
      .querySelector(".admin-modal-close")
      .onclick = () =>
        removeModal("ingredient-modal");

    modal
      .querySelector(".admin-modal-backdrop")
      .onclick = () =>
        removeModal("ingredient-modal");

    modal
      .querySelector("#cancel-ingredient")
      .onclick = () =>
        removeModal("ingredient-modal");


    modal
      .querySelector("#ingredient-form")
      .addEventListener("submit", e => {

        e.preventDefault();

        let items =
          getData(
            ingredientStorage[type],
            []
          );

        const newItem = {

          id:
            item?.id ||
            generateId(type),

          name:
            document
              .getElementById(
                "ingredient-name"
              )
              .value.trim(),

          description:
            document
              .getElementById(
                "ingredient-description"
              )
              .value.trim(),

          image:
            document
              .getElementById(
                "ingredient-image"
              )
              .value.trim()
        };

        if (item) {

          items =
            items.map(x =>
              x.id === item.id
                ? newItem
                : x
            );

        } else {

          items.push(newItem);
        }

        saveData(
          ingredientStorage[type],
          items
        );

        removeModal(
          "ingredient-modal"
        );

        const selector =
          getIngredientSelector(type);

        const label =
          type === "accompaniment"
            ? "acompanhamentos"
            : type === "protein"
              ? "proteínas"
              : "carboidratos";

        renderIngredientList(
          type,
          label,
          selector
        );
      });
  }


  /* =========================================================
     PEDIDOS
     ========================================================= */

  function renderOrders(filter = "Todos") {

    const section =
      document.getElementById("pedidos");

    if (!section) return;

    const tbody =
      section.querySelector(
        ".admin-table tbody"
      );

    if (!tbody) return;

    const orders =
      getData(
        STORAGE.orders,
        []
      );

    const filtered =
      filter === "Todos"
        ? orders
        : orders.filter(
            order =>
              order.statusLabel
                .toLowerCase()
                .includes(
                  filter
                    .replace("Concluídos", "Concluído")
                    .replace("Novos", "Novo")
                    .toLowerCase()
                )
          );

    tbody.innerHTML = "";

    filtered.forEach(order => {

      const tr =
        document.createElement("tr");

      tr.innerHTML = `

        <td>
          <strong>#${order.id}</strong>
        </td>

        <td>${order.customer}</td>

        <td>${order.items}</td>

        <td>${money(order.total)}</td>

        <td>
          <span class="status ${order.status}">
            ${order.statusLabel}
          </span>
        </td>

        <td>
          <button
            class="table-action view-order"
            data-id="${order.id}">
            <i class="bi bi-eye"></i>
          </button>
        </td>
      `;

      tbody.appendChild(tr);
    });

    section
      .querySelectorAll(".view-order")
      .forEach(button => {

        button.onclick = () => {

          const order =
            orders.find(
              x =>
                String(x.id) ===
                String(button.dataset.id)
            );

          if (order) {
            showOrder(order);
          }

        };
      });
  }


  document
    .querySelectorAll(".filter-btn")
    .forEach(button => {

      button.addEventListener("click", () => {

        document
          .querySelectorAll(".filter-btn")
          .forEach(btn =>
            btn.classList.remove("active")
          );

        button.classList.add("active");

        renderOrders(
          button.textContent.trim()
        );
      });

    });


  function showOrder(order) {

    removeModal();

    const modal =
      document.createElement("div");

    modal.id =
      "admin-custom-modal";

    modal.innerHTML = `

      <div class="admin-modal-backdrop"></div>

      <div class="admin-modal admin-modal-small">

        <div class="admin-modal-header">

          <div>
            <h2>Pedido #${order.id}</h2>
            <p>Detalhes do pedido</p>
          </div>

          <button class="admin-modal-close">
            &times;
          </button>

        </div>

        <div class="order-detail">

          <p>
            <strong>Cliente:</strong>
            ${order.customer}
          </p>

          <p>
            <strong>Itens:</strong>
            ${order.items}
          </p>

          <p>
            <strong>Total:</strong>
            ${money(order.total)}
          </p>

          <p>
            <strong>Status:</strong>
            ${order.statusLabel}
          </p>

        </div>

        <div class="admin-modal-footer">

          <button
            class="btn-outline-custom"
            id="close-order">
            Fechar
          </button>

          <button
            class="btn-cta"
            id="advance-order">
            Avançar status
            <i class="bi bi-arrow-right"></i>
          </button>

        </div>

      </div>
    `;

    document.body.appendChild(modal);

    modal
      .querySelector(".admin-modal-close")
      .onclick = () => removeModal();

    modal
      .querySelector(".admin-modal-backdrop")
      .onclick = () => removeModal();

    modal
      .querySelector("#close-order")
      .onclick = () => removeModal();

    modal
      .querySelector("#advance-order")
      .onclick = () => {

        advanceOrder(order.id);

        removeModal();

        renderOrders();

        updateDashboard();
      };
  }


  function advanceOrder(id) {

    const statuses = [
      {
        status: "new",
        label: "Novo"
      },
      {
        status: "preparing",
        label: "Em preparo"
      },
      {
        status: "delivery",
        label: "Entrega"
      },
      {
        status: "finished",
        label: "Concluído"
      }
    ];

    let orders =
      getData(
        STORAGE.orders,
        []
      );

    orders =
      orders.map(order => {

        if (
          String(order.id) !==
          String(id)
        ) {
          return order;
        }

        const index =
          statuses.findIndex(
            s =>
              s.status ===
              order.status
          );

        const next =
          statuses[
            Math.min(
              index + 1,
              statuses.length - 1
            )
          ];

        return {
          ...order,
          status: next.status,
          statusLabel: next.label
        };
      });

    saveData(
      STORAGE.orders,
      orders
    );
  }


  /* =========================================================
     CLIENTES
     ========================================================= */

  function renderCustomers() {

    const section =
      document.getElementById("clientes");

    if (!section) return;

    const tbody =
      section.querySelector(
        ".admin-table tbody"
      );

    if (!tbody) return;

    const customers =
      getData(
        STORAGE.customers,
        []
      );

    tbody.innerHTML = "";

    customers.forEach(customer => {

      const tr =
        document.createElement("tr");

      tr.innerHTML = `

        <td>
          <strong>${customer.name}</strong>
        </td>

        <td>${customer.phone || "-"}</td>

        <td>${customer.orders || 0}</td>

        <td>${money(customer.spent || 0)}</td>

        <td>
          <button
            class="table-action view-customer"
            data-id="${customer.id}">
            <i class="bi bi-eye"></i>
          </button>
        </td>
      `;

      tbody.appendChild(tr);
    });


    section
      .querySelectorAll(".view-customer")
      .forEach(button => {

        button.onclick = () => {

          const customer =
            customers.find(
              x =>
                x.id ===
                button.dataset.id
            );

          if (customer) {
            showCustomer(customer);
          }
        };

      });
  }


  function showCustomer(customer) {

    removeModal();

    const modal =
      document.createElement("div");

    modal.id =
      "admin-custom-modal";

    modal.innerHTML = `

      <div class="admin-modal-backdrop"></div>

      <div class="admin-modal admin-modal-small">

        <div class="admin-modal-header">

          <div>
            <h2>${customer.name}</h2>
            <p>Dados do cliente</p>
          </div>

          <button class="admin-modal-close">
            &times;
          </button>

        </div>

        <div class="order-detail">

          <p>
            <strong>Email:</strong>
            ${customer.email || "-"}
          </p>

          <p>
            <strong>Telefone:</strong>
            ${customer.phone || "-"}
          </p>

          <p>
            <strong>Endereço:</strong>
            ${customer.address || "-"}
          </p>

          <p>
            <strong>Pedidos:</strong>
            ${customer.orders || 0}
          </p>

          <p>
            <strong>Total gasto:</strong>
            ${money(customer.spent || 0)}
          </p>

        </div>

        <div class="admin-modal-footer">

          <button
            class="btn-outline-custom"
            id="close-customer">
            Fechar
          </button>

        </div>

      </div>
    `;

    document.body.appendChild(modal);

    modal
      .querySelector(".admin-modal-close")
      .onclick = () => removeModal();

    modal
      .querySelector(".admin-modal-backdrop")
      .onclick = () => removeModal();

    modal
      .querySelector("#close-customer")
      .onclick = () => removeModal();
  }


  /* =========================================================
     CADASTRO DE CLIENTE
     ========================================================= */

  const registerForm =
    document.querySelector(
      'form input#nome'
    )?.closest("form");

  if (registerForm) {

    registerForm.addEventListener(
      "submit",
      e => {

        e.preventDefault();

        const name =
          document
            .getElementById("nome")
            ?.value.trim();

        const email =
          document
            .getElementById("email")
            ?.value.trim();

        const senha =
          document
            .getElementById("senha")
            ?.value;

        const confirmarSenha =
          document
            .getElementById("confirmarSenha")
            ?.value;

        const telefone =
          document
            .getElementById("telefone")
            ?.value.trim();

        const endereco =
          document
            .getElementById("endereco")
            ?.value.trim();

        if (senha !== confirmarSenha) {
          alert(
            "As senhas não coincidem."
          );
          return;
        }

        let customers =
          getData(
            STORAGE.customers,
            []
          );

        const alreadyExists =
          customers.some(
            c =>
              c.email?.toLowerCase() ===
              email.toLowerCase()
          );

        if (alreadyExists) {
          alert(
            "Já existe uma conta com este e-mail."
          );
          return;
        }

        customers.push({
          id: generateId("cliente"),
          name,
          email,
          phone: telefone,
          address: endereco,
          orders: 0,
          spent: 0
        });

        saveData(
          STORAGE.customers,
          customers
        );

        alert(
          "Conta criada com sucesso!"
        );

        window.location.href =
          "login.html";
      }
    );
  }


  /* =========================================================
     LOGIN
     ========================================================= */

  const loginForm =
    document
      .getElementById("email")
      ?.closest("form");

  if (
    loginForm &&
    document.getElementById("senha") &&
    !document.getElementById("confirmarSenha")
  ) {

    loginForm.addEventListener(
      "submit",
      e => {

        e.preventDefault();

        const email =
          document
            .getElementById("email")
            .value.trim()
            .toLowerCase();

        const senha =
          document
            .getElementById("senha")
            .value;

        if (
          email === "admin@saborcaseiro.com" &&
          senha === "123456"
        ) {

          window.location.href =
            "administrador.html";

          return;
        }

        const customers =
          getData(
            STORAGE.customers,
            []
          );

        const customer =
          customers.find(
            c =>
              c.email?.toLowerCase() ===
              email
          );

        if (!customer) {

          alert(
            "E-mail não cadastrado."
          );

          return;
        }

        alert(
          "Login realizado com sucesso!"
        );

        window.location.href =
          "index.html";
      }
    );
  }


  /* =========================================================
     SENHA - MOSTRAR / OCULTAR
     ========================================================= */

  document
    .querySelectorAll(".password-toggle")
    .forEach(toggle => {

      toggle.addEventListener(
        "click",
        function () {

          const input =
            this.previousElementSibling;

          if (!input) return;

          if (input.type === "password") {

            input.type = "text";

            this.classList.remove(
              "bi-eye-slash"
            );

            this.classList.add(
              "bi-eye"
            );

          } else {

            input.type = "password";

            this.classList.remove(
              "bi-eye"
            );

            this.classList.add(
              "bi-eye-slash"
            );
          }

        }
      );
    });


  /* =========================================================
     MONTAGEM DA MARMITA
     ========================================================= */

  let marmita =
    getData(
      STORAGE.marmita,
      {
        size: null,
        sizePrice: 0,
        protein: null,
        carbs: [],
        accompaniments: []
      }
    );


  function saveMarmita() {
    saveData(
      STORAGE.marmita,
      marmita
    );
  }


  document
    .querySelectorAll(".btn-marmita")
    .forEach(button => {

      button.addEventListener(
        "click",
        () => {

          document
            .querySelectorAll(".btn-marmita")
            .forEach(btn =>
              btn.classList.remove("active")
            );

          button.classList.add("active");

          const strongs =
            button.querySelectorAll(
              "strong"
            );

          const name =
            strongs[0]?.textContent.trim();

          const priceText =
            strongs[1]?.textContent
              .replace("R$", "")
              .replace(".", "")
              .replace(",", ".")
              .trim();

          marmita.size = name;
          marmita.sizePrice =
            Number(priceText || 0);

          saveMarmita();
          updateMarmitaTotal();
        }
      );
    });


  document
    .querySelectorAll(
      ".btn-marmita-proteina"
    )
    .forEach(button => {

      button.addEventListener(
        "click",
        () => {

          document
            .querySelectorAll(
              ".btn-marmita-proteina"
            )
            .forEach(btn =>
              btn.classList.remove(
                "active"
              )
            );

          button.classList.add("active");

          const name =
            button.querySelector(
              "strong"
            )?.textContent.trim();

          marmita.protein = name;

          saveMarmita();
          updateMarmitaTotal();
        }
      );
    });


  function updateMarmitaTotal() {

    document
      .querySelectorAll(
        ".summary-total strong"
      )
      .forEach(element => {

        element.textContent =
          money(
            marmita.sizePrice || 0
          );

      });
  }

  updateMarmitaTotal();


  /* =========================================================
     CARRINHO
     ========================================================= */

  let cart =
    getData(
      STORAGE.cart,
      []
    );

  function updateCartBadge() {

    const badges =
      document.querySelectorAll(
        ".cart-badge"
      );

    const count =
      cart.reduce(
        (total, item) =>
          total + (item.quantity || 1),
        0
      );

    badges.forEach(
      badge =>
        badge.textContent = count
    );
  }

  updateCartBadge();


  /* =========================================================
     LOGOUT
     ========================================================= */

  const logout =
    document.getElementById(
      "logout-btn"
    );

  if (logout) {

    logout.addEventListener(
      "click",
      () => {

        if (
          confirm(
            "Deseja sair do painel administrativo?"
          )
        ) {
          window.location.href =
            "login.html";
        }

      }
    );
  }


  /* =========================================================
     DASHBOARD
     ========================================================= */

  function updateDashboard() {

    const orders =
      getData(
        STORAGE.orders,
        []
      );

    const customers =
      getData(
        STORAGE.customers,
        []
      );

    const todayOrders =
      orders.length;

    const preparing =
      orders.filter(
        o =>
          o.status ===
          "preparing"
      ).length;

    const revenue =
      orders.reduce(
        (sum, order) =>
          sum + Number(order.total || 0),
        0
      );

    const infoCards =
      document.querySelectorAll(
        "#dashboard .info-card"
      );

    if (infoCards[0]) {

      const strong =
        infoCards[0]
          .querySelector("strong");

      if (strong) {
        strong.textContent =
          money(revenue);
      }
    }

    if (infoCards[1]) {

      const strong =
        infoCards[1]
          .querySelector("strong");

      const small =
        infoCards[1]
          .querySelector("small");

      if (strong) {
        strong.textContent =
          todayOrders;
      }

      if (small) {
        small.textContent =
          `${preparing} em preparo`;
      }
    }

    if (infoCards[3]) {

      const strong =
        infoCards[3]
          .querySelector("strong");

      if (strong) {
        strong.textContent =
          customers.length;
      }
    }
  }


  /* =========================================================
     MODAL
     ========================================================= */

 function removeModal(id = "admin-custom-modal") {

  const modal = document.getElementById(id);

  if (!modal) return;

  modal.remove();

  // Remove possíveis restos de backdrop
  document
    .querySelectorAll(".admin-modal-backdrop")
    .forEach(backdrop => backdrop.remove());

  // Libera o scroll da página
  document.body.style.overflow = "";
  document.body.classList.remove("modal-open");
}


  /* =========================================================
     INICIALIZA ADMIN
     ========================================================= */

  if (
    document.getElementById("cardapio")
  ) {
    renderMenuAdmin();
  }

  if (
    document.getElementById("pedidos")
  ) {
    renderOrders();
  }

  if (
    document.getElementById("clientes")
  ) {
    renderCustomers();
  }

  if (
    document.getElementById("dashboard")
  ) {
    updateDashboard();
  }
});