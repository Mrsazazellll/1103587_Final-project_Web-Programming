// Toggle Cart
let cartItem = document.querySelector(".cart");
let navbar = document.querySelector(".navbar");

document.querySelector("#cart-btn").onclick = (e) => {
  e.stopPropagation(); // Prevent bubbling event
  cartItem.classList.toggle("active");
  navbar.classList.remove("active"); // Close navbar if cart on open
};

// Toggle Navbar
document.querySelector("#menu-btn").onclick = (e) => {
  e.stopPropagation(); // Prevent bubbling event
  navbar.classList.toggle("active");
  cartItem.classList.remove("active"); // Close cart if navbar on open
};

// Close Cart or Navbar when Clicking Outside
document.addEventListener("click", (e) => {
  if (!cartItem.contains(e.target) && !navbar.contains(e.target)) {
    cartItem.classList.remove("active");
    navbar.classList.remove("active");
  }
});

// Prevent Closing When Clicking Inside Cart or Navbar
cartItem.addEventListener("click", (e) => e.stopPropagation());
navbar.addEventListener("click", (e) => e.stopPropagation());

// Toggle Delivery Address Field Based on Option
document.querySelectorAll('input[name="delivery_option"]').forEach((option) => {
  option.addEventListener("change", function () {
    const addressField = document.getElementById("delivery_address_field");
    addressField.style.display = this.value === "delivery" ? "block" : "none";
  });
});
