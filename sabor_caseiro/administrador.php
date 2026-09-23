<?php
declare(strict_types=1);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Sabor Caseiro - Administração</title>

  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="style.css">
</head>

<body>

  <!-- HEADER -->
  <header class="site-header">
    <div class="container-fluid px-4">
      <div class="d-flex align-items-center justify-content-between py-2">

        <div class="d-flex align-items-center gap-4">
          <a href="index.php" class="navbar-brand">
            <img src="./img/logoooo.png" alt="Sabor Caseiro" class="logo-img">
          </a>

          <div class="admin-title">
            <span>Painel Administrativo</span>
          </div>
        </div>

        <div class="d-flex align-items-center gap-3">

          <div class="admin-user">
            <i class="bi bi-person-circle"></i>
            <span>Administrador</span>
          </div>

          <button class="logout-btn" id="logout-btn">
            <i class="bi bi-box-arrow-right"></i>
          </button>

        </div>

      </div>
    </div>
  </header>


  <!-- LAYOUT -->
  <main class="admin-layout">

    <!-- SIDEBAR -->
    <aside class="admin-sidebar">

      <div class="sidebar-menu">

        <button class="sidebar-item active" data-section="dashboard">
          <i class="bi bi-grid-1x2-fill"></i>
          <span>Dashboard</span>
        </button>

        <button class="sidebar-item" data-section="pedidos">
          <i class="bi bi-bag-fill"></i>
          <span>Pedidos</span>
          <span class="menu-badge" id="pedidos-badge">0</span>
        </button>

        <button class="sidebar-item" data-section="cardapio">
          <i class="bi bi-egg-fried"></i>
          <span>Cardápio</span>
        </button>

        <button class="sidebar-item" data-section="marmitas-dia">
          <i class="bi bi-calendar2-heart-fill"></i>
          <span>Marmitas do Dia</span>
        </button>

        <button class="sidebar-item" data-section="clientes">
          <i class="bi bi-people-fill"></i>
          <span>Clientes</span>
        </button>

        <button class="sidebar-item" data-section="configuracoes">
          <i class="bi bi-gear-fill"></i>
          <span>Configurações</span>
        </button>

      </div>

      <div class="sidebar-bottom">

        <div class="restaurant-status" id="restaurant-status">
          <span class="status-dot"></span>
          <div>
            <strong>Carregando...</strong>
            <small>Status da loja</small>
          </div>
        </div>

      </div>

    </aside>


    <!-- CONTEÚDO -->
    <section class="admin-content">

      <!-- DASHBOARD -->
      <div class="admin-section active-section" id="dashboard">

        <div class="section-header">
          <div>
            <h1>Dashboard</h1>
            <p>Visão geral da sua marmitaria hoje.</p>
          </div>

          <button class="btn-cta" type="button" data-go-section="cardapio">
            <i class="bi bi-pencil-square"></i>
            Gerenciar cardápio
          </button>
        </div>


        <!-- CARDS -->
        <div class="row g-4 mb-4">

          <div class="col-xl-3 col-md-6">
            <div class="info-card">

              <div class="info-icon">
                <i class="bi bi-currency-dollar"></i>
              </div>

              <div>
                <span>Faturamento hoje</span>
                <strong id="dash-faturamento">R$ 0,00</strong>
                <small id="dash-faturamento-info">Pedidos válidos de hoje</small>
              </div>

            </div>
          </div>


          <div class="col-xl-3 col-md-6">
            <div class="info-card">

              <div class="info-icon">
                <i class="bi bi-bag-check-fill"></i>
              </div>

              <div>
                <span>Pedidos hoje</span>
                <strong id="dash-pedidos">0</strong>
                <small id="dash-pedidos-info">0 em preparo</small>
              </div>

            </div>
          </div>


          <div class="col-xl-3 col-md-6">
            <div class="info-card">

              <div class="info-icon">
                <i class="bi bi-egg-fried"></i>
              </div>

              <div>
                <span>Marmitas vendidas</span>
                <strong id="dash-marmitas">0</strong>
                <small>Hoje</small>
              </div>

            </div>
          </div>


          <div class="col-xl-3 col-md-6">
            <div class="info-card">

              <div class="info-icon">
                <i class="bi bi-people-fill"></i>
              </div>

              <div>
                <span>Clientes</span>
                <strong id="dash-clientes">0</strong>
                <small>cadastrados</small>
              </div>

            </div>
          </div>

        </div>


        <!-- PEDIDOS + CARDÁPIO -->
        <div class="row g-4">

          <div class="col-lg-8">

            <div class="admin-card">

              <div class="card-header-custom">
                <div>
                  <h2>Pedidos recentes</h2>
                  <p>Últimos pedidos recebidos</p>
                </div>

                <button class="link-btn" data-section-link="pedidos">
                  Ver todos
                  <i class="bi bi-arrow-right"></i>
                </button>
              </div>


              <div class="table-responsive">

                <table class="admin-table">

                  <thead>
                    <tr>
                      <th>Pedido</th>
                      <th>Cliente</th>
                      <th>Valor</th>
                      <th>Status</th>
                    </tr>
                  </thead>

                  <tbody id="dashboard-pedidos-recentes"><tr><td colspan="4">Carregando...</td></tr></tbody>

                </table>

              </div>

            </div>

          </div>


          <div class="col-lg-4">

            <div class="admin-card">

              <div class="card-header-custom">
                <div>
                  <h2>Cardápio</h2>
                  <p>Resumo dos produtos</p>
                </div>
              </div>


              <div class="product-summary" id="dashboard-cardapio-resumo">
                <p class="mb-0">Carregando...</p>
              </div>


              <button class="btn-outline-custom w-100 mt-3"
                      data-section-link="cardapio">
                Gerenciar cardápio
              </button>

            </div>

          </div>

        </div>

      </div>


      <!-- PEDIDOS -->
      <div class="admin-section" id="pedidos">

        <div class="section-header">
          <div>
            <h1>Pedidos</h1>
            <p>Gerencie os pedidos da sua marmitaria.</p>
          </div>
        </div>

        <div class="admin-card">

          <div class="orders-filter">

            <button class="filter-btn active">Todos</button>
            <button class="filter-btn">Novos</button>
            <button class="filter-btn">Em preparo</button>
            <button class="filter-btn">Entrega</button>
            <button class="filter-btn">Concluídos</button>

          </div>


          <div class="table-responsive">

            <table class="admin-table">

              <thead>
                <tr>
                  <th>Pedido</th>
                  <th>Cliente</th>
                  <th>Itens</th>
                  <th>Valor</th>
                  <th>Status</th>
                  <th>Ação</th>
                </tr>
              </thead>

              <tbody>

                <tr>
                  <td><strong>#1024</strong></td>
                  <td>João Silva</td>
                  <td>2 marmitas</td>
                  <td>R$ 38,00</td>
                  <td>
                    <span class="status preparing">Em preparo</span>
                  </td>
                  <td>
                    <button class="table-action">
                      <i class="bi bi-eye"></i>
                    </button>
                  </td>
                </tr>

                <tr>
                  <td><strong>#1023</strong></td>
                  <td>Maria Oliveira</td>
                  <td>1 marmita</td>
                  <td>R$ 32,00</td>
                  <td>
                    <span class="status delivery">Entrega</span>
                  </td>
                  <td>
                    <button class="table-action">
                      <i class="bi bi-eye"></i>
                    </button>
                  </td>
                </tr>

                <tr>
                  <td><strong>#1022</strong></td>
                  <td>Carlos Souza</td>
                  <td>1 marmita</td>
                  <td>R$ 25,00</td>
                  <td>
                    <span class="status finished">Concluído</span>
                  </td>
                  <td>
                    <button class="table-action">
                      <i class="bi bi-eye"></i>
                    </button>
                  </td>
                </tr>

              </tbody>

            </table>

          </div>

        </div>

      </div>


      <!-- CARDÁPIO -->
      <div class="admin-section" id="cardapio">
        <div class="section-header">
          <div><h1>Cardápio</h1><p>Gerencie tamanhos, preços, limites e ingredientes.</p></div>
          <div class="d-flex gap-2 flex-wrap">
            <button class="btn-outline-custom" type="button" id="novo-tamanho"><i class="bi bi-plus-lg"></i> Novo tamanho</button>
            <button class="btn-cta" type="button" id="novo-ingrediente"><i class="bi bi-plus-lg"></i> Novo ingrediente</button>
          </div>
        </div>
        <h2 class="mb-3">Tamanhos das marmitas</h2>
        <div class="row g-4 mb-5" id="grid-tamanhos"><div class="col-12"><p>Carregando...</p></div></div>
        <h2 class="mb-3">Ingredientes</h2>
        <div class="row g-4" id="grid-ingredientes"><div class="col-12"><p>Carregando...</p></div></div>
      </div>

      <!-- MARMITAS DO DIA -->
      <div class="admin-section" id="marmitas-dia">
        <div class="section-header">
          <div><h1>Marmitas do Dia</h1><p>Monte, salve, edite e publique opções usando os produtos já cadastrados.</p></div>
          <button class="btn-cta" type="button" id="nova-marmita-dia"><i class="bi bi-plus-lg"></i> Nova marmita do dia</button>
        </div>
        <div class="alert alert-light border mb-4"><i class="bi bi-info-circle me-2"></i>Somente a marmita marcada como <strong>Publicada</strong> aparece na página inicial. As demais ficam salvas para reutilizar.</div>
        <div class="row g-4" id="grid-marmitas-dia"><div class="col-12"><p>Carregando...</p></div></div>
      </div>

      <!-- CLIENTES -->
      <div class="admin-section" id="clientes">

        <div class="section-header">
          <div>
            <h1>Clientes</h1>
            <p>Clientes cadastrados na sua marmitaria.</p>
          </div>
        </div>

        <div class="admin-card">

          <div class="table-responsive">

            <table class="admin-table">

              <thead>
                <tr>
                  <th>Cliente</th>
                  <th>Telefone</th>
                  <th>Pedidos</th>
                  <th>Total gasto</th>
                  <th>Ação</th>
                </tr>
              </thead>

              <tbody id="clientes-tbody"><tr><td colspan="5">Carregando...</td></tr></tbody>

            </table>

          </div>

        </div>

      </div>


      <!-- CONFIGURAÇÕES -->
      <div class="admin-section" id="configuracoes">
        <div class="section-header"><div><h1>Configurações</h1><p>Informações da loja usadas em todo o site.</p></div></div>
        <div class="admin-card p-4">
          <form id="form-configuracoes" class="row g-3">
            <div class="col-md-6"><label class="form-label">Nome da loja</label><input id="cfg-nome" class="form-control-custom" required></div>
            <div class="col-md-6"><label class="form-label">Instagram</label><input id="cfg-instagram" class="form-control-custom"></div>
            <div class="col-12"><label class="form-label">Descrição</label><textarea id="cfg-descricao" class="form-control-custom" rows="2"></textarea></div>
            <div class="col-md-6"><label class="form-label">Telefone</label><input id="cfg-telefone" class="form-control-custom"></div>
            <div class="col-md-6"><label class="form-label">WhatsApp</label><input id="cfg-whatsapp" class="form-control-custom"></div>
            <div class="col-12"><label class="form-label">Endereço</label><input id="cfg-endereco" class="form-control-custom"></div>
            <div class="col-md-3"><label class="form-label">Taxa de entrega (R$)</label><input id="cfg-taxa" type="number" min="0" step="0.01" class="form-control-custom"></div>
            <div class="col-md-3"><label class="form-label">Pedido mínimo (R$)</label><input id="cfg-minimo" type="number" min="0" step="0.01" class="form-control-custom"></div>
            <div class="col-md-3"><label class="form-label">Entrega mínima (min)</label><input id="cfg-tempo-min" type="number" min="0" class="form-control-custom"></div>
            <div class="col-md-3"><label class="form-label">Entrega máxima (min)</label><input id="cfg-tempo-max" type="number" min="0" class="form-control-custom"></div>
            <div class="col-md-4"><div class="form-check mt-4"><input id="cfg-aberto" class="form-check-input" type="checkbox"><label class="form-check-label" for="cfg-aberto">Loja aberta</label></div></div>
            <div class="col-md-8"><label class="form-label">Mensagem quando fechada</label><input id="cfg-mensagem" class="form-control-custom"></div>
            <div class="col-12"><button class="btn-cta" type="submit"><i class="bi bi-check-lg"></i> Salvar configurações</button></div>
          </form>
        </div>
      </div>

    </section>

  </main>



  <!-- MODAL MARMITA DO DIA -->
  <div class="modal fade" id="modalMarmitaDia" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable"><div class="modal-content">
      <div class="modal-header"><h5 class="modal-title" id="tituloModalMarmitaDia">Nova marmita do dia</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
      <form id="formMarmitaDia"><div class="modal-body row g-3">
        <input type="hidden" id="marmita-dia-id">
        <div class="col-md-7"><label class="form-label">Nome</label><input id="marmita-dia-nome" class="form-control-custom" required placeholder="Ex: Frango especial da casa"></div>
        <div class="col-md-5"><label class="form-label">Tamanho</label><select id="marmita-dia-tamanho" class="form-control-custom" required></select></div>
        <div class="col-12"><label class="form-label">Descrição</label><textarea id="marmita-dia-descricao" class="form-control-custom" rows="2" placeholder="Descrição opcional"></textarea></div>
        <div class="col-md-4"><label class="form-label">Preço promocional (R$)</label><input id="marmita-dia-preco" type="number" min="0" step="0.01" class="form-control-custom" placeholder="Vazio = preço calculado"></div>
        <div class="col-md-8"><label class="form-label">Foto</label><input id="marmita-dia-imagem" type="file" class="form-control-custom" accept="image/jpeg,image/png,image/webp"></div>
        <div class="col-12 d-none" id="marmita-dia-preview-wrap"><img id="marmita-dia-preview" alt="Prévia" style="width:100%;max-width:420px;max-height:220px;object-fit:cover;border-radius:16px"></div>
        <div class="col-12"><hr><h6>Composição</h6><p class="text-muted mb-0">As opções abaixo vêm dos ingredientes cadastrados no banco. Os limites seguem o tamanho escolhido.</p></div>
        <div class="col-12" id="marmita-dia-ingredientes"></div>
        <div class="col-md-6"><div class="form-check"><input id="marmita-dia-disponivel" class="form-check-input" type="checkbox" checked><label class="form-check-label" for="marmita-dia-disponivel">Disponível</label></div></div>
        <div class="col-md-6"><div class="form-check"><input id="marmita-dia-publicada" class="form-check-input" type="checkbox"><label class="form-check-label" for="marmita-dia-publicada">Publicar na página inicial ao salvar</label></div></div>
      </div><div class="modal-footer"><button type="button" class="btn-outline-custom" data-bs-dismiss="modal">Cancelar</button><button type="submit" class="btn-cta"><i class="bi bi-check-lg"></i> Salvar marmita</button></div></form>
    </div></div>
  </div>

  <!-- MODAL DE TAMANHO -->
  <div class="modal fade" id="modalTamanho" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered"><div class="modal-content">
      <div class="modal-header"><h5 class="modal-title" id="tituloModalTamanho">Novo tamanho</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
      <form id="formTamanho"><div class="modal-body row g-3">
        <input type="hidden" id="tamanho-id">
        <div class="col-md-7"><label class="form-label">Nome</label><input id="tamanho-nome" class="form-control-custom" required></div>
        <div class="col-md-5"><label class="form-label">Preço (R$)</label><input id="tamanho-preco" type="number" min="0" step="0.01" class="form-control-custom" required></div>
        <div class="col-12"><label class="form-label">Descrição</label><textarea id="tamanho-descricao" class="form-control-custom" rows="2"></textarea></div>
        <div class="col-6 col-md-3"><label class="form-label">Carboidratos</label><input id="tamanho-carb" type="number" min="0" class="form-control-custom" required></div>
        <div class="col-6 col-md-3"><label class="form-label">Proteínas</label><input id="tamanho-prot" type="number" min="0" class="form-control-custom" required></div>
        <div class="col-6 col-md-3"><label class="form-label">Acompanh.</label><input id="tamanho-acomp" type="number" min="0" class="form-control-custom" required></div>
        <div class="col-6 col-md-3"><label class="form-label">Saladas</label><input id="tamanho-salada" type="number" min="0" class="form-control-custom" required></div>
        <div class="col-md-6"><label class="form-label">Ordem</label><input id="tamanho-ordem" type="number" min="0" class="form-control-custom"></div>
        <div class="col-md-6"><div class="form-check mt-4"><input id="tamanho-disponivel" class="form-check-input" type="checkbox" checked><label class="form-check-label" for="tamanho-disponivel">Disponível</label></div></div>
      </div><div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button><button type="submit" class="btn-cta">Salvar</button></div></form>
    </div></div>
  </div>

  <!-- MODAL DE INGREDIENTE -->
  <div class="modal fade" id="modalIngrediente" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="tituloModalIngrediente">Novo ingrediente</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
        </div>
        <form id="formIngrediente">
          <div class="modal-body">
            <input type="hidden" id="ingrediente-id">
            <div class="mb-3">
              <label class="form-label">Categoria</label>
              <select id="ingrediente-categoria" class="form-control-custom" required>
                <option value="Carboidrato">Carboidrato</option>
                <option value="Proteína">Proteína</option>
                <option value="Acompanhamento">Acompanhamento</option>
                <option value="Salada">Salada</option>
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label">Nome</label>
              <input id="ingrediente-nome" type="text" class="form-control-custom" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Descrição</label>
              <textarea id="ingrediente-descricao" class="form-control-custom" rows="3"></textarea>
            </div>
            <div class="mb-3">
              <label class="form-label">Preço adicional (R$)</label>
              <input id="ingrediente-preco" type="number" min="0" step="0.01" value="0" class="form-control-custom">
            </div>
            <div class="mb-3">
              <label class="form-label">Foto do produto</label>
              <input id="ingrediente-imagem" type="file" class="form-control-custom" accept="image/jpeg,image/png,image/webp">
              <small class="d-block mt-2 text-muted">JPG, PNG ou WebP. Máximo de 5 MB.</small>
              <div id="ingrediente-imagem-preview-wrap" class="mt-3 d-none">
                <img id="ingrediente-imagem-preview" alt="Prévia do produto" style="width:140px;height:100px;object-fit:cover;border-radius:12px;">
                <button id="remover-imagem" type="button" class="btn btn-sm btn-outline-danger ms-2">Remover foto</button>
              </div>
            </div>
            <div class="form-check">
              <input id="ingrediente-disponivel" class="form-check-input" type="checkbox" checked>
              <label class="form-check-label" for="ingrediente-disponivel">Disponível</label>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn-cta">Salvar</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@supabase/supabase-js@2"></script>
  <script src="supabase.js"></script>
  <script src="integration.js"></script>
  <script src="animations.js"></script>

</body>
</html>