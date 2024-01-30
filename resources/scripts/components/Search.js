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
        
          let kategoria_wycieczki = getCheckedValues('.kategoria_wycieczki-radio:checked');
          const miejsce_wycieczki = getCheckedValues('.miejsce_wycieczki-radio:checked');
          $('body').append('<div class="spinner-main"><div class="spinner"></div></div>');
        
          if (kategoria_wycieczki.includes('all')) {
              kategoria_wycieczki = [];
          }
        
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
              // console.log('Received AJAX response:', response);
              $('.spinner-main').remove();
              $('#posts').html(response);
              AOS.init();
              AOS.refresh();
            }).fail((jqXHR, textStatus, errorThrown) => {
              $('.spinner-main').remove();
              // console.error('AJAX request failed:', textStatus, errorThrown);
          });
          
        };
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
