const FlyoutMenu = (function() {
  let flyoutMenu, summaryTags, detailsTags, backButtons, openers, closers, inertEls, activeOpener;
  
  function open( triggerOpener ) {
    if (!flyoutMenu) {
      console.warn('Flyout menu not initialized');
      return;
    }

    activeOpener = triggerOpener || openers[0];
    flyoutMenu.style.display = 'block';

    setTimeout(() => {
      document.body.classList.add('flyout-menu-open');
    });

    openers.forEach((opener) => {
      opener.setAttribute('aria-expanded', 'true');
    });

    trapFocus(inertEls, document.querySelector('.flyout-menu-closer.menu-back'));
  }
  
  function close() {
    if (!flyoutMenu) {
      console.warn('Flyout menu not initialized');
      return;
    }

    detailsTags.forEach((detailsTag) => {
      detailsTag.classList.remove('submenu-open');
      setTimeout(() => {
        detailsTag.removeAttribute('open');
      }, 50);
    });

    releaseFocus(inertEls, activeOpener);
    activeOpener = null;
    document.body.classList.remove('flyout-menu-open');

    flyoutMenu.querySelectorAll('.has-open-submenu').forEach((item) => {
      item.classList.remove('has-open-submenu');
    });

    openers.forEach((opener) => {
      opener.setAttribute('aria-expanded', 'false');
    });
  }
    
  function detailsCloseDelay(detailsElement) {
    let animationStart;

    const handleAnimation = (time) => {
      if (animationStart === undefined) {
        animationStart = time;
      }

      const elapsedTime = time - animationStart;

      if (elapsedTime < 300) {
        window.requestAnimationFrame(handleAnimation);
      } else {
        detailsElement.removeAttribute('open');
      }
    };

    window.requestAnimationFrame(handleAnimation);
  }
  
  function init() {
    flyoutMenu = document.querySelector('#flyout-menu');
    if (!flyoutMenu) {
      return;
    }

    summaryTags = flyoutMenu.querySelectorAll('summary');
    detailsTags = flyoutMenu.querySelectorAll('details');
    backButtons = flyoutMenu.querySelectorAll('details .menu-back');
    openers = document.querySelectorAll('.flyout-menu-opener a');
    closers = document.querySelectorAll('.flyout-menu-closer');
    inertEls = getSiblings(flyoutMenu.parentNode);

    openers.forEach((opener) => {
      opener.setAttribute('aria-controls', 'flyout-menu');
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

    summaryTags.forEach((summaryTag) => {
      summaryTag.addEventListener('click', () => {
        let detailsElement = summaryTag.closest('details');
        let parentMenu = detailsElement.closest('.menu-container');

        setTimeout(() => {
          detailsElement.classList.add('submenu-open');
          parentMenu.classList.add('has-open-submenu');
          focusAfterAnimation(flyoutMenu, detailsElement.querySelector('.menu-back'));
        }, 50);
      });
    });

    backButtons.forEach((backButton) => {
      backButton.addEventListener('click', () => {
        let detailsElement = backButton.closest('details');
        detailsElement.classList.remove('submenu-open');

        let parentMenu = detailsElement.closest('.menu-container');
        parentMenu.classList.remove('has-open-submenu');

        detailsCloseDelay(detailsElement);
        focusAfterAnimation(flyoutMenu, detailsElement.querySelector('summary'));
      });
    });

    if( flyoutMenuState == 'preopen' ) {
      open();
    }
    flyoutMenuState = 'initialized';
  }
  
  return {
    open,
    close,
    init
  };
})();

window.addEventListener('load', (event) => {
  FlyoutMenu.init();
});