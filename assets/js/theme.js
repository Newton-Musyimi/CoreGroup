(function() {
  "use strict"; // Start of use strict

  let navbar = document.querySelector('.navbar');
  let navbarToggles = document.querySelectorAll('#navbarToggle, #navbarToggleTop');
  
  if (navbar) {
    
    let collapseEl = navbar.querySelector('.collapse');
    let collapseElementList = [].slice.call(document.querySelectorAll('.navbar .collapse'))
    let navbarCollapseList = collapseElementList.map(function (collapseEl) {
      return new bootstrap.Collapse(collapseEl, { toggle: false });
    });

    for (let toggle of navbarToggles) {

      // Toggle the side navigation
      toggle.addEventListener('click', function(e) {
        document.body.classList.toggle('navbar-toggled');
        navbar.classList.toggle('toggled');

        if (navbar.classList.contains('toggled')) {
          for (let bsCollapse of navbarCollapseList) {
            bsCollapse.hide();
          }
        };
      });
    }

    // Close any open menu accordions when window is resized below 768px
    window.addEventListener('resize', function() {
      let vw = Math.max(document.documentElement.clientWidth || 0, window.innerWidth || 0);

      if (vw < 768) {
        for (let bsCollapse of navbarCollapseList) {
          bsCollapse.hide();
        }
      };
    });
  }

  // Prevent the content wrapper from scrolling when the fixed side navigation hovered over
  
  let fixedNavigation = document.querySelector('body.fixed-nav .navbar');
  
  if (fixedNavigation) {
    fixedNavigation.on('mousewheel DOMMouseScroll wheel', function(e) {
      let vw = Math.max(document.documentElement.clientWidth || 0, window.innerWidth || 0);

      if (vw > 768) {
        let e0 = e.originalEvent,
          delta = e0.wheelDelta || -e0.detail;
        this.scrollTop += (delta < 0 ? 1 : -1) * 30;
        e.preventDefault();
      }
    });
  }

  let scrollToTop = document.querySelector('.scroll-to-top');
  
  if (scrollToTop) {
    
    // Scroll to top button appear
    window.addEventListener('scroll', function() {
      let scrollDistance = window.pageYOffset;

      //check if user is scrolling up
      if (scrollDistance > 100) {
        scrollToTop.style.display = 'block';
      } else {
        scrollToTop.style.display = 'none';
      }
    });
  }

})(); // End of use strict
