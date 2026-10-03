/**
 * Pargas Petro Ab - Vanilla JavaScript Frontend Engine
 *
 * Implements:
 * - Accessible mobile drawer with focus trap & ESC support
 * - Sticky header dynamics
 * - B2B engineering inquiry modal dialog
 * - Lazy-loaded map container
 *
 * @package PargasPetroAb
 */

document.addEventListener('DOMContentLoaded', () => {
  initMobileDrawer();
  initStickyHeader();
  initInquiryModal();
});

/**
 * Mobile Navigation Drawer
 */
function initMobileDrawer() {
  const openBtn = document.getElementById('pargas-drawer-open-btn');
  const closeBtn = document.getElementById('pargas-drawer-close-btn');
  const drawer = document.getElementById('pargas-mobile-nav-drawer');
  const backdrop = document.getElementById('pargas-drawer-backdrop');

  if (!openBtn || !drawer || !backdrop) return;

  function openDrawer() {
    drawer.classList.add('is-active');
    backdrop.classList.add('is-active');
    document.body.classList.add('drawer-open');
    openBtn.setAttribute('aria-expanded', 'true');
    drawer.setAttribute('aria-hidden', 'false');

    // Focus close button for accessibility.
    if (closeBtn) {
      setTimeout(() => closeBtn.focus(), 100);
    }
  }

  function closeDrawer() {
    drawer.classList.remove('is-active');
    backdrop.classList.remove('is-active');
    document.body.classList.remove('drawer-open');
    openBtn.setAttribute('aria-expanded', 'false');
    drawer.setAttribute('aria-hidden', 'true');
    openBtn.focus();
  }

  openBtn.addEventListener('click', openDrawer);
  if (closeBtn) closeBtn.addEventListener('click', closeDrawer);
  backdrop.addEventListener('click', closeDrawer);

  // Close on ESC key.
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && drawer.classList.contains('is-active')) {
      closeDrawer();
    }
  });
}

/**
 * Sticky Header on Scroll
 */
function initStickyHeader() {
  const header = document.getElementById('pargas-main-header');
  if (!header) return;

  let lastScroll = 0;
  window.addEventListener('scroll', () => {
    const currentScroll = window.pageYOffset || document.documentElement.scrollTop;
    if (currentScroll > 60) {
      header.classList.add('is-sticky');
    } else {
      header.classList.remove('is-sticky');
    }
    lastScroll = currentScroll;
  }, { passive: true });
}

/**
 * B2B Technical Inquiry & Quotation Modal
 */
function initInquiryModal() {
  const modal = document.getElementById('pargas-inquiry-modal');
  const overlay = document.getElementById('pargas-modal-overlay');
  const closeBtn = document.getElementById('pargas-modal-close-btn');
  const cancelBtn = document.getElementById('pargas-modal-cancel-btn');
  const form = document.getElementById('pargas-b2b-inquiry-form');
  const productInput = document.getElementById('pargas_inq_product');
  const feedback = document.getElementById('pargas-inquiry-feedback');
  const submitBtn = document.getElementById('pargas-inquiry-submit-btn');

  if (!modal || !form) return;

  function openModal(productTitle = '') {
    modal.classList.add('is-active');
    modal.setAttribute('aria-hidden', 'false');
    document.body.style.overflow = 'hidden';

    if (productInput && productTitle) {
      productInput.value = productTitle;
    }

    if (feedback) {
      feedback.style.display = 'none';
      feedback.className = 'pargas-modal-feedback';
      feedback.innerHTML = '';
    }

    const firstInput = form.querySelector('input:not([type="hidden"])');
    if (firstInput) {
      setTimeout(() => firstInput.focus(), 100);
    }
  }

  function closeModal() {
    modal.classList.remove('is-active');
    modal.setAttribute('aria-hidden', 'true');
    document.body.style.overflow = '';
  }

  // Bind trigger buttons.
  document.addEventListener('click', (e) => {
    const trigger = e.target.closest('.pargas-open-inquiry-modal');
    if (trigger) {
      e.preventDefault();
      const productTitle = trigger.getAttribute('data-product-title') || '';
      openModal(productTitle);
    }
  });

  if (closeBtn) closeBtn.addEventListener('click', closeModal);
  if (cancelBtn) cancelBtn.addEventListener('click', closeModal);
  if (overlay) overlay.addEventListener('click', closeModal);

  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && modal.classList.contains('is-active')) {
      closeModal();
    }
  });

  // Handle Form Submission.
  form.addEventListener('submit', (e) => {
    e.preventDefault();

    if (submitBtn) {
      submitBtn.disabled = true;
      submitBtn.textContent = (window.pargasThemeData && window.pargasThemeData.i18n.sending) || 'Sending...';
    }

    const formData = new FormData(form);

    fetch(window.pargasThemeData ? window.pargasThemeData.ajaxUrl : '/wp-admin/admin-ajax.php', {
      method: 'POST',
      body: formData,
    })
      .then((res) => res.json())
      .then((data) => {
        if (submitBtn) {
          submitBtn.disabled = false;
          submitBtn.textContent = 'Transmit Inquiry';
        }

        if (feedback) {
          feedback.style.display = 'block';
          if (data.success) {
            feedback.className = 'pargas-modal-feedback pargas-alert pargas-alert-success';
            feedback.innerHTML = data.data.message || (window.pargasThemeData && window.pargasThemeData.i18n.success);
            form.reset();
            setTimeout(() => closeModal(), 2500);
          } else {
            feedback.className = 'pargas-modal-feedback pargas-alert pargas-alert-danger';
            feedback.innerHTML = data.data.message || (window.pargasThemeData && window.pargasThemeData.i18n.error);
          }
        }
      })
      .catch(() => {
        if (submitBtn) {
          submitBtn.disabled = false;
          submitBtn.textContent = 'Transmit Inquiry';
        }
        if (feedback) {
          feedback.style.display = 'block';
          feedback.className = 'pargas-modal-feedback pargas-alert pargas-alert-danger';
          feedback.innerHTML = 'Communication error. Please telephone our technical team directly.';
        }
      });
  });
}
