const FlyoutSearch = (function() {
  let flyoutSearch, openers, closers, inertEls, activeOpener;

  function open( triggerOpener ) {
    if (!flyoutSearch) {
      console.warn('Flyout search not initialized');
      return;
    }

    activeOpener = triggerOpener || openers[0];
    flyoutSearch.style.display = 'grid';

    setTimeout(() => {
      document.body.classList.add('flyout-search-open');
    });

    openers.forEach((opener) => {
      opener.setAttribute('aria-expanded', 'true');
    });

    trapFocus(inertEls, document.querySelector('.flyout-search-closer'));
  }

  function close() {
    if (!flyoutSearch) {
      console.warn('Flyout search not initialized');
      return;
    }

    releaseFocus(inertEls, activeOpener);
    activeOpener = null;
    document.body.classList.remove('flyout-search-open');

    openers.forEach((opener) => {
      opener.setAttribute('aria-expanded', 'false');
    });
  }

  function init() {
    flyoutSearch = document.querySelector('#flyout-search');
    if (!flyoutSearch) {
      return;
    }

    openers = document.querySelectorAll('.flyout-search-opener a');
    closers = document.querySelectorAll('.flyout-search-closer');
    inertEls = getSiblings(flyoutSearch.parentNode);

    openers.forEach((opener) => {
      opener.setAttribute('aria-controls', 'flyout-search');
      opener.setAttribute('aria-expanded', 'false');
      opener.addEventListener('click', function(event) {
        event.preventDefault();
        open( opener );
      });
    });

    closers.forEach((closer) => {
      closer.addEventListener('click', function(event) {
        event.preventDefault();
        close();
      });
    });

    if (typeof flyoutSearchState !== 'undefined' && flyoutSearchState === 'preopen') {
      open();
    }
    flyoutSearchState = 'initialized';
  }

  return {
    open,
    close,
    init
  };
})();

window.addEventListener('load', (event) => {
  FlyoutSearch.init();
});