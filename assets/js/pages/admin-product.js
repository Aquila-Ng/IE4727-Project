window.openEditModal = function (modalId, button) {
  // Get the data from the button's attributes
  const id = button.getAttribute("data-id");
  const name = button.getAttribute("data-name");
  const description = button.getAttribute("data-description");
  const price = button.getAttribute("data-price");
  const categoryId = button.getAttribute("data-categoryId");

  // Populate the modal's fields with these values
  document.getElementById("editProductId").value = id; // Set hidden input for variant ID
  document.getElementById("editProductName").value = name; // Set name field
  document.getElementById("editProductDescription").value = description; // Set product ID field
  document.getElementById("editProductPrice").value = price; // Set color field
  document.getElementById("editProductCategory").value = categoryId; // Set quantity field

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
