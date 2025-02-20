const navLinks = document.querySelectorAll(".nav-menu .nav-link");
const menuOpenButton = document.querySelector("#menu-open-button");
const menuCloseButton = document.querySelector("#menu-close-button");

menuOpenButton.addEventListener("click", () => {
    // Toggle mobile menu visibility
    document.body.classList.toggle("show-mobile-menu");
});

// Close menu when the close button is clicked
menuCloseButton.addEventListener("click", () => menuOpenButton.click());

// Close menu when the nav link is clicked
navLinks.forEach(link => {
    link.addEventListener("click", () => menuOpenButton.click());
})

// Initialize Swiper
const swiper = new Swiper('.slider-wrapper', {
    loop: false,
    grabCursor: true,
    spaceBetween: 25,
  
    // If we need pagination
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
      dynamicBullets: true,
    },
  
    // Navigation arrows
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },

    // Responsive breakpoints
    breakpoints: {
        0: {
            slidesPerView: 1
        },
        768: {
            slidesPerView: 2
        },
        1024: {
            slidesPerView: 3
        }
    },

    // Events to handle button visibility
    on: {
        init: function () {
            toggleNavigationButtons(this);
        },
        slideChange: function () {
            toggleNavigationButtons(this);
        },
    }
  });
  
  // Function to show/hide navigation buttons
function toggleNavigationButtons(swiper) {
    const { isBeginning, isEnd } = swiper;

    swiper.navigation.prevEl.style.display = isBeginning ? 'none' : 'block';
    swiper.navigation.nextEl.style.display = isEnd ? 'none' : 'block';
}