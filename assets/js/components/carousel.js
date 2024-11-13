export function carousel() {
  document.addEventListener("DOMContentLoaded", function () {
    const carouselImages = document.querySelector(".carousel-inner");
    const images = document.querySelectorAll(".carousel-image");
    const prevButton = document.querySelector(".carousel-control-prev");
    const nextButton = document.querySelector(".carousel-control-next");
    window.carouselCurrentIndex = 0; // Initialize global index

    function updateCarousel() {
      const offset = -window.carouselCurrentIndex * 100;
      carouselImages.style.transform = `translateX(${offset}%)`;

      images.forEach((image, index) => {
        image.classList.remove("active");
        if (index === window.carouselCurrentIndex) {
          image.classList.add("active");
        }
      });
    }

    function showNextImage() {
      window.carouselCurrentIndex =
        (window.carouselCurrentIndex + 1) % images.length;
      updateCarousel();
    }

    function showPrevImage() {
      window.carouselCurrentIndex =
        (window.carouselCurrentIndex - 1 + images.length) % images.length;
      updateCarousel();
    }

    nextButton.addEventListener("click", showNextImage);
    prevButton.addEventListener("click", showPrevImage);

    setInterval(showNextImage, 3000)

    updateCarousel();
    window.updateCarousel = updateCarousel;
  });
}
