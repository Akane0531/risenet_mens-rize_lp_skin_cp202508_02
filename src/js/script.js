/**
 * 特定の要素がビューポート内に入った際にクラスを付与する関数
 *
 * .u-scroll クラスを持つ全ての要素を対象とし、IntersectionObserver を用いて監視を行う。
 * ビューポート内に入った要素に 'is-active' クラスを追加する。
 *
 * rootMargin に '-20% 0px' を設定して、監視範囲を調整。
 */
const scroll = () => {
  const inViewElements = document.querySelectorAll('.u-scroll');
  if (inViewElements.length === 0) return;

  // NOTE: scrollTrigger 採用も検討

  const callback = (entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting || entry.intersectionRatio > 0) {
        entry.target.classList.add('is-active');
      }
    });
  };

  const observer = new IntersectionObserver((entries) => callback(entries), { root: null, rootMargin: '-20% 0px' });

  inViewElements.forEach((element) => {
    observer.observe(element);
  });
};

/**
 *
 * 複数のカルーセルスライダーを初期化する
 *
 * - `.js-slider-carousel` クラスを持つ要素を対象に処理を実行
 * - スライドが奇数の場合、スライドを複製してループを維持
 * - `data-space-between` 属性でスライド間のスペースを制御
 * - `data-reverse` 属性でスライダーの逆方向移動を制御
 * - `data-allow-touch-move` 属性でタッチ操作の有効/無効を制御
 * - `data-duplicate-slides` 属性でスライドの複製を制御
 * - Swiperライブラリを使用して各スライダーを設定
 * - ウィンドウリサイズ時に自動再生を再開
 */
const carouselSlider = () => {
  const slider = document.querySelectorAll('.js-slider-carousel');

  if (!slider.length) return;

  slider.forEach((element, i) => {
    const slides = Array.from(element.querySelectorAll('.swiper-slide'));
    const isOddNumberOfSlides = slides.length % 2 !== 0;
    const spaceBetween = element.dataset.spaceBetween || 0;
    const reverseDirection = element.dataset.reverse || false;
    const allowTouchMove = element.dataset.allowTouchMove || false;
    const duplicateSlides = element.dataset.duplicateSlides || false;

    // スライドが奇数の場合 または duplicateSlides が trueの場合、スライドを複製
    if (isOddNumberOfSlides || duplicateSlides) {
      slides.forEach((slide) => {
        element.querySelector('.swiper-wrapper').appendChild(
          Object.assign(document.createElement('div'), {
            className: 'swiper-slide',
            innerHTML: slide.innerHTML,
          })
        );
      });
    }

    const swiper = new Swiper(element, {
      loop: true,
      slidesPerView: 'auto',
      spaceBetween: spaceBetween,
      loopAdditionalSlides: 1,
      autoplay: {
        delay: 0,
        disableOnInteraction: false,
        reverseDirection: reverseDirection, // 偶数の時true、奇数の時false
        disableOnInteraction: false,
      },
      speed: 6000,
      allowTouchMove: allowTouchMove,
    });

    // 奇数スライドの場合のページネーション制御
    if (isOddNumberOfSlides || duplicateSlides) {
      swiper.on('slideChange', () => {
        const paginationIndex = swiper.realIndex % (swiper.slides.length / 2);
        swiper.pagination.bullets.forEach((bullet, index) => {
          bullet.classList.toggle('swiper-pagination-bullet-active', index === paginationIndex);
        });
      });
    }

    window.addEventListener('resize', () => {
      swiper.autoplay.paused = false;
      swiper.autoplay.start();
    });
  });
};

/**
 *
 * .flow .swiper 要素のスライダーを初期化する
 *
 */
const flowSlider = () => {
  const slider = document.querySelectorAll('.flow .swiper');

  slider.forEach((element) => {
    const slides = Array.from(element.querySelectorAll('.swiper-slide'));
    const isOddNumberOfSlides = slides.length % 2 !== 0;

    // スライドが奇数の場合、スライドを複製
    if (isOddNumberOfSlides) {
      slides.forEach((slide) => {
        element.querySelector('.swiper-wrapper').appendChild(
          Object.assign(document.createElement('div'), {
            className: 'swiper-slide',
            innerHTML: slide.innerHTML,
          })
        );
      });
    }

    const swiper = new Swiper(element, {
      slidesPerView: 'auto',
      spaceBetween: 32,
      centeredSlides: true,
    });

    // 奇数スライドの場合のページネーション制御
    if (isOddNumberOfSlides) {
      swiper.on('slideChange', () => {
        const paginationIndex = swiper.realIndex % (swiper.slides.length / 2);
        swiper.pagination.bullets.forEach((bullet, index) => {
          bullet.classList.toggle('swiper-pagination-bullet-active', index === paginationIndex);
        });
      });
    }
  });
};

/**
 * アコーディオン機能を提供する関数
 * @param {Object} options - アコーディオンのオプション設定
 * @returns {Object} destroyメソッドを含むアコーディオン操作用のオブジェクト
 *
 * HTML例:
 * <div class="js-accordion" data-accordion-breakpoint="767">
 *   <div data-accordion-header>ヘッダー</div>
 *   <div data-accordion-content>コンテンツ</div>
 * </div>
 *
 * data-accordion-breakpoint は アコーディオンを有効/無効にするブレークポイント（任意）
 */
const accordion = (options = {}) => {
  const $accordions = $('.js-accordion');
  const $externalTriggers = $('.js-accordion-trigger');
  const state = new Map();

  const defaultState = {
    isActive: false,
    triggers: [],
    $content: null,
    removeListener: null,
    isEnabled: true,
    prevEnabled: undefined,
    cleanupResize: null,
  };

  const isAccordionEnabled = ($el) => {
    const val = $el.data('accordion-breakpoint');
    switch (val) {
      case undefined:
        return true;
      case false:
        return false;
      case '':
      case true:
        return $(window).width() <= 767;
      default: {
        const bp = Number(val);
        return isNaN(bp) ? true : $(window).width() <= bp;
      }
    }
  };

  const toggleAccordion = ($el) => {
    const currentState = state.get($el[0]) || { ...defaultState };
    if (!currentState.isEnabled) return;
    const isActive = !currentState.isActive;

    if (currentState.$content && currentState.$content.length) {
      if (isActive) {
        currentState.$content.stop(true).slideDown(200);
      } else {
        currentState.$content.stop(true).slideUp(200);
      }
    }
    $el.toggleClass('is-active', isActive);
    currentState.triggers.forEach((trigger) => {
      $(trigger).attr('aria-expanded', String(isActive)).toggleClass('is-active', isActive);
    });
    currentState.isActive = isActive;
  };

  const setupAccordion = ($el) => {
    const currentState = state.get($el[0]) || { ...defaultState };
    state.set($el[0], currentState);

    const header = $el.find('[data-accordion-header]').get(0);
    const $content = $el.find('[data-accordion-content]').first();

    if (!header) {
      console.error('Accordion header not found', $el[0]);
      return;
    }
    currentState.triggers = [...currentState.triggers, header];
    currentState.$content = $content;

    const updateEnabled = () => {
      const enable = isAccordionEnabled($el);
      if (enable === currentState.prevEnabled) return;
      currentState.isEnabled = enable;
      currentState.prevEnabled = enable;

      if (enable) {
        if (currentState.removeListener) currentState.removeListener();
        if ($content && $content.length) $content.stop(true).slideUp(0);
        $el.removeClass('is-active');
        currentState.isActive = false;

        const handler = (e) => {
          e.preventDefault();
          toggleAccordion($el);
        };
        $(header).on('click.accordion', handler);
        currentState.removeListener = () => $(header).off('click.accordion', handler);
        $(header).css('cursor', 'pointer');
      } else {
        if (currentState.removeListener) currentState.removeListener();
        $el.addClass('is-active');
        currentState.isActive = true;
        if ($content && $content.length) $content.stop(true).slideDown(0);
        $(header).css('cursor', 'default');
      }
    };

    updateEnabled();
    $(window).on('resize.accordion', updateEnabled);
    currentState.cleanupResize = () => $(window).off('resize.accordion', updateEnabled);
  };

  const setupAccordionTriggers = ($trigger) => {
    const targetName = $trigger.data('accordion-target');
    const $target = $(`[data-accordion-name="${targetName}"]`).first();
    if (!$target.length) {
      console.error('Accordion target not found', $trigger[0]);
      return;
    }
    const currentState = state.get($target[0]) || { ...defaultState };
    state.set($target[0], currentState);
    currentState.triggers = [...currentState.triggers, $trigger.get(0)];
    currentState.$content = $target.find('[data-accordion-content]').first();

    const updateEnabled = () => {
      const enable = isAccordionEnabled($target);
      if (enable === currentState.prevEnabled) return;
      currentState.isEnabled = enable;
      currentState.prevEnabled = enable;

      if (enable) {
        if (currentState.removeListener) currentState.removeListener();
        if (currentState.$content && currentState.$content.length) currentState.$content.stop(true).slideUp(0);
        $target.removeClass('is-active');
        currentState.isActive = false;

        const handler = (e) => {
          e.preventDefault();
          toggleAccordion($target);
        };
        $trigger.on('click.accordion', handler);
        currentState.removeListener = () => $trigger.off('click.accordion', handler);
        $trigger.css('cursor', 'pointer');
      } else {
        if (currentState.removeListener) currentState.removeListener();
        $target.addClass('is-active');
        currentState.isActive = true;
        if (currentState.$content && currentState.$content.length) currentState.$content.stop(true).slideDown(0);
        $trigger.css('cursor', 'default');
      }
    };

    updateEnabled();
    $(window).on('resize.accordion', updateEnabled);
    currentState.cleanupResize = () => $(window).off('resize.accordion', updateEnabled);
  };

  $accordions.each((_, el) => setupAccordion($(el)));
  $externalTriggers.each((_, el) => setupAccordionTriggers($(el)));

  return {
    destroy: () => {
      state.forEach((currentState) => {
        if (currentState.removeListener) currentState.removeListener();
        if (currentState.cleanupResize) currentState.cleanupResize();
      });
      state.clear();
    },
  };
};

window.addEventListener('load', () => {
  // 汎用
  scroll();
  carouselSlider();
  accordion();

  flowSlider();
});

/**
 * ページ内リンクのスムーズスクロール
 */
$(function () {
  $('a[href^="#"], area[href^="#"]').click(function (e) {
    var speed = 500; // ミリ秒
    var href = $(this).attr('href');
    var target = $(href == '#' || href == '' ? 'html' : href);
    var position = target.offset().top;

    $('html, body').animate({ scrollTop: position }, speed, 'swing');
    e.preventDefault();
  });
});
