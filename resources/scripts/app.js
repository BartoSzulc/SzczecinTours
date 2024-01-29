// import LazyLoad from "vanilla-lazyload";
import { domReady } from '@roots/sage/client';
import Menu from "./components/Menu";
import Carousels from "./components/Carousels";
import Swiper from 'swiper';
import GLightbox from 'glightbox';
import AOS from 'aos';
import AirDatepicker from 'air-datepicker';
import localepl from 'air-datepicker/locale/pl.js';
import jQuery from 'jquery';
import $ from  'jquery';



/**
 * app.main
 */

// window.setTimeout(function () {  AOS.init({
//     offset: 0,
//     duration: 600,
//     easing: 'ease-in-sine',
//     anchorPlacement: 'top-bottom'
//   });
// }, 500);

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
  const getCheckedValues = (selector) => {
    let values = $(selector).map((_, radio) => $(radio).val()).get();
    if (values.includes('all')) {
        values = $(selector.replace(':checked', '')).map((_, radio) => $(radio).val()).get();
    }
    console.log(`Checked values for ${selector}:`, values);
    return values;
};

const filterPosts = () => {
    const formattedDate = $('#selectedDate').text();
    console.log('Selected date:', formattedDate);

    const kategoria_wycieczki = getCheckedValues('.kategoria_wycieczki-radio:checked');
    const miejsce_wycieczki = getCheckedValues('.miejsce_wycieczki-radio:checked');
    $('body').append('<div class="spinner-main"><div class="spinner"></div></div>');


    const data = {
        action: 'filter_posts',
        kategoria_wycieczki,
        miejsce_wycieczki
    };

    if (formattedDate && formattedDate !== "Wybierz datę") {
        data.selected_date = formattedDate;
    }

    console.log('Sending AJAX request with data:', data);

    $.ajax({
        url: '/wp-admin/admin-ajax.php',
        type: 'POST',
        data
    }).done((response) => {
        console.log('Received AJAX response:', response);
        $('.spinner-main').remove();
        $('#posts').html(response);
        AOS.init();
        AOS.refresh();
      }).fail((jqXHR, textStatus, errorThrown) => {
        $('.spinner-main').remove();
        console.error('AJAX request failed:', textStatus, errorThrown);
    });
    
};
let initialDateText = $('#selectedDate').text(); // Store the initial text

let dp = new AirDatepicker('#minMaxExample', {

  
  minDate: new Date().setHours(0, 0, 0, 0), // prevent selection of dates before today
  

  locale: {
    days: ['Niedziela', 'Poniedziałek', 'Wtorek', 'Środa', 'Czwartek', 'Piątek', 'Sobota'],
    daysShort: ['Nie', 'Pon', 'Wto', 'Śro', 'Czw', 'Pią', 'Sob'],
    daysMin: ['Nd', 'Pn', 'Wt', 'Śr', 'Czw', 'Pt', 'So'],
    months: ['Styczeń', 'Luty', 'Marzec', 'Kwiecień', 'Maj', 'Czerwiec', 'Lipiec', 'Sierpień', 'Wrzesień', 'Październik', 'Listopad', 'Grudzień'],
    monthsShort: ['Sty', 'Lut', 'Mar', 'Kwi', 'Maj', 'Cze', 'Lip', 'Sie', 'Wrz', 'Paź', 'Lis', 'Gru'],
    today: 'Dzisiaj',
    clear: 'Wyczyść',
    dateFormat: 'dd.MM.yyyy',
    timeFormat: 'hh:mm:aa',
    firstDay: 1
  },
  onSelect: ({formattedDate}) => {
    if (formattedDate) {
      $('#selectedDate').text(formattedDate);
    } else {
      $('#selectedDate').text(initialDateText); // Revert to the initial text when a date is deselected
    }
    filterPosts();
  }
}); 

$('#selectToday').click(function() {
  dp.selectDate(new Date());
});
$('#selectTomorrow').click(function() {
  let tomorrow = new Date();
  tomorrow.setDate(tomorrow.getDate() + 1);
  dp.selectDate(tomorrow);
});
$('.hidden-radio').change(() => {
    console.log('radio changed');
    filterPosts();
});
  
  // let lazyLoad = new LazyLoad({
  //   elements_selector: "[data-lazy]",
  //   load_delay: 300,
  // });
  const lightbox = GLightbox({
  });

//   AOS.init({
//     // Global settings:
//     disable: false, // accepts following values: 'phone', 'tablet', 'mobile', boolean, expression or function
//     startEvent: 'DOMContentLoaded', // name of the event dispatched on the document, that AOS should initialize on
//     initClassName: 'aos-init', // class applied after initialization
//     animatedClassName: 'aos-animate', // class applied on animation
//     useClassNames: false, // if true, will add content of `data-aos` as classes on scroll
//     disableMutationObserver: false, // disables automatic mutations' detections (advanced)
//     debounceDelay: 50, // the delay on debounce used while resizing window (advanced)
//     throttleDelay: 99, // the delay on throttle used while scrolling the page (advanced)
//     // Settings that can be overridden on per-element basis, by `data-aos-*` attributes:
//     offset: 120, // offset (in px) from the original trigger point
//     delay: 0, // values from 0 to 3000, with step 50ms
//     duration: 400, // values from 0 to 3000, with step 50ms
//     easing: 'ease', // default easing for AOS animations
//     once: false, // whether animation should happen only once - while scrolling down
//     mirror: false, // whether elements should animate out while scrolling past them
//     anchorPlacement: 'top-bottom', // defines which position of the element regarding to window should trigger the animation
  
//   });
  let menu = new Menu();
  menu.init();

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
