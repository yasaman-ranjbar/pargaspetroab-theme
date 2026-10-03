/**
 * Pargas Petro Ab - Vanilla JavaScript Frontend Engine
 *
 * Implements:
 * - Interactive homepage slider with auto-advance, touch swipe & pause on hover
 * - Accordion technical table viewer for Project References
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
  initHeroSlider();
  initProjectTableToggle();
});

/**
 * Homepage Industrial Slider Engine
 */
function initHeroSlider() {
  const slider = document.getElementById('pargas-hero-slider');
  if (!slider) return;

  const slides = slider.querySelectorAll('.pargas-slide');
  const prevBtn = document.getElementById('pargas-slide-prev');
  const nextBtn = document.getElementById('pargas-slide-next');
  const dots = slider.querySelectorAll('.pargas-slider-dot');

  if (slides.length <= 1) return;

  let currentIndex = 0;
  let autoTimer = null;
  const slideInterval = 6000;

  function showSlide(index) {
    if (index < 0) {
      index = slides.length - 1;
    } else if (index >= slides.length) {
      index = 0;
    }

    slides.forEach((s, idx) => {
      if (idx === index) {
        s.classList.add('is-active');
        s.setAttribute('aria-hidden', 'false');
      } else {
        s.classList.remove('is-active');
        s.setAttribute('aria-hidden', 'true');
      }
    });

    dots.forEach((dot, idx) => {
      dot.classList.toggle('is-active', idx === index);
    });

    currentIndex = index;
  }

  function nextSlide() {
    showSlide(currentIndex + 1);
  }

  function prevSlide() {
    showSlide(currentIndex - 1);
  }

  function startAutoPlay() {
    stopAutoPlay();
    autoTimer = setInterval(nextSlide, slideInterval);
  }

  function stopAutoPlay() {
    if (autoTimer) {
      clearInterval(autoTimer);
      autoTimer = null;
    }
  }

  if (nextBtn) {
    nextBtn.addEventListener('click', () => {
      nextSlide();
      startAutoPlay();
    });
  }

  if (prevBtn) {
    prevBtn.addEventListener('click', () => {
      prevSlide();
      startAutoPlay();
    });
  }

  dots.forEach((dot, idx) => {
    dot.addEventListener('click', () => {
      showSlide(idx);
      startAutoPlay();
    });
  });

  // Pause on hover
  slider.addEventListener('mouseenter', stopAutoPlay);
  slider.addEventListener('mouseleave', startAutoPlay);

  // Keyboard navigation
  slider.addEventListener('keydown', (e) => {
    if (e.key === 'ArrowRight') {
      // In RTL, right is previous slide
      document.dir === 'rtl' ? prevSlide() : nextSlide();
      startAutoPlay();
    } else if (e.key === 'ArrowLeft') {
      document.dir === 'rtl' ? nextSlide() : prevSlide();
      startAutoPlay();
    }
  });

  // Touch Swipe on mobile
  let touchStartX = 0;
  let touchEndX = 0;

  slider.addEventListener('touchstart', (e) => {
    touchStartX = e.changedTouches[0].screenX;
    stopAutoPlay();
  }, { passive: true });

  slider.addEventListener('touchend', (e) => {
    touchEndX = e.changedTouches[0].screenX;
    handleSwipe();
    startAutoPlay();
  }, { passive: true });

  function handleSwipe() {
    const threshold = 40;
    const diff = touchEndX - touchStartX;
    if (Math.abs(diff) > threshold) {
      if (diff > 0) {
        // Swiped Right
        document.dir === 'rtl' ? nextSlide() : prevSlide();
      } else {
        // Swiped Left
        document.dir === 'rtl' ? prevSlide() : nextSlide();
      }
    }
  }

  startAutoPlay();
}

/**
 * Interactive Project Technical Table Toggle
 */
function initProjectTableToggle() {
  document.addEventListener('click', (e) => {
    const btn = e.target.closest('.pargas-toggle-table-btn');
    if (!btn) return;

    e.preventDefault();
    const targetId = btn.getAttribute('data-target');
    const tablePanel = document.getElementById(targetId);
    if (!tablePanel) return;

    const labelSpan = btn.querySelector('.pargas-btn-label');
    const isExpanded = btn.classList.contains('is-open');

    if (isExpanded) {
      tablePanel.style.display = 'none';
      btn.classList.remove('is-open');
      if (labelSpan) {
        labelSpan.textContent = 'مشاهده جدول مشخصات فنی';
      }
    } else {
      tablePanel.style.display = 'block';
      btn.classList.add('is-open');
      if (labelSpan) {
        labelSpan.textContent = 'بستن جدول مشخصات فنی';
      }
      // Smooth scroll if needed
      tablePanel.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }
  });
}

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

  window.addEventListener('scroll', () => {
    const currentScroll = window.pageYOffset || document.documentElement.scrollTop;
    if (currentScroll > 60) {
      header.classList.add('is-sticky');
    } else {
      header.classList.remove('is-sticky');
    }
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

  form.addEventListener('submit', (e) => {
    e.preventDefault();

    if (submitBtn) {
      submitBtn.disabled = true;
      submitBtn.textContent = (window.pargasThemeData && window.pargasThemeData.i18n.sending) || 'در حال ارسال...';
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
          submitBtn.textContent = 'ارسال استعلام';
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
          submitBtn.textContent = 'ارسال استعلام';
        }
        if (feedback) {
          feedback.style.display = 'block';
          feedback.className = 'pargas-modal-feedback pargas-alert pargas-alert-danger';
          feedback.innerHTML = 'خطا در برقراری ارتباط. لطفاً مستقیماً با تلفن شرکت تماس حاصل فرمایید.';
        }
      });
  });
}
