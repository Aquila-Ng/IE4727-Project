import { productCard } from "../components/product-card.js";
import { navbar } from "../components/navbar.js";

document.addEventListener("DOMContentLoaded", function () {
  const filterButton = document.getElementById("filterButton");
  const filterPanel = document.getElementById("filterPanel");
  const closeButton = document.getElementById("closeButton");
  const overlay = document.getElementById("overlay");

  filterButton.addEventListener("click", function () {
    filterPanel.classList.toggle("active"); // Toggle the active class
    overlay.classList.add("active");
  });

  closeButton.addEventListener("click", function () {
    filterPanel.classList.remove("active"); // Remove the active class
    overlay.classList.remove("active");
  });
  overlay.addEventListener("click", function () {
    filterPanel.classList.remove("active");
    overlay.classList.remove("active");
  });
});

document.querySelectorAll("#sortOptions .item").forEach((item) => {
  item.addEventListener("click", function () {
    // Remove the 'selected' class from all sort options
    document.querySelectorAll("#sortOptions .item").forEach((option) => {
      option.classList.remove("selected");
    });

    // Add the 'selected' class to the clicked sort option
    this.classList.add("selected");

    const sortOption = this.getAttribute("data-value");
    // renderProductList(sortOption);
  });
});

// Function to  handle sorting and fetching of products
function fetchAndRenderProducts(sortOption) {
  // Fetch sorted products from the backend
  fetch(`fetch-products.php?sort=${sortOption}`)
    .then((response) => response.json())
    .then((data) => {
      // Send sorted product data to PHP for HTML rendering
      renderProductList(data);
    })
    .catch((error) => console.error("Error fetching sorted products:", error));
}

// Function to send product data to PHP and render HTML
function renderProductList(products) {
  fetch("render-products.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(products),
  })
    .then((response) => response.text())
    .then((html) => {
      const productContainer = document.getElementById("product-container");
      productContainer.innerHTML = html; // Insert rendered HTML into the container
    })
    .catch((error) => console.error("Error rendering product list:", error));
}
// Function to update the price display based on slider values
function updatePriceDisplay() {
  const minRange = document.getElementById("minRange");
  const maxRange = document.getElementById("maxRange");
  const minPriceDisplay = document.getElementById("minPriceInput");
  const maxPriceDisplay = document.getElementById("maxPriceInput");

  // Prevent min slider from going above max slider and vice versa
  if (parseInt(minRange.value) > parseInt(maxRange.value)) {
    minRange.value = maxRange.value;
  } else if (parseInt(maxRange.value) < parseInt(minRange.value)) {
    maxRange.value = minRange.value;
  }

  // Update displayed values
  minPriceDisplay.value = `${parseInt(minRange.value)}`;
  maxPriceDisplay.value = `${parseInt(maxRange.value)}`;
  console.log("price updated!");
}

// Function to update min and max slider values based on input
function updateMinMax() {
  const minRange = document.getElementById("minRange");
  const maxRange = document.getElementById("maxRange");
  const minPriceInput = document.getElementById("minPriceInput");
  const maxPriceInput = document.getElementById("maxPriceInput");

  // Ensure minRange doesn't go above maxRange
  if (parseInt(minRange.value) > parseInt(maxRange.value)) {
    minRange.value = maxRange.value;
  }

  // Ensure maxRange doesn't go below minRange
  if (parseInt(maxRange.value) < parseInt(minRange.value)) {
    maxRange.value = minRange.value;
  }

  // Update input fields with the slider values
  minPriceInput.value = minRange.value;
  maxPriceInput.value = maxRange.value;
  console.log("updateMinMax");
  // Update displayed values
  updatePriceDisplay();
}

// Function to sync slider values with input fields
function syncSliderWithInput(type) {
  const minRange = document.getElementById("minRange");
  const maxRange = document.getElementById("maxRange");
  const minPriceInput = document.getElementById("minPriceInput");
  const maxPriceInput = document.getElementById("maxPriceInput");

  if (type === "min") {
    // Ensure min input does not exceed max value
    if (parseInt(minPriceInput.value) > parseInt(maxPriceInput.value)) {
      minPriceInput.value = maxPriceInput.value;
    }
    minRange.value = minPriceInput.value;
  } else if (type === "max") {
    // Ensure max input does not go below min value
    if (parseInt(maxPriceInput.value) < parseInt(minPriceInput.value)) {
      maxPriceInput.value = minPriceInput.value;
    }
    maxRange.value = maxPriceInput.value;
  }

  // Update the displayed price values
  updatePriceDisplay();
}

// Attach event listeners for slider and input changes
document
  .getElementById("minRange")
  .addEventListener("input", updatePriceDisplay);
document
  .getElementById("maxRange")
  .addEventListener("input", updatePriceDisplay);
document
  .getElementById("minPriceInput")
  .addEventListener("change", () => syncSliderWithInput("min"));
document
  .getElementById("maxPriceInput")
  .addEventListener("change", () => syncSliderWithInput("max"));

window.updateMinMax = updateMinMax;
window.syncSliderWithInput = syncSliderWithInput;
productCard();
navbar();
