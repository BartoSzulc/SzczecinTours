import Component from "./Component";
import AOS from 'aos';
import AirDatepicker from 'air-datepicker';
import localepl from 'air-datepicker/locale/pl.js';
import jQuery from 'jquery';
import $ from  'jquery';
export default class Search extends Component {

    constructor() {
        super();
    }
  
    init() {
        const getCheckedValues = (selector) => {
          const values = $(selector).map((_, radio) => $(radio).val()).get();
          return values.includes('all') ? $(selector.replace(':checked', '')).map((_, radio) => $(radio).val()).get() : values;
        };
        
        const filterPosts = () => {
          const formattedDate = $('#selectedDate').text();
          let kategoria_wycieczki = getCheckedValues('.kategoria_wycieczki-radio:checked');
          const miejsce_wycieczki = getCheckedValues('.miejsce_wycieczki-radio:checked');
          const language = $('#language-select').val(); 
          const sorting = $('#sorting-select').val();
          console.log(sorting);
          if (kategoria_wycieczki.includes('all')) {
              kategoria_wycieczki = [];
          }
        
          const data = {
              action: 'filter_posts',
              kategoria_wycieczki, 
              miejsce_wycieczki,
              sorting
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
        
          $.ajax({
              url: '/wp-admin/admin-ajax.php', // Consider using wp_localize_script to pass the admin URL
              type: 'POST',
              data
          }).done((response) => {
              $('.spinner-main').remove();
              $('#posts').html(response);
              AOS.init();
              AOS.refresh();
            }).fail((jqXHR, textStatus, errorThrown) => {
              $('.spinner-main').remove();
              alert('An error occurred while filtering posts. Please try again.'); // Added user-friendly error message
          });
        };
        $('#language-select').change(filterPosts);
        $('#sorting-select').change(filterPosts);
        let initialDateText = $('#selectedDate').text(); // Store the initial text
        let dp = new AirDatepicker('#minMaxExample', {
          minDate: new Date().setHours(0, 0, 0, 0), // prevent selection of dates before today
          // isMobile: true,
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
        let lastChecked = null;

        // Event handler for 'kategoria_wycieczki'
        $('.hidden-radio.kategoria_wycieczki-radio').click(function() {
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
        $('.hidden-radio.miejsce_wycieczki-radio').click(function() {
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
