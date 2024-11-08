<?php

include("modal.php");

// Add Product Modal
renderModal(
    'addProductModal',                   // Modal ID
    'Add Product',                       // Modal Title
    '../includes/scripts/add-edit.php',            // Form action
    [
        [
            'type' => 'input',
            'id' => 'productName',
            'name' => 'name',
            'input_type' => 'text',
            'label' => 'Product Name',
            'placeholder' => 'Enter Product Name',
            'value' => '',
            'required' => true
        ],
        [
            'type' => 'input',
            'id' => 'productDescription',
            'name' => 'description',
            'input_type' => 'text',
            'label' => 'Description',
            'placeholder' => 'Enter Product Description',
            'value' => '',
            'required' => true
        ],
        [
            'type' => 'input',
            'id' => 'productPrice',
            'name' => 'price',
            'input_type' => 'number',
            'label' => 'Price',
            'placeholder' => 'Enter Product Price',
            'value' => '',
            'required' => true
        ],
        [
            'type' => 'select',
            'id' => 'productCategory',
            'name' => 'category_id',
            'label' => 'Category',
            'options' => getCategoryOptions($conn), // Use the updated function
            'required' => true
        ]
    ],
    [
        'action' => 'addProduct',            // Hidden action field for form processing
        'actions' => [
            ['type' => 'submit', 'class' => 'btn-success', 'label' => 'Add'],
            ['type' => 'button', 'class' => 'btn-transparent', 'label' => 'Cancel', 'onclick' => 'closeModal("addProductModal")']
        ]
    ]
);

// Edit Product Modal
renderModal(
    'editProductModal',                  // Modal ID
    'Edit Product',                      // Modal Title
    '../includes/scripts/add-edit.php',            // Form action
    [
        [
            'type' => 'input',
            'id' => 'editProductName',
            'name' => 'name',
            'input_type' => 'text',
            'label' => 'Product Name',
            'placeholder' => 'Enter Product Name',
            'value' => '', // Ideally, this should be populated with the current product's name
            'required' => true
        ],
        [
            'type' => 'input',
            'id' => 'editProductDescription',
            'name' => 'description',
            'input_type' => 'text',
            'label' => 'Description',
            'placeholder' => 'Enter Product Description',
            'value' => '', // Ideally, this should be populated with the current product's description
            'required' => true
        ],
        [
            'type' => 'input',
            'id' => 'editProductPrice',
            'name' => 'price',
            'input_type' => 'number',
            'label' => 'Price',
            'placeholder' => 'Enter Product Price',
            'value' => '', // Ideally, this should be populated with the current product's price
            'required' => true
        ],
        [
            'type' => 'select',
            'id' => 'editProductCategory',
            'name' => 'category_id',
            'label' => 'Category',
            'options' => getCategoryOptions($conn, $selectedCategoryId), // Populate with the correct category ID
            'required' => true
        ]
    ],
    [
        'action' => 'editProduct',          // Hidden action field for form processing
        'hidden_id' => 'editProductId',    // Hidden input for the product ID
        'actions' => [
            ['type' => 'submit', 'class' => 'btn-warning', 'label' => 'Edit'],
            ['type' => 'button', 'class' => 'btn-transparent', 'label' => 'Cancel', 'onclick' => 'closeModal("editProductModal")']
        ]
    ]
);
?>