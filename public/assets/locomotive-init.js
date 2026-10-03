(function () {
  'use strict';

  var container = document.querySelector('[data-scroll-container]');
  if (!container || typeof window.LocomotiveScroll !== 'function') return;

  var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  if (reduceMotion) return;

  var scroll = new window.LocomotiveScroll({
    el: container,
    smooth: true,
    lerp: 0.075,
    multiplier: 0.9,
    reloadOnContextChange: true,
    tablet: { smooth: true },
    smartphone: { smooth: false }
  });

  window.twrScroll = scroll;

  document.addEventListener('click', function (event) {
    var link = event.target.closest('a[href^="#"]');
    if (!link) return;

    var hash = link.getAttribute('href');
    var target = hash && hash !== '#' ? document.querySelector(hash) : null;
    if (!target && hash !== '#twrTop') return;

    event.preventDefault();
    scroll.scrollTo(target || 0, {
      offset: target ? -24 : 0,
      duration: 1100,
      easing: [0.25, 0, 0.35, 1]
    });
  });

  Array.prototype.forEach.call(container.querySelectorAll('img'), function (image) {
    if (!image.complete) image.addEventListener('load', function () { scroll.update(); }, { once: true });
  });

  if ('ResizeObserver' in window) {
    var resizeObserver = new ResizeObserver(function () { scroll.update(); });
    resizeObserver.observe(container);
  }

  window.addEventListener('pageshow', function () { scroll.update(); });
  window.addEventListener('beforeunload', function () { scroll.destroy(); }, { once: true });
})();
