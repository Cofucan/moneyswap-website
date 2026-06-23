(function () {
  'use strict';

  var root = document.querySelector('[data-cm-hiw]');
  if (!root) {
    return;
  }

  var navItems = Array.prototype.slice.call(root.querySelectorAll('[data-hiw-nav]'));
  var panels = Array.prototype.slice.call(root.querySelectorAll('[data-hiw-panel]'));
  var progressNode = root.querySelector('[data-hiw-progress]');

  if (!navItems.length || !panels.length) {
    return;
  }

  var panelMap = {};
  panels.forEach(function (panel) {
    panelMap[panel.id] = panel;
  });

  function getIndex(targetId) {
    for (var i = 0; i < navItems.length; i += 1) {
      if (navItems[i].getAttribute('data-target') === targetId) {
        return i;
      }
    }

    return 0;
  }

  function updateProgress(index) {
    if (!progressNode) {
      return;
    }

    progressNode.textContent = 'Step ' + (index + 1) + ' of ' + navItems.length;
  }

  function activate(targetId, syncHash) {
    if (!panelMap[targetId]) {
      return;
    }

    navItems.forEach(function (item) {
      var isActive = item.getAttribute('data-target') === targetId;
      item.classList.toggle('is-active', isActive);
      item.setAttribute('aria-selected', isActive ? 'true' : 'false');
    });

    panels.forEach(function (panel) {
      panel.classList.toggle('is-active', panel.id === targetId);
    });

    var currentIndex = getIndex(targetId);
    updateProgress(currentIndex);

    if (syncHash) {
      var hash = targetId.replace('cm-hiw-panel-', '');
      if (window.location.hash !== '#' + hash) {
        if (history.replaceState) {
          history.replaceState(null, '', '#' + hash);
        } else {
          window.location.hash = hash;
        }
      }
    }
  }

  function findTargetFromHash() {
    if (!window.location.hash) {
      return null;
    }

    var slug = window.location.hash.replace('#', '');
    var panelId = 'cm-hiw-panel-' + slug;

    if (panelMap[panelId]) {
      return panelId;
    }

    return null;
  }

  navItems.forEach(function (item) {
    item.addEventListener('click', function () {
      var targetId = item.getAttribute('data-target');
      activate(targetId, true);
    });

    item.addEventListener('keydown', function (event) {
      var currentIndex = getIndex(item.getAttribute('data-target'));

      if (event.key === 'ArrowRight') {
        event.preventDefault();
        var nextIndex = (currentIndex + 1) % navItems.length;
        navItems[nextIndex].focus();
        activate(navItems[nextIndex].getAttribute('data-target'), true);
      }

      if (event.key === 'ArrowLeft') {
        event.preventDefault();
        var prevIndex = (currentIndex - 1 + navItems.length) % navItems.length;
        navItems[prevIndex].focus();
        activate(navItems[prevIndex].getAttribute('data-target'), true);
      }
    });
  });

  window.addEventListener('hashchange', function () {
    var targetId = findTargetFromHash();
    if (targetId) {
      activate(targetId, false);
    }
  });

  var initialTarget = findTargetFromHash() || navItems[0].getAttribute('data-target');
  activate(initialTarget, false);

  if ('IntersectionObserver' in window) {
    var observer = new IntersectionObserver(
      function (entries, io) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) {
            entry.target.classList.add('is-visible');
            io.unobserve(entry.target);
          }
        });
      },
      {
        threshold: 0.16,
        rootMargin: '0px 0px -8% 0px'
      }
    );

    var steps = Array.prototype.slice.call(root.querySelectorAll('[data-hiw-step]'));
    steps.forEach(function (step) {
      observer.observe(step);
    });
  } else {
    var fallbackSteps = Array.prototype.slice.call(root.querySelectorAll('[data-hiw-step]'));
    fallbackSteps.forEach(function (step) {
      step.classList.add('is-visible');
    });
  }
})();
