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

  document.getElementById('toggleDarkMode').addEventListener('click', function() {
    // Toggle the 'dark' class on the document element
    document.documentElement.classList.toggle('dark');
    
    // Check if the dark class is now present and save the state to localStorage
    if (document.documentElement.classList.contains('dark')) {
        localStorage.setItem('darkMode', 'enabled');
    } else {
        localStorage.setItem('darkMode', 'disabled');
    }
});

document.addEventListener('DOMContentLoaded', function() {
    // Check localStorage to see if dark mode was previously enabled
    
  
});


document.addEventListener('DOMContentLoaded', function() {
    const sizeButtons = document.querySelectorAll('.size-button'); // Assuming your buttons have a common class 'size-button'
    
    sizeButtons.forEach(button => {
        button.addEventListener('click', function() {
            changeFontSize(this.getAttribute('id'));
            updateActiveButton(this);
        });
    });
    if (localStorage.getItem('darkMode') === 'enabled') {
      document.documentElement.classList.add('dark');
  } 
    // Apply the preferred font size on page load
    const preferredFontSize = localStorage.getItem('preferredFontSize');
    if (preferredFontSize) {
        changeFontSize(preferredFontSize);
        // Also update the active button visually
        const activeButton = document.getElementById(preferredFontSize);
        if (activeButton) {
            updateActiveButton(activeButton);
        }
    }
});

function changeFontSize(size) {
    let rootSize;
    switch(size) {
        case 'normal':
            rootSize = '16px'; // This is typically the default browser font size
            break;
        case 'medium':
            rootSize = '17px'; // Slightly larger
            break;
        case 'big':
            rootSize = '18px'; // Even larger
            break;
        default:
            rootSize = '16px'; // Fallback to default
    }
    document.documentElement.style.fontSize = rootSize;
    localStorage.setItem('preferredFontSize', size);
}

function updateActiveButton(activeButton) {
    // Remove 'active' class from all buttons
    document.querySelectorAll('.size-button').forEach(button => {
        button.classList.remove('active');
    });
    
    // Add 'active' class to the clicked button
    activeButton.classList.add('active');
}



  document.getElementById('language-select--header').addEventListener('change', function() {
    var tempDiv = document.createElement('div');
    tempDiv.innerHTML = this.options[this.selectedIndex].getAttribute('data-html');
    var url = tempDiv.querySelector('a') ? tempDiv.querySelector('a').href : null;
    if (url) {
        window.location.href = url;
    }
  });

  new SlimSelect({
    select: '#language-select--header',
    settings: {
      showSearch: false,
      closeOnSelect: true,
      hideSelected: true,
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
