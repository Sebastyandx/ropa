import './bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.css';


document.addEventListener('load', function() {
  const carouselContainer = document.querySelector('.carousel-container');
  const prevBtn = document.querySelector('.carousel-prev');
  const nextBtn = document.querySelector('.carousel-next');
  console.log(nextBtn)

  let currentIndex = 0;
  const totalItems = document.querySelectorAll('.carousel-item').length;
  const itemsPerPage = 5; // Número de elementos por página

  function goToIndex(index) {
    if (index < 0) {
      index = Math.ceil(totalItems / itemsPerPage) - 1;
    } else if (index >= Math.ceil(totalItems / itemsPerPage)) {
      index = 0;
    }

    currentIndex = index;
    const offset = -currentIndex * 100;
    carouselContainer.style.transform = `translateX(${offset}%)`;
  }

  prevBtn.addEventListener('click', function() {
    goToIndex(currentIndex - 1);
  });

  nextBtn.addEventListener('click', function() {
    goToIndex(currentIndex + 1);
  });
});

      
