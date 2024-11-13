import { navbar } from "../components/navbar.js";
import { updateQuantity as quantityControlUpdateQuantity } from "../components/quantity-control.js"; // Adjust the path as necessary
class Carousel {
  constructor(carouselContainer, galleryOptions) {
    this.carouselContainer = carouselContainer;
    this.carouselImages =
      this.carouselContainer.querySelector(".carousel-inner");
    this.images = this.carouselContainer.querySelectorAll(".carousel-image");
    this.prevButton = this.carouselContainer.querySelector(
      ".carousel-control-prev"
    );
    this.nextButton = this.carouselContainer.querySelector(
      ".carousel-control-next"
    );
    this.galleryOptions = galleryOptions;
    this.currentIndex = 0; // Initialize current index

    this.init(); // Initialize the carousel
  }

  init() {
    this.updateCarousel(); // Initial update to set the correct image
    this.prevButton.addEventListener("click", () => this.showPrevImage());
    this.nextButton.addEventListener("click", () => this.showNextImage());
  }

  updateCarousel() {
    const offset = -this.currentIndex * 100; // Calculate the offset
    this.carouselImages.style.transform = `translateX(${offset}%)`; // Apply the offset

    // Update active class for carousel images
    this.images.forEach((image, index) => {
      image.classList.toggle("active", index === this.currentIndex);
    });

    // Update active class for gallery options if they exist
    if (this.galleryOptions) {
      this.galleryOptions.forEach((option, index) => {
        option.classList.toggle("active", index === this.currentIndex);
      });
    }
  }

  showNextImage() {
    this.currentIndex = (this.currentIndex + 1) % this.images.length; // Update the current index
    this.updateCarousel(); // Update the carousel view
  }

  showPrevImage() {
    this.currentIndex =
      (this.currentIndex - 1 + this.images.length) % this.images.length; // Update the current index
    this.updateCarousel(); // Update the carousel view
  }

  setCurrentIndex(index) {
    this.currentIndex = index;
    this.updateCarousel();
  }

  resetToFirstItem() {
    this.currentIndex = 0; // Reset the current index to the first item
    this.updateCarousel(); // Update the carousel to reflect the reset
  }
}
// Create a Map to store carousel instances by variant ID
const carouselMap = new Map();

// Function to initialize all carousels on the page with gallery options
function initializeCarousels() {
  const galleries = document.querySelectorAll(".product-description-gallery");

  galleries.forEach((gallery) => {
    const variantId = gallery.getAttribute("data-variant-id");
    console.log("gallery varient ID" + variantId);
    const galleryOptions = gallery.querySelectorAll(".gallery-option");
    const carousel = new Carousel(gallery, galleryOptions);

    // Store carousel instance in the Map with variantId as key
    carouselMap.set(variantId, carousel);

    // Set up click events for gallery options to sync with the carousel
    galleryOptions.forEach((option, index) => {
      option.addEventListener("click", () => {
        console.log(index);
        carousel.setCurrentIndex(index);
      });
      console.log("galleryOption index" + index);
    });
  });
}

// Call this function when the DOM is fully loaded
document.addEventListener("DOMContentLoaded", initializeCarousels);

function productDescription() {
  document.addEventListener("DOMContentLoaded", function () {
    const productDescription = document.querySelector(".product-description");
    const colorVariants =
      productDescription.querySelectorAll(".variant-option");
    const productDescriptionGalleries = document.querySelectorAll(
      ".product-description-gallery"
    );
    const variantDescriptions = document.querySelectorAll(
      ".variant-description"
    );

    if (
      colorVariants.length > 0 &&
      productDescriptionGalleries.length > 0 &&
      variantDescriptions.length > 0
    ) {
      colorVariants[0].classList.add("selected");
      productDescriptionGalleries[0].classList.add("selected");
      variantDescriptions[0].classList.add("selected");
    }

    colorVariants.forEach(function (variant) {
      variant.addEventListener("click", function () {
        const variantId = variant.getAttribute("data-variant-id");

        const productDescriptionGallery = document.querySelector(
          `.product-description-gallery[data-variant-id="${variantId}"]`
        );
        const variantDescription = document.querySelector(
          `.variant-description[data-variant-id="${variantId}"]`
        );

        colorVariants.forEach((v) => v.classList.remove("selected"));
        productDescriptionGalleries.forEach((g) =>
          g.classList.remove("selected")
        );
        variantDescriptions.forEach((d) => d.classList.remove("selected"));

        variant.classList.add("selected");
        if (productDescriptionGallery) {
          productDescriptionGallery.classList.add("selected");
        }
        if (variantDescription) {
          variantDescription.classList.add("selected");
        }

        // Use the Map to get the correct carousel and reset it
        const carousel = carouselMap.get(variantId);
        if (carousel) {
          carousel.resetToFirstItem();
        }

        content(variantId);
      });
    });
  });
}

function content(variantId) {
  const variant = getVariantDataById(variantId); // Implement this function to fetch variant data
  if (variant) {
    document.getElementById("modalVariantImage").src = variant.galleryImages[0]; // Set image source
    document.getElementById("modalProductName").innerText = variant.productName; // Set product name
    document.getElementById("modalVariantName").innerText = variant.variantName; // Set variant name
    document.getElementById(
      "modalProductPrice"
    ).innerText = `$${variant.price.toFixed(2)}`; // Set price
    document.querySelector(".variant-name").innerText = variant.variantName;
  }
}

// Ensure the getVariantDataById function is defined to retrieve variant details based on variantId
function getVariantDataById(variantId) {
  console.log("getVariantDatabyId" + variantId);
  // Assuming allProductDescriptionItems is accessible here
  for (let product of allProductDescriptionItems) {
    for (let variant of product.variants) {
      if (variant.variantId == variantId) {
        // Check for matching variant ID
        console.log("getVariantDatabyId returned");
        return {
          galleryImages: variant.galleryImages,
          productName: product.name,
          variantName: variant.variantName,
          price: product.price,
        };
      }
    }
  }
  return null; // Return null if no match is found
}

// Function to open a modal
function openModal(modal) {
  modal.classList.add("d-flex");
  modal.classList.add("active");
}

// Function to close a modal
function closeModal(modal) {
  modal.classList.remove("d-flex");
  modal.classList.remove("active");
  console.log("closeModal");
}

// Select the modal element
const modal = document.querySelector(".modal");

// Select all elements with the open-modal class and add event listeners
document.querySelectorAll(".open-modal").forEach((button) => {
  button.addEventListener("click", () => {
    openModal(modal);
  });
});

// Event listener for closing the modal
modal.addEventListener("click", (event) => {
  const isCloseButton =
    event.target.classList.contains("close-modal") ||
    event.target.classList.contains("close-btn");
  const isOutsideClick = event.target === modal;

  if (isCloseButton || isOutsideClick) {
    closeModal(modal);
  }
});

navbar();
productDescription();
window.updateQuantity = quantityControlUpdateQuantity;
