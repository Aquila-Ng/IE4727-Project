export function updateQuantity(change, variantId) {
  // Corrected template literals with backticks
  const quantityInputId = `quantity-${variantId}`;
  console.log(`Attempting to access: ${quantityInputId}`);
  const quantityInput = document.getElementById(quantityInputId);

  if (!quantityInput) {
    console.error(`Element with ID ${quantityInputId} not found!`);
    return; // Exit if the input is null
  }

  let currentQuantity = parseInt(quantityInput.value);
  let maxQuantity = parseInt(quantityInput.max);

  if (isNaN(currentQuantity)) {
    console.error(`Current quantity is not a number: ${currentQuantity}`);
    return; // Handle the case where the value is not a number
  }

  // Update the quantity while keeping it within limits
  currentQuantity = Math.max(1, currentQuantity + change); // Ensure quantity is at least 1
  if (currentQuantity > maxQuantity) {
    currentQuantity = maxQuantity;
  }

  // Set the updated value in the input
  quantityInput.value = currentQuantity;
  console.log("Updated quantity Input Value: " + quantityInput.value);

  // Call additional functions if needed
  updateSubtotal(variantId);
  updateOrderSummary();
}
