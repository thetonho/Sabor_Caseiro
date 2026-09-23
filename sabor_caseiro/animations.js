/* Sabor Caseiro - animações fluidas em JavaScript (Web Animations API) */
(() => {
  'use strict';
  const reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  if (reduced || !Element.prototype.animate) return;

  const ease = 'cubic-bezier(.22,1,.36,1)';
  const animated = new WeakSet();

  function enter(el, delay = 0, distance = 14) {
    if (!el || animated.has(el)) return;
    animated.add(el);
    el.animate([
      { opacity: 0, transform: `translateY(${distance}px)` },
      { opacity: 1, transform: 'translateY(0)' }
    ], { duration: 460, delay, easing: ease, fill: 'both' });
  }

  function animateGroup(root = document) {
    const selectors = [
      '.card', '.menu-card', '.menu-admin-card', '.stat-card', '.dashboard-card',
      '.ingredient-card', '.marmita-card', '.order-card', '.client-card',
      '.form-card', '.hero-content > *', '.section-title'
    ];
    const els = [...root.querySelectorAll(selectors.join(','))].filter(el => !animated.has(el));
    els.slice(0, 40).forEach((el, i) => enter(el, Math.min(i * 45, 280)));
  }

  // Entrada suave da página sem esconder conteúdo antes do JS carregar.
  document.addEventListener('DOMContentLoaded', () => {
    document.body.animate([
      { opacity: .72 },
      { opacity: 1 }
    ], { duration: 260, easing: 'ease-out' });
    animateGroup(document);
  });

  // Elementos que entram no viewport.
  const io = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        enter(entry.target, 0, 18);
        io.unobserve(entry.target);
      }
    });
  }, { threshold: .08, rootMargin: '0px 0px -20px 0px' });

  window.addEventListener('load', () => {
    document.querySelectorAll('section, .admin-section').forEach(el => {
      if (!animated.has(el)) io.observe(el);
    });
  });

  // Hover/press suave em botões e cards clicáveis.
  document.addEventListener('pointerover', e => {
    const el = e.target.closest('button, .btn, .sidebar-item, .nav-link, .menu-card, .ingredient-card');
    if (!el || el.dataset.motionHover === '1') return;
    el.dataset.motionHover = '1';
    el.animate([
      { transform: 'translateY(0) scale(1)' },
      { transform: 'translateY(-2px) scale(1.01)' }
    ], { duration: 180, easing: 'ease-out', fill: 'forwards' });
  });

  document.addEventListener('pointerout', e => {
    const el = e.target.closest('button, .btn, .sidebar-item, .nav-link, .menu-card, .ingredient-card');
    if (!el || (e.relatedTarget && el.contains(e.relatedTarget))) return;
    el.dataset.motionHover = '0';
    el.animate([
      { transform: getComputedStyle(el).transform === 'none' ? 'translateY(-2px) scale(1.01)' : getComputedStyle(el).transform },
      { transform: 'translateY(0) scale(1)' }
    ], { duration: 220, easing: ease, fill: 'forwards' });
  });

  document.addEventListener('pointerdown', e => {
    const el = e.target.closest('button, .btn');
    if (!el) return;
    el.animate([
      { transform: 'scale(1)' },
      { transform: 'scale(.97)' }
    ], { duration: 90, easing: 'ease-out', direction: 'alternate', iterations: 2 });
  });

  // Bootstrap modals: conteúdo entra com zoom/deslocamento mais natural.
  document.addEventListener('show.bs.modal', e => {
    const dialog = e.target.querySelector('.modal-dialog');
    if (!dialog) return;
    dialog.animate([
      { opacity: 0, transform: 'translateY(18px) scale(.975)' },
      { opacity: 1, transform: 'translateY(0) scale(1)' }
    ], { duration: 320, easing: ease });
  });

  // Conteúdo criado dinamicamente pelo Supabase/ADM também recebe animação.
  const mo = new MutationObserver(mutations => {
    const roots = new Set();
    mutations.forEach(m => m.addedNodes.forEach(node => {
      if (node.nodeType === 1) roots.add(node);
    }));
    roots.forEach(root => {
      if (root.matches?.('.card,.menu-card,.menu-admin-card,.ingredient-card,.marmita-card,.order-card,.client-card')) enter(root);
      animateGroup(root);
    });
  });

  window.addEventListener('load', () => mo.observe(document.body, { childList: true, subtree: true }));
})();
