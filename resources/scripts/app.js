// import LazyLoad from "vanilla-lazyload";
import { domReady } from '@roots/sage/client';
import Menu from "./components/Menu";
import Carousels from "./components/Carousels";
import Search from "./components/Search";
import GLightbox from 'glightbox';
import AOS from 'aos';
import $ from 'jquery';
import SlimSelect from 'slim-select';

/**
 * app.main
 */

const main = async (err) => {
      
  const stickyHeader = document.querySelector('.main-header--sticky');
  let lastScrollY = window.scrollY;
  let isScrollingDown = false;

  function handleStickyHeaderVisibility() {
    const currentScrollY = window.scrollY;
    if (currentScrollY > lastScrollY) {
  
      isScrollingDown = true;
    } else if (currentScrollY < lastScrollY) {
      isScrollingDown = false;
    }
    if (isScrollingDown) {
      stickyHeader.classList.remove('-translate-y-full', 'opacity-0', 'pointer-events-none');
      stickyHeader.classList.add('translate-y-0', 'opacity-100', 'pointer-events-auto');
    } else {
      stickyHeader.classList.remove('translate-y-0', 'opacity-100', 'pointer-events-auto');
      stickyHeader.classList.add('-translate-y-full', 'opacity-0', 'pointer-events-none');
    }
    lastScrollY = currentScrollY;
  }


  window.addEventListener('scroll', handleStickyHeaderVisibility);
  

  const menuItems = document.querySelectorAll('.yourMenuItemId'); // Select all menu items
  const modal = document.querySelector('#contactModal');
  const modalContent = modal?.querySelector('.modal-content');
  const modalInside = modal?.querySelector('.modal-inside');
  
  const showModal = () => {
    modal.classList.remove('hidden');
    modalContent.classList.replace('animate-scaleDown', 'animate-scaleUp');
  };

  const hideModal = () => {
    modalContent.classList.replace('animate-scaleUp', 'animate-scaleDown');
    setTimeout(() => modal.classList.add('hidden'), 200);
  };

  menuItems?.forEach(menuItem => {
    menuItem.addEventListener('click', (e) => {
      e.preventDefault();
      showModal();
    });
  });

  if (modal) {
    [modal, modalInside].forEach(element => element.addEventListener('click', hideModal));
    modalContent?.addEventListener('click', (e) => e.stopPropagation());
  }

  if (modal) {
    const closeButton = modal.querySelector('#closeModal');
    closeButton?.addEventListener('click', hideModal);
  } 

  AOS.init({
    offset: 0,
    duration: 400,
    easing: 'ease-in-out',
    anchorPlacement: 'top-bottom'
  });
  if (err) {
    // handle hmr errors
    console.error(err);
  }

 // Adjusting the font size buttons event listeners
document.querySelectorAll('.size-button').forEach(button => {
  button.addEventListener('click', function () {
    // Using the first class as the font size identifier
    changeFontSize(this.classList[0]);
    updateActiveButton(this);
  });
});

// Toggle Dark Mode functionality
document.querySelectorAll('.toggleDarkMode').forEach(toggleButton => {
  toggleButton.addEventListener('click', function () {
    document.documentElement.classList.toggle('dark');

    if (document.documentElement.classList.contains('dark')) {
      localStorage.setItem('darkMode', 'enabled');
    } else {
      localStorage.setItem('darkMode', 'disabled');
    }
  });
});

// Custom select change event listener
document.querySelectorAll('.select-custom--header').forEach(select => {
  select.addEventListener('change', function () {
    var tempDiv = document.createElement('div');
    tempDiv.innerHTML = this.options[this.selectedIndex].getAttribute('data-html');
    var url = tempDiv.querySelector('a') ? tempDiv.querySelector('a').href : null;
    if (url) {
      window.location.href = url;
    }
  });
});

// Apply dark mode based on localStorage
if (localStorage.getItem('darkMode') === 'enabled') {
  document.documentElement.classList.add('dark');
}

// Apply preferred font size based on localStorage
const preferredFontSize = localStorage.getItem('preferredFontSize');
if (preferredFontSize) {
  changeFontSize(preferredFontSize);
  
  // Select the active button based on its class
  document.querySelectorAll(`.size-button.${preferredFontSize}`).forEach(activeButton => {
    updateActiveButton(activeButton);
  });
}

// Function to change the font size
function changeFontSize(size) {
  let rootSize;
  switch (size) {
    case 'normal':
      rootSize = '16px';
      break;
    case 'medium':
      rootSize = '17px';
      break;
    case 'big':
      rootSize = '18px';
      break;
    default:
      rootSize = '16px';
  }
  document.documentElement.style.fontSize = rootSize;
  localStorage.setItem('preferredFontSize', size);
}

function updateActiveButton(clickedButton) {
  // First, remove 'active' class from all buttons in both sets
  document.querySelectorAll('.size-button').forEach(button => {
    button.classList.remove('active');
  });

  // Then, add 'active' class to buttons with the same class as the clicked button in both sets
  const sizeClass = clickedButton.classList[0]; // Assuming the first class is the size identifier
  document.querySelectorAll(`.size-button.${sizeClass}`).forEach(button => {
    button.classList.add('active');
  });
}




  document.querySelectorAll('#language-select--header').forEach(function(selectElement) {
  new SlimSelect({
    select: selectElement,
    settings: {
      showSearch: false,
      closeOnSelect: true,
      hideSelected: true,
    }
    });
  });
  new SlimSelect({
    select: '#single',
    settings: {
      allowDeselect: true,
      showSearch: false,
      closeOnSelect: true,
    }
  })
  new SlimSelect({
    select: '#language-select',
    settings: {
      allowDeselect: true,
      showSearch: false,
      closeOnSelect: true,
    }
  })

  new SlimSelect({
    select: '#sorting-select',
    settings: {
      allowDeselect: true,
      showSearch: false,
      closeOnSelect: true,
    }
  })
  $('a[href*="#"]')
  // Remove links that don't actually link to anything
  .not('[href="#"]')
  .not('[href="#0"]')
  .click(function (event) {
    // On-page links
    if (
      location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '')
      &&
      location.hostname == this.hostname
    ) {
      // Figure out element to scroll to
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
      // Does a scroll target exist?
      if (target.length) {
        // Only prevent default if animation is actually gonna happen
        event.preventDefault();
        $('html, body').animate({
          scrollTop: target.offset().top - 50
        }, 1000, function () {
          // Callback after animation
          // Must change focus!
          var $target = $(target);
          $target.focus();
          if ($target.is(":focus")) { // Checking if the target was focused
            return false;
          } else {
            $target.attr('tabindex', '-1'); // Adding tabindex for elements not focusable
            $target.focus(); // Set focus again
          };
        });
      }
    }
  });


  // let lazyLoad = new LazyLoad({
  //   elements_selector: "[data-lazy]",
  //   load_delay: 300,
  // });

  const lightbox = GLightbox({
  });

  let menu = new Menu();
  menu.init();

  let search = new Search();
  search.init();

  let carousels = new Carousels();
  carousels.init();



  // application code
};

/**
 * Initialize
 *
 * @see https://webpack.js.org/api/hot-module-replacement
 */
domReady(main);
import.meta.webpackHot?.accept(main);
