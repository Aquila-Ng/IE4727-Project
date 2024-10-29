import { navbar } from "../components/navbar.js";
import { carousel } from "../components/carousel.js";
import { updateQuantity as quantityControlUpdateQuantity } from "../components/quantity-control.js"; // Adjust the path as necessary

function productDescriptionGallery() {
  document.addEventListener("DOMContentLoaded", function () {
    const galleryOptions = document.querySelectorAll(".gallery-option");
    const nextButton = document.querySelector(".carousel-control-next");
    const prevButton = document.querySelector(".carousel-control-prev");

    // Function to update the active gallery option based on carousel index
    function updateActiveGalleryOption() {
      galleryOptions.forEach((img, index) => img.classList.remove("active"));
      galleryOptions[window.carouselCurrentIndex].classList.add("active");
    }

    // Update gallery options when a gallery option is clicked
    galleryOptions.forEach((image, index) => {
      image.addEventListener("click", function () {
        galleryOptions.forEach((img) => img.classList.remove("active"));
        image.classList.add("active");

        // Set the current carousel index and update the carousel display
        window.carouselCurrentIndex = index;
        window.updateCarousel();
      });
    });

    // Sync gallery options when carousel is navigated via controls
    nextButton.addEventListener("click", function () {
      updateActiveGalleryOption();
    });

    prevButton.addEventListener("click", function () {
      updateActiveGalleryOption();
    });
  });
}

function productDescription() {
  document.addEventListener("DOMContentLoaded", function () {
    // Select the product description
    const productDescription = document.querySelector(".product-description");

    // Select all color variant options within the product description
    const colorVariants =
      productDescription.querySelectorAll(".variant-option");

    // Set the first color variant as selected by default
    if (colorVariants.length > 0) {
      colorVariants[0].classList.add("selected");
    }

    // When a color variant is clicked
    colorVariants.forEach(function (variant) {
      variant.addEventListener("click", function () {
        // Remove the 'selected' class from all variants
        colorVariants.forEach(function (v) {
          v.classList.remove("selected");
        });

        // Add 'selected' class to the clicked variant
        variant.classList.add("selected");
      });
    });
  });
}

navbar();
carousel();
productDescriptionGallery();
productDescription();
window.updateQuantity = quantityControlUpdateQuantity;
