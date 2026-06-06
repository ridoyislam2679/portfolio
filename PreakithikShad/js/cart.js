// Quantity +/-
document.querySelectorAll(".plus").forEach(btn => {
    btn.addEventListener("click", function() {
        let input = this.previousElementSibling;
        input.value = parseInt(input.value) + 1;
        updateCartRow(input);
    });
});

document.querySelectorAll(".minus").forEach(btn => {
    btn.addEventListener("click", function() {
        let input = this.nextElementSibling;
        if (parseInt(input.value) > 1) {
            input.value = parseInt(input.value) - 1;
            updateCartRow(input);
        }
    });
});

// Update subtotal, total and save via AJAX
function updateCartRow(input) {
    let price = parseFloat(input.dataset.price);
    let qty = parseInt(input.value);
    let row = input.closest("tr");
    let subtotalCell = row.querySelector(".subtotal");
    subtotalCell.textContent = "৳" + (price * qty);

    // Recalculate totals
    calculateTotal();

    // AJAX call to save new quantity
    let cart_id = row.getAttribute("data-id");
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "update_cart_ajax.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("id=" + cart_id + "&qty=" + qty);
}

function calculateTotal() {
    let subtotal = 0;
    document.querySelectorAll(".qty-input").forEach(inp => {
        subtotal += parseFloat(inp.dataset.price) * parseInt(inp.value);
    });

    let delivery = 50; // fixed charge
    let tax = 0;       // future formula: subtotal * 0.05 for 5% tax

    let grandTotal = subtotal + delivery + tax;

    // Update in all places
    document.getElementById("subtotal-amount").textContent = subtotal + " টাকা";
    document.getElementById("delivery-charge").textContent = delivery + " টাকা";
    document.getElementById("tax-amount").textContent = tax + " টাকা";
    document.getElementById("total-with-charge").textContent = grandTotal + "";
}