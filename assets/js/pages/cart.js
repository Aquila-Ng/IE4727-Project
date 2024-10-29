// import { updateQuantity } from "../components/quantity-control.js";
import { updateQuantity as quantityControlUpdateQuantity } from "../components/quantity-control.js"; // Adjust the path as necessary
// export { updateQuantity };
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

// Function to update the subtotal based on the quantity
export function updateSubtotal(variantId) {
  const quantityInput = document.getElementById(`quantity-${variantId}`);

  if (!quantityInput) {
    console.error(`Quantity input not found for variantId: ${variantId}`);
    return;
  }

  const quantity = parseInt(quantityInput.value);

  if (isNaN(quantity)) {
    console.error(`Quantity value is NaN for variantId: ${variantId}`);
    return;
  }

  const itemPriceElement = document.getElementById(`price-${variantId}`);
  if (!itemPriceElement) {
    console.error(`Price element not found for variantId: ${variantId}`);
    return;
  }

  const itemPrice = parseFloat(itemPriceElement.innerText);

  if (isNaN(itemPrice)) {
    console.error(`Item price is NaN for variantId: ${variantId}`);
    return;
  }

  const subtotal = (itemPrice * quantity).toFixed(2);
  const subtotalElement = document.getElementById(`subtotal-${variantId}`);
  if (subtotalElement) {
    subtotalElement.innerText = subtotal;
  } else {
    console.error(`Subtotal element not found for variantId: ${variantId}`);
  }
}

// Export updateQuantity and make it available globally
window.updateQuantity = quantityControlUpdateQuantity;
window.updateSubtotal = updateSubtotal;
