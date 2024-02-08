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

    const filterPosts = (paged = 1) => {
      const viewType = document.querySelector('.grid-view').classList.contains('active') ? 'grid' : 'list';
    
      let formattedDate = $('#selectedDate').text();
      if (formattedDate && formattedDate !== "Wybierz datę") {
        formattedDate = formattedDate.split('-').reverse().join('.');
      }
    
      let kategoria_wycieczki = getCheckedValues('.kategoria_wycieczki-radio:checked');
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
        url: '/wp-admin/admin-ajax.php',
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
        alert('An error occurred while filtering posts. Please try again.');
      });
    };

    $('#posts').on('click', '.pagination a.page-link, .pagination .prev a, .pagination .next a', function(e) {
      e.preventDefault();
      let paged = $(this).data('page');
      paged = isNaN(paged) ? 1 : paged;
      filterPosts(paged.toString());
    });

    const switchView = (activeView, inactiveView, activeCols, inactiveCols) => {
      const activeElement = document.querySelector(activeView);
      const inactiveElement = document.querySelector(inactiveView);
    
      if (activeElement && inactiveElement) {
        activeElement.addEventListener('click', function () {
          inactiveElement.classList.remove('active');
          activeElement.classList.add('active');
          filterPosts();
        });
      } else {
        if (!activeElement) {
          console.error('Element not found:', activeView);
        }
        if (!inactiveElement) {
          console.error('Element not found:', inactiveView);
        }
      }
    };

    switchView('.grid-view', '.list-view', 'card-grid', 'list-grid');
    switchView('.list-view', '.grid-view', 'list-grid', 'card-grid');

    $('#language-select, #sorting-select').change(function() {
      let paged = $('.pagination a.page-link.active').data('page');
      paged = isNaN(paged) ? 1 : paged;
      filterPosts(paged);
    });

    let initialDateText = $('#selectedDate').text();
    let dp = new AirDatepicker('#minMaxExample', {
      minDate: new Date().setHours(0, 0, 0, 0),
      autoClose: true,
      locale: localepl,
      onSelect: ({formattedDate}) => {
        $('#selectedDate').text(formattedDate ? formattedDate : initialDateText);
        filterPosts();
      }
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

    // Modified event handler for clicking on the entire 'kategoria-radio' div
    $('.kategoria-radio').click(function(event) {
      event.preventDefault();
      const radioButton = $(this).find('.kategoria_wycieczki-radio');
      radioButton.prop('checked', !radioButton.prop('checked')).trigger('change');
      lastChecked = radioButton.is(':checked') ? radioButton : null;
      filterPosts();
    });

    // Additional event handler for 'miejsce_wycieczki'
    $('.hidden-radio.miejsce_wycieczki-radio').click(function () {
      if ($(this).is(lastChecked)) {
        $(this).prop('checked', false);
        lastChecked = null;
      } else {
        lastChecked = $(this);
      }
      filterPosts();
    });
  }
}
