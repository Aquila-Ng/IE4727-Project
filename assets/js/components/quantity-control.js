export function updateQuantity(change, variantId) {
  const quantityInputId = `quantity-${variantId}`;
  console.log(`Attempting to access: ${quantityInputId}`);
  const quantityInput = document.getElementById(quantityInputId);

  if (!quantityInput) {
    console.error(`Element with ID ${quantityInputId} not found!`);
    return; // Exit if the input is null
  }

  let currentQuantity = parseInt(quantityInput.value);
  if (isNaN(currentQuantity)) {
    console.error(`Current quantity is not a number: ${currentQuantity}`);
    return; // Handle the case where the value is not a number
  }

  currentQuantity = Math.max(1, currentQuantity + change); // Ensure quantity is at least 1
  quantityInput.value = currentQuantity;
  updateSubtotal(variantId); // Call updateSubtotal after changing quantity
}
