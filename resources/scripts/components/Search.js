import Component from "./Component";
import AOS from 'aos';
import AirDatepicker from 'air-datepicker';
import localepl from 'air-datepicker/locale/pl.js';
import jQuery from 'jquery';
import $ from 'jquery';
export default class Search extends Component {

  constructor() {
    super();
  }

  init() {
    if (!$('body').hasClass('home')) {
      return;
    }
    const getCheckedValues = (selector) => {
      const values = $(selector).map((_, radio) => $(radio).val()).get();
      const result = values.includes('all') ? $(selector.replace(':checked', '')).map((_, radio) => $(radio).val()).get() : values;
      return result.length > 0 ? result : null;
    };

    const filterPosts = (paged = 1, selectedCategory = null) => {
      const viewType = document.querySelector('.grid-view').classList.contains('active') ? 'grid' : 'list';
    
      let formattedDate = $('#selectedDate').text();
      if (formattedDate && formattedDate !== "Wybierz datę") {
        // Convert date format to 'd.m.Y'
        formattedDate = formattedDate.split('-').reverse().join('.');
      }
      let kategoria_wycieczki = selectedCategory ? [selectedCategory] : getCheckedValues('.kategoria_wycieczki-radio:checked');
      const miejsce_wycieczki = getCheckedValues('.miejsce_wycieczki-radio:checked');
      const language = $('#language-select').val();
      const sorting = $('#sorting-select').val();
    
      if (kategoria_wycieczki.includes('all')) {
        kategoria_wycieczki = [];
      }
    
      const data = {
        action: 'filter_posts',
        kategoria_wycieczki,
        miejsce_wycieczki,
        sorting,
        view: viewType,
        paged: paged,
      };
    
      if (language && language !== 'all') {
        data.language = language;
      }
    
      if (formattedDate && formattedDate !== "Wybierz datę") {
        data.selected_date = formattedDate;
      }

      if (!$('.spinner-main').length) {
        $('body').append('<div class="spinner-main"><div class="spinner"></div></div>');
      }
      console.log(data);
      $.ajax({
        url: '/wp-admin/admin-ajax.php', // Consider using wp_localize_script to pass the admin URL
        type: 'POST',
        data
      }).done((response) => {
        $('.spinner-main').remove();
        $('#posts').html(response);
        AOS.init();
        AOS.refresh();

        const posts = document.getElementById('posts');
        posts.classList.remove(viewType === 'grid' ? 'list-grid' : 'card-grid');
        posts.classList.add(viewType === 'grid' ? 'card-grid' : 'list-grid');
        document.querySelector(viewType === 'grid' ? '.grid-view' : '.list-view').classList.add('active');
        document.querySelector(viewType === 'grid' ? '.list-view' : '.grid-view').classList.remove('active');
      }).fail((jqXHR, textStatus, errorThrown) => {
        $('.spinner-main').remove();
        alert('An error occurred while filtering posts. Please try again.'); // Added user-friendly error message
      });
    };
    $('#posts').on('click', '.pagination a.page-link, .pagination .prev a, .pagination .next a', function(e) {
      e.preventDefault();
      let paged = $(this).data('page');
      paged = isNaN(paged) ? 1 : paged;
      filterPosts(paged.toString()); // Convert paged to string before passing to filterPosts
    });
    const switchView = (activeView, inactiveView, activeCols, inactiveCols) => {
      // Attempt to find the elements in the DOM
      const activeElement = document.querySelector(activeView);
      const inactiveElement = document.querySelector(inactiveView);
    
      // Check if both elements exist
      if (activeElement && inactiveElement) {
        // Add click event listener to the active element
        activeElement.addEventListener('click', function () {
          // Remove 'active' class from the inactive element
          inactiveElement.classList.remove('active');
          // Add 'active' class to the active element
          activeElement.classList.add('active');
    
          // Call filterPosts without any arguments
          filterPosts();
        });
      } else {
        // Log an error if one of the elements does not exist
        if (!activeElement) {
          console.error('Element not found:', activeView);
        }
        if (!inactiveElement) {
          console.error('Element not found:', inactiveView);
        }
      }
    };
    


    // Call switchView when the page loads
    switchView('.grid-view', '.list-view', 'card-grid', 'list-grid');
    switchView('.list-view', '.grid-view', 'list-grid', 'card-grid');
    $('#language-select').change(function() {
      let paged = $('.pagination a.page-link.active').data('page');
      paged = isNaN(paged) ? 1 : paged;
      filterPosts(paged);
    });
    
    $('#sorting-select').change(function() {
      let paged = $('.pagination a.page-link.active').data('page');
      paged = isNaN(paged) ? 1 : paged;
      filterPosts(paged);
    });
    let initialDateText = $('#selectedDate').text(); // Store the initial text
    let dp = new AirDatepicker('#minMaxExample', {
      minDate: new Date().setHours(0, 0, 0, 0), // prevent selection of dates before today
      isMobile: window.innerWidth < 768 ? true : false,
      autoClose: true,
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
          if (!$('.datepicker-deselect').length) { // Check if the element already exists
            $('.input-wrapper').append('<div class="ss-deselect datepicker-deselect"><svg viewBox="0 0 100 100"><path d="M10,10 L90,90 M10,90 L90,10"></path></svg></div>');
          }
        } else {
          $('#selectedDate').text(initialDateText); // Revert to the initial text when a date is deselected
          $('.datepicker-deselect').remove(); // Remove the SVG element when a date is deselected
        }
        filterPosts();
      }
    });
    $(document).on('click', '.datepicker-deselect', function() {
      dp.clear();
    });

    $('#selectToday').click(function () {
      dp.selectDate(new Date());
    });
    $('#selectTomorrow').click(function () {
      let tomorrow = new Date();
      tomorrow.setDate(tomorrow.getDate() + 1);
      dp.selectDate(tomorrow);
    });
    let lastChecked = null;

    
    $('.hidden-radio.kategoria_wycieczki-radio').click(function (event) {
      // Stop the click event from bubbling up to the div
      event.stopPropagation();
  
      // Your existing code...
      if ($(this).is(lastChecked)) {
          $(this).prop('checked', false);
          $('#all').prop('checked', true); // Check the 'all' radio button
          lastChecked = null;
      } else {
          lastChecked = $(this);
          if ($(this).val() === 'all') {
              $('.hidden-radio.kategoria_wycieczki-radio').not(this).prop('checked', false);
          } else {
              $('#all').prop('checked', false);
          }
      }
      filterPosts();
    });
    // Event handler for 'miejsce_wycieczki'
    $('.hidden-radio.miejsce_wycieczki-radio').click(function () {
      if ($(this).is(lastChecked)) {
        $(this).prop('checked', false);
        lastChecked = null;
      } else {
        lastChecked = $(this);
      }
      filterPosts();
    });

    $('.category-picker--mobile').change(function() {
      // This retrieves the selected category from the dropdown.
      let selectedCategory = $(this).val();
  
      // Call filterPosts with the first page and the selected category.
      // Assuming filterPosts can accept a second parameter for the category.
      filterPosts(1, selectedCategory);
  });

  }

}
