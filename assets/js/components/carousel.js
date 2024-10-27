export function carousel() {
  document.addEventListener("DOMContentLoaded", function () {
    const carouselImages = document.querySelector(".carousel-inner");
    const images = document.querySelectorAll(".carousel-image");
    const prevButton = document.querySelector(".carousel-control-prev");
    const nextButton = document.querySelector(".carousel-control-next");
    let currentIndex = 0;

    function updateCarousel() {
      // Update the transform property to slide the images
      const offset = -currentIndex * 100; // Assuming each image takes 100% width
      carouselImages.style.transform = `translateX(${offset}%)`;

      // Update active class for images
      images.forEach((image, index) => {
        image.classList.remove("active");
        if (index === currentIndex) {
          image.classList.add("active");
        }
      });
    }

    function showNextImage() {
      currentIndex = (currentIndex + 1) % images.length; // Loop back to first image
      updateCarousel();
    }

    function showPrevImage() {
      currentIndex = (currentIndex - 1 + images.length) % images.length; // Loop to last image
      updateCarousel();
    }

    nextButton.addEventListener("click", showNextImage);
    prevButton.addEventListener("click", showPrevImage);

    // Optional: Auto-slide feature (uncomment to enable)
    // setInterval(showNextImage, 5000); // Change image every 5 seconds

    // Initial update to show the first image
    updateCarousel();
  });
}
