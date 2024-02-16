// import LazyLoad from "vanilla-lazyload";
import { domReady } from '@roots/sage/client';
import Menu from "./components/Menu";
import Carousels from "./components/Carousels";
import Search from "./components/Search";
import GLightbox from 'glightbox';
import AOS from 'aos';
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
  const modalContent = modal.querySelector('.modal-content');
  const modalInside = modal.querySelector('.modal-inside');
  
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

  [modal, modalInside].forEach(element => element.addEventListener('click', hideModal));
  modalContent.addEventListener('click', (e) => e.stopPropagation());

  const closeButton = modal.querySelector('#closeModal');
  closeButton?.addEventListener('click', hideModal);
  
  

  

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

  const sizeButtons = document.querySelectorAll('.size-button');
  
  sizeButtons.forEach(button => {
    button.addEventListener('click', function () {
      changeFontSize(this.getAttribute('id'));
      updateActiveButton(this);
    });
  });


document.querySelectorAll('#toggleDarkMode').forEach(toggleButton => {
    toggleButton.addEventListener('click', function () {
      document.documentElement.classList.toggle('dark');

      if (document.documentElement.classList.contains('dark')) {
        localStorage.setItem('darkMode', 'enabled');
      } else {
        localStorage.setItem('darkMode', 'disabled');
      }

    });
  });
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

  if (localStorage.getItem('darkMode') === 'enabled') {
    document.documentElement.classList.add('dark');
  }
  const preferredFontSize = localStorage.getItem('preferredFontSize');
  if (preferredFontSize) {
    changeFontSize(preferredFontSize);
    
    document.querySelectorAll(`.size-button#${preferredFontSize}`).forEach(activeButton => {
      updateActiveButton(activeButton);
    });
  }
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
  
  function updateActiveButton(activeButton) {
    document.querySelectorAll('.size-button').forEach(button => {
      button.classList.remove('active');
    });
    document.querySelectorAll(`.size-button#${activeButton.id}`).forEach(button => {
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
