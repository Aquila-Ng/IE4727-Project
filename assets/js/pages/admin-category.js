window.openEditModal = function (modalId, button) {
  // Get the data from the button's attributes
  const id = button.getAttribute("data-id");
  const name = button.getAttribute("data-name");

  // Populate the modal's fields with these values
  document.getElementById("editCategoryId").value = id; // Set hidden input for variant ID
  document.getElementById("editCategoryName").value = name; // Set name field

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
