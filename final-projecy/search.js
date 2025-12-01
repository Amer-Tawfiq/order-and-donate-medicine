// Pharmaceutical Research Function
function searchMedicine() {
    const searchQuery = document.getElementById('search-box').value.toLowerCase(); // Get the search text and convert it to lowercase letters
    const products = document.querySelectorAll('.product'); // Get all the items for your medications

    products.forEach(product => {
        const productName = product.querySelector('h3').textContent.toLowerCase(); // Get the name of the drug from each product

        if (productName.includes(searchQuery)) {
            product.style.display = 'block'; // View the item if the word exists
        } else {
            product.style.display = 'none'; // Hide item if word doesn't match
        }
    });
}

