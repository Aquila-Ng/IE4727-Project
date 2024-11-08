<?php

include("modal.php");

// Add Variant Modal
renderModal(
    'addVariantModal',                   // Modal ID
    'Add Variant',                       // Modal Title
    '../includes/scripts/add-edit.php',            // Form action
    [
        [
            'type' => 'input',
            'id' => 'variantName',
            'name' => 'name',
            'input_type' => 'text',
            'label' => 'Name',
            'placeholder' => 'Enter Variant Name',
            'value' => '',
            'required' => true
        ],
        [
            'type' => 'input',
            'id' => 'variantColor',
            'name' => 'color',
            'input_type' => 'text',
            'label' => 'Color',
            'placeholder' => 'Enter Variant Color',
            'value' => '',
            'required' => true
        ],
        [
            'type' => 'input',
            'id' => 'variantQuantity',
            'name' => 'quantity',
            'input_type' => 'number',
            'label' => 'Quantity',
            'placeholder' => 'Enter Variant Quantity',
            'value' => '',
            'required' => true
        ],
        [
            'type' => 'select',
            'id' => 'variantProduct',
            'name' => 'product_id',
            'label' => 'Product',
            'placeholder' => 'Select Product',
            'options' => getProductOptions($conn), // Fetch product options
            'required' => true
        ],
        [
            'type' => 'input',
            'id' => 'variantImage',
            'name' => 'image',
            'input_type' => 'text',
            'label' => 'Image URL',
            'placeholder' => 'Enter Image Url',
            'value' => '',
            'required' => true
        ]
    ],
    [
        'action' => 'addVariant',            // Hidden action field for form processing
        'actions' => [
            ['type' => 'submit', 'class' => 'btn-success', 'label' => 'Add'],
            ['type' => 'button', 'class' => 'btn-transparent', 'label' => 'Cancel', 'onclick' => 'closeModal("addVariantModal")']
        ]
    ]
);
//Edit Variant Modal
renderModal(
    'editVariantModal',                  // Modal ID
    'Edit Variant',                      // Modal Title
    '../includes/scripts/add-edit.php',            // Form action
    [
        [
            'type' => 'input',
            'id' => 'editVariantName',
            'name' => 'name',
            'input_type' => 'text',
            'label' => 'Name',
            'placeholder' => 'Enter Variant Name',
            'value' => '', // Ideally, this should be populated with the current variant's name
            'required' => true
        ],
        [
            'type' => 'input',
            'id' => 'editVariantColor',
            'name' => 'color',
            'input_type' => 'text',
            'label' => 'Color',
            'placeholder' => 'Enter Variant Color',
            'value' => '', // Ideally, this should be populated with the current variant's color
            'required' => true
        ],
        [
            'type' => 'input',
            'id' => 'editVariantQuantity',
            'name' => 'quantity',
            'input_type' => 'number',
            'label' => 'Quantity',
            'placeholder' => 'Enter Variant Quantity',
            'value' => '', // Ideally, this should be populated with the current variant's quantity
            'required' => true
        ],
        [
            'type' => 'select',
            'id' => 'editVariantProduct',
            'name' => 'product_id',
            'label' => 'Product',
            'placeholder' => 'Select Product',
            'options' => getProductOptions($conn), // Populate with the correct product ID
            'required' => true
        ],
        [
            'type' => 'input',
            'id' => 'editVariantImage',
            'name' => 'image',
            'input_type' => 'text',
            'label' => 'Image URL',
            'placeholder' => 'Enter Image Url',
            'value' => '', // Ideally, this should be populated with the current variant's image URL
            'required' => true
        ]
    ],
    [
        'action' => 'editVariant',           // Hidden action field for form processing
        'hidden_id' => 'editVariantId',      // Hidden input for the variant ID
        'actions' => [
            ['type' => 'submit', 'class' => 'btn-warning', 'label' => 'Edit'],
            ['type' => 'button', 'class' => 'btn-transparent', 'label' => 'Cancel', 'onclick' => 'closeModal("editVariantModal");']
        ]
    ]
);
?>