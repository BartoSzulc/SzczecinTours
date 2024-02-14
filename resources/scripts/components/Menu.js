import Component from "./Component";

export default class Menu extends Component {

    constructor() {
        super();
      
      }
    
      init() {
        const isMobile = window.innerWidth < 1024;
      
       
      
        let isOpen = false; // Track if the menu is open
      
        document.querySelectorAll('.js-button').forEach(button => {
          button.addEventListener('click', () => {
            isOpen = !isOpen; // Toggle the state
      
            // Apply or remove classes based on whether the menu is open
            document.querySelectorAll('.js-button .menu-line:first-child').forEach(firstLine => {
              if (isOpen) {
                firstLine.classList.add('rotate-45');
                firstLine.classList.remove('-translate-y-1.5');
              } else {
                firstLine.classList.remove('rotate-45');
                firstLine.classList.add('-translate-y-1.5');
              }
            });
      
            document.querySelectorAll('.js-button .menu-line:nth-child(2)').forEach(middleLine => {
              if (isOpen) {
                middleLine.classList.add('opacity-0');
              } else {
                middleLine.classList.remove('opacity-0');
              }
            });
      
            document.querySelectorAll('.js-button .menu-line:last-child').forEach(lastLine => {
              if (isOpen) {
                lastLine.classList.add('-rotate-45');
                lastLine.classList.remove('translate-y-1.5');
              } else {
                lastLine.classList.remove('-rotate-45');
                lastLine.classList.add('translate-y-1.5');
              }
            });
      
            // Toggle the mobile menu and prevent body scrolling when open
            const menus = document.querySelectorAll('.mobile-menu');
            menus.forEach(menu => {
              menu.classList.toggle('active');
              
            });
            
          });
        });
      }
      
    
}
