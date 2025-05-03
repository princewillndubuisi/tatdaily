// document.addEventListener("DOMContentLoaded", function () {
//     const carousel = document.querySelector(".slider");
//     const leftButton = document.getElementById("leftButton");
//     const rightButton = document.getElementById("rightButton");
//     let autoScroll;
//     let isDragging = false;
//     let startX, scrollLeft;
//     let animationId;
//     let isScrolling = false;

//     // Enhanced scroll amount calculation
//     function getScrollAmount() {
//         const itemWidth = carousel.querySelector('div')?.offsetWidth || carousel.clientWidth / 2;
//         return Math.min(itemWidth, carousel.clientWidth * 0.8); // Never scroll more than 80% of viewport
//     }

//     // Smoother scroll animation using easing function
//     function smoothScroll(targetPosition) {
//         if (isScrolling) return;
//         isScrolling = true;

//         const startPosition = carousel.scrollLeft;
//         const distance = targetPosition - startPosition;
//         const duration = Math.min(800, 300 + Math.abs(distance) * 0.3); // Dynamic duration
//         let startTime = null;

//         // Easing function for smoother animation
//         function easeOutQuad(t) {
//             return t * (2 - t);
//         }

//         function animateScroll(currentTime) {
//             if (!startTime) startTime = currentTime;
//             const elapsedTime = currentTime - startTime;
//             const progress = Math.min(elapsedTime / duration, 1);
//             const easedProgress = easeOutQuad(progress);

//             carousel.scrollLeft = startPosition + distance * easedProgress;

//             if (progress < 1) {
//                 animationId = requestAnimationFrame(animateScroll);
//             } else {
//                 isScrolling = false;
//                 updateButtonVisibility();
//             }
//         }

//         cancelAnimationFrame(animationId);
//         animationId = requestAnimationFrame(animateScroll);
//     }

//     // Improved button visibility with transitions
//     function updateButtonVisibility() {
//         const buffer = 10; // Small buffer to prevent flickering
//         const atStart = carousel.scrollLeft <= buffer;
//         const atEnd = carousel.scrollLeft + carousel.clientWidth >= carousel.scrollWidth - buffer;

//         leftButton.style.transition = 'opacity 0.3s ease';
//         rightButton.style.transition = 'opacity 0.3s ease';

//         leftButton.style.opacity = atStart ? "0" : "1";
//         rightButton.style.opacity = atEnd ? "0" : "1";

//         leftButton.style.pointerEvents = atStart ? "none" : "auto";
//         rightButton.style.pointerEvents = atEnd ? "none" : "auto";
//     }

//     // Auto-scroll with pause on interaction
//     function startAutoScroll() {
//         clearInterval(autoScroll);
//         autoScroll = setInterval(() => {
//             if (isDragging || isScrolling) return;

//             if (carousel.scrollLeft + carousel.clientWidth >= carousel.scrollWidth - 10) {
//                 smoothScroll(0); // Loop back to start
//             } else {
//                 smoothScroll(carousel.scrollLeft + getScrollAmount());
//             }
//         }, 6000); // 6 second interval
//     }

//     // Handle button clicks
//     function handleButtonClick(direction) {
//         if (isScrolling) return;

//         const currentScroll = carousel.scrollLeft;
//         const scrollAmount = getScrollAmount();
//         let targetPosition;

//         if (direction === 'right') {
//             targetPosition = Math.min(currentScroll + scrollAmount, carousel.scrollWidth - carousel.clientWidth);
//         } else {
//             targetPosition = Math.max(currentScroll - scrollAmount, 0);
//         }

//         smoothScroll(targetPosition);
//         resetAutoScroll();
//     }

//     rightButton.addEventListener("click", () => handleButtonClick('right'));
//     leftButton.addEventListener("click", () => handleButtonClick('left'));

//     // Enhanced dragging with momentum
//     carousel.addEventListener("mousedown", (e) => {
//         isDragging = true;
//         startX = e.pageX - carousel.offsetLeft;
//         scrollLeft = carousel.scrollLeft;
//         carousel.style.cursor = "grabbing";
//         carousel.style.scrollBehavior = "auto";
//         resetAutoScroll();
//     });

//     carousel.addEventListener("mouseleave", () => {
//         if (isDragging) {
//             isDragging = false;
//             carousel.style.cursor = "grab";
//             updateButtonVisibility();
//             startAutoScroll();
//         }
//     });

//     carousel.addEventListener("mouseup", () => {
//         if (isDragging) {
//             isDragging = false;
//             carousel.style.cursor = "grab";
//             updateButtonVisibility();
//             startAutoScroll();
//         }
//     });

//     carousel.addEventListener("mousemove", (e) => {
//         if (!isDragging) return;
//         e.preventDefault();

//         const x = e.pageX - carousel.offsetLeft;
//         const walk = (x - startX) * 2.5; // Increased sensitivity
//         carousel.scrollLeft = scrollLeft - walk;
//     });

//     // Touch support for mobile devices
//     carousel.addEventListener("touchstart", (e) => {
//         isDragging = true;
//         startX = e.touches[0].pageX - carousel.offsetLeft;
//         scrollLeft = carousel.scrollLeft;
//         resetAutoScroll();
//     }, { passive: false });

//     carousel.addEventListener("touchmove", (e) => {
//         if (!isDragging) return;
//         e.preventDefault();

//         const x = e.touches[0].pageX - carousel.offsetLeft;
//         const walk = (x - startX) * 2.5;
//         carousel.scrollLeft = scrollLeft - walk;
//     }, { passive: false });

//     carousel.addEventListener("touchend", () => {
//         isDragging = false;
//         updateButtonVisibility();
//         startAutoScroll();
//     });

//     // Initialize
//     carousel.addEventListener("scroll", () => {
//         if (!isDragging) {
//             updateButtonVisibility();
//         }
//     });

//     // Responsive adjustments
//     function handleResize() {
//         cancelAnimationFrame(animationId);
//         isScrolling = false;
//         updateButtonVisibility();
//     }

//     window.addEventListener("resize", handleResize);
//     updateButtonVisibility();
//     startAutoScroll();
// });



// Mobile navbar
const menuToggle = document.getElementById('menu-toggle');
const mobileMenu = document.getElementById('mobile-menu');

menuToggle.addEventListener('click', () => {
    mobileMenu.classList.toggle('hidden');
});

// Search
function toggleSearch() {
    const input = document.getElementById('searchInput');
    input.classList.toggle('hidden');
    input.focus();
}


