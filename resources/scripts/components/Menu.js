import Component from "./Component";

export default class Menu extends Component {

    constructor() {
        super();
      
      }
    
      init() {
        const isMobile = window.innerWidth < 1024;

        document.querySelectorAll('.menu-item-has-children').forEach(item => {
          let timeoutId;
          let clickCount = 0;
      
          if (isMobile) {
            item.addEventListener('click', function(event) {
              event.preventDefault();
              clickCount++;
              if (clickCount === 1) {
                this.classList.add('toggle-menu');
              } else if (clickCount === 2) {
                const anchor = this.querySelector('a');
                if (anchor) {
                  window.location.href = anchor.href;
                }
              }
            });
          } else {
            item.addEventListener('mouseover', function() {
              clearTimeout(timeoutId);
              this.classList.add('toggle-menu');
            });
      
            item.addEventListener('mouseout', function() {
              const element = this;
              timeoutId = setTimeout(function() {
                element.classList.remove('toggle-menu');
              }, 500);
            });
          }
        });
        
        document.querySelectorAll('.js-button').forEach(button => {
          button.addEventListener('click', () => {
            const menu = document.querySelector('.mobile-menu');
            menu.classList.toggle('active');
            document.body.classList.toggle('overflow-hidden');
          });
        });
      }
    
}
