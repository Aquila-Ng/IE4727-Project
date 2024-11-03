import { updateQuantity as quantityControlUpdateQuantity } from "../components/quantity-control.js"; // Adjust the path as necessary

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
  const itemPriceText = itemPriceElement.textContent; // Get the text content
  const itemPrice = parseFloat(itemPriceText.replace(/[$,]/g, "")); // Remove $ and convert to number

  if (isNaN(itemPrice)) {
    console.error(`Item price is NaN for variantId: ${variantId}`);
    return;
  }

  const subtotal = (itemPrice * quantity).toFixed(2);
  const subtotalElement = document.getElementById(`subtotal-${variantId}`);
  if (subtotalElement) {
    subtotalElement.innerText = "$" + subtotal;
  } else {
    console.error(`Subtotal element not found for variantId: ${variantId}`);
  }
}

export function updateOrderSummary() {
  // Select all elements with an ID that contains "subtotal"
  const quantityElements = document.querySelectorAll('[id*="quantity"]');
  let orderItems = 0;

  // Loop through each quantity element and add to orderItems
  quantityElements.forEach((element) => {
    const quantity = parseInt(element.value, 10); // Convert to an integer
    orderItems += quantity;
  });

  const orderItemsElement = document.getElementById("orderItems");
  if (orderItemsElement) {
    orderItemsElement.innerText =
      orderItems + (orderItems === 1 ? " item" : " items");
  } else {
    console.error("Order Items Element not found.");
  }

  // Select all elements with an ID that contains "subtotal"
  const subtotalElements = document.querySelectorAll('[id*="subtotal"]');
  let orderSubtotal = 0;

  // Loop through each subtotal element and add to orderSubtotal
  subtotalElements.forEach((element) => {
    const subtotalText = element.textContent;
    const subtotal = parseFloat(subtotalText.replace(/[$,]/g, ""));
    orderSubtotal += subtotal;
  });

  orderSubtotal = orderSubtotal.toFixed(2);

  // Update the order subtotal in the DOM
  const orderSubtotalElement = document.getElementById("orderSubtotal");
  if (orderSubtotalElement) {
    orderSubtotalElement.innerText = "$" + orderSubtotal;
  } else {
    console.error(`Subtotal element not found.`);
  }

  // Get and parse the delivery fee
  const deliveryElement = document.getElementById("delivery");
  let delivery = 0;
  if (deliveryElement) {
    if (orderItems !== 0) {
      const deliveryText = deliveryElement.textContent;
      delivery = parseFloat(deliveryText.replace(/[$,]/g, ""));
    } else {
      delivery = 0;
      deliveryElement.innerText = "$" + delivery.toFixed(2);
    }
  }

  // Calculate GST based on orderSubtotal
  const gst = ((orderSubtotal / 1.09) * 0.09).toFixed(2);
  const gstElement = document.getElementById("gst");
  if (gstElement) {
    gstElement.innerText = "$" + gst;
  }

  // Calculate and display the total order cost
  const orderTotal = (parseFloat(orderSubtotal) + delivery).toFixed(2);
  const orderTotalElement = document.getElementById("orderTotal");
  if (orderTotalElement) {
    orderTotalElement.innerText = "$" + orderTotal;
  }
}

// Wait for the DOM to load before attaching event listeners
document.addEventListener("DOMContentLoaded", () => {
  // Select all delete buttons with the 'delete-button' class
  const deleteButtons = document.querySelectorAll(".delete-button");

  deleteButtons.forEach((button) => {
    button.addEventListener("click", (event) => {
      // Get the cart row element to be deleted
      const cartRow = event.target.closest("tr[data-cartId]");

      // Remove the cart row from the DOM
      if (cartRow) {
        cartRow.remove();
        updateOrderSummary();
      }
    });
  });
});

// Export updateQuantity and make it available globally
window.updateQuantity = quantityControlUpdateQuantity;
window.updateSubtotal = updateSubtotal;
window.updateOrderSummary = updateOrderSummary;

updateOrderSummary();
