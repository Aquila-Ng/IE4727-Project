window.openEditModal = function (modalId, button) {
  // Get the data from the button's attributes
  const id = button.getAttribute("data-id");
  const name = button.getAttribute("data-name");
  const productId = button.getAttribute("data-productId");
  const color = button.getAttribute("data-variantColor");
  const quantity = button.getAttribute("data-variantQuantity");
  const image = button.getAttribute("data-variantImage");

  // Populate the modal's fields with these values
  document.getElementById("editVariantId").value = id; // Set hidden input for variant ID
  document.getElementById("editVariantName").value = name; // Set name field
  document.getElementById("editVariantProduct").value = productId; // Set product ID field
  document.getElementById("editVariantColor").value = color; // Set color field
  document.getElementById("editVariantQuantity").value = quantity; // Set quantity field
  document.getElementById("editVariantImage").value = image;

  // Display the modal
  document.getElementById(modalId).style.display = "flex";
};

window.openAddModal = function (modalId, button) {
  // Display the modal
  document.getElementById(modalId).style.display = "flex";
};

// Function to close a modal
window.closeModal = function (modalId) {
  var modal = document.getElementById(modalId);
  modal.style.display = "none";
};

// Close modals when clicking outside the content area
window.onclick = function (event) {
  const modals = document.getElementsByClassName("modal");
  Array.from(modals).forEach((modal) => {
    if (event.target === modal) {
      modal.style.display = "none";
    }
  });
};
