(function () {
  'use strict';

  var root = document.querySelector('[data-cm-faq]');
  if (!root) {
    return;
  }

  var links = Array.prototype.slice.call(root.querySelectorAll('[data-faq-category-link]'));
  var groups = Array.prototype.slice.call(root.querySelectorAll('[data-faq-category-group]'));

  if (!links.length || !groups.length) {
    return;
  }

  var linkMap = {};
  links.forEach(function (link) {
    var target = link.getAttribute('href');
    if (target && target.charAt(0) === '#') {
      linkMap[target.slice(1)] = link;
    }

    link.addEventListener('click', function () {
      links.forEach(function (node) {
        node.classList.remove('is-active');
      });
      link.classList.add('is-active');
    });
  });

  if (!('IntersectionObserver' in window)) {
    return;
  }

  var observer = new IntersectionObserver(
    function (entries) {
      entries.forEach(function (entry) {
        if (!entry.isIntersecting) {
          return;
        }

        var id = entry.target.getAttribute('id');
        if (!id || !linkMap[id]) {
          return;
        }

        links.forEach(function (node) {
          node.classList.toggle('is-active', node === linkMap[id]);
        });
      });
    },
    {
      rootMargin: '-45% 0px -40% 0px',
      threshold: 0
    }
  );

  groups.forEach(function (group) {
    observer.observe(group);
  });
})();
