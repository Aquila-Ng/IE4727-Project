export function productCardCarousel() {
  document.addEventListener("DOMContentLoaded", function () {
    // Get all the product card carousels
    const carousels = document.querySelectorAll(".product-image-carousel");

    carousels.forEach((carousel) => {
      let currentIndex = 0;
      const slides = carousel.querySelectorAll(".carousel-item"); // Select carousel slides
      const totalSlides = slides.length;

      // Function to show the current slide and hide others
      const showSlide = (index) => {
        slides.forEach((slide, i) => {
          slide.style.display = i === index ? "block" : "none";
        });
      };

      // Initial display: Show the first slide
      showSlide(currentIndex);

      // Handle next button
      const nextButton = carousel.querySelector(".next");
      if (nextButton) {
        nextButton.addEventListener("click", () => {
          currentIndex = (currentIndex + 1) % totalSlides;
          showSlide(currentIndex);
        });
      }

      // Handle previous button
      const prevButton = carousel.querySelector(".prev");
      if (prevButton) {
        prevButton.addEventListener("click", () => {
          currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
          showSlide(currentIndex);
        });
      }

      // Handle color variant click to update carousel
      const colorVariants = carousel
        .closest(".product-card")
        .querySelectorAll(".variant-option");
      colorVariants.forEach((variant, index) => {
        variant.addEventListener("click", () => {
          // Update current slide to the relevant color
          currentIndex = index;
          showSlide(currentIndex);

          // Add active class to selected color variant and remove from others
          colorVariants.forEach((v) => v.classList.remove("active"));
          variant.classList.add("active");
        });
      });
    });
  });
}
