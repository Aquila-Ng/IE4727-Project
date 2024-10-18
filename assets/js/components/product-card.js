export function productCard() {
  document.addEventListener("DOMContentLoaded", function () {
    // Select all product cards
    const productCards = document.querySelectorAll(".product-card");

    productCards.forEach(function (card) {
      const productId = card.getAttribute("data-id");
      // Select product image and color variants for this specific card
      const colorVariants = card.querySelectorAll(
        ".variant-option[data-id='" + productId + "']"
      );
      const productImage = card.querySelector(
        ".product-image[data-id='" + productId + "']"
      );

      // Set the first color as selected by default
      colorVariants[0].classList.add("selected");

      // When a color variant is clicked
      colorVariants.forEach(function (variant) {
        variant.addEventListener("click", function () {
          // Remove the 'selected' class from all variants in this card
          colorVariants.forEach(function (v) {
            v.classList.remove("selected");
          });

          // Add 'selected' class to the clicked variant
          variant.classList.add("selected");

          // Change the product image based on the clicked variant
          const newImageSrc = variant.getAttribute("data-image");
          productImage.setAttribute("src", newImageSrc);
        });
      });
    });
  });
}
