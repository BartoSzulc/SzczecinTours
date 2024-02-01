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
