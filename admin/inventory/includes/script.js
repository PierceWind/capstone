// jQuery script for handling category selection and displaying products
$(document).ready(function () {
    $('input[name="categories[]"]').change(function () {
        var selectedCategories = $('input[name="categories[]"]:checked').map(function () {
            return this.value;
        }).get();

        // Clear all product lists
        $('.product-list').empty();

        selectedCategories.forEach(function (category) {
            $.ajax({
                type: "POST",
                url: "get_products.php", // Create a separate PHP script to fetch products based on categories
                data: { categories: [category] }, // Fetch products for the selected category
                success: function (response) {
                    // Append products to the corresponding product list
                    $('#product_list_' + category).html(response);
                }
            });
        });
    });
});
