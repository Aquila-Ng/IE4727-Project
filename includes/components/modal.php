

<?php


// Function to render a single column input field
function renderModalRowInputField($id, $name, $type, $label, $placeholder, $value = '', $required = true) {
    ?>
    <div class="form-group row">
        <label for="<?php echo htmlspecialchars($name); ?>"><h3 class="emphasized"><?php echo htmlspecialchars($label); ?></h3></label>
        <input type="<?php echo htmlspecialchars($type); ?>" id="<?php echo htmlspecialchars($id); ?>" name="<?php echo htmlspecialchars($name); ?>" class="form-control" placeholder="<?php echo htmlspecialchars($placeholder); ?>" value="<?php echo htmlspecialchars($value); ?>" <?php echo $required ? 'required' : ''; ?>>
    </div>
    <?php
}

// Function to render a single column textarea input field
function renderModalColTextareaField($id, $name, $label, $placeholder, $value = '', $required = true) {
    ?>
    <div class="form-group row">
        <label for="<?php echo htmlspecialchars($name); ?>"><h3 class="emphasized"><?php echo htmlspecialchars($label); ?></h3></label>
        <textarea id="<?php echo htmlspecialchars($id); ?>" name="<?php echo htmlspecialchars($name); ?>" class="form-control" placeholder="<?php echo htmlspecialchars($placeholder); ?>" <?php echo $required ? 'required' : ''; ?>><?php echo htmlspecialchars($value); ?></textarea>
    </div>
    <?php
}

// Function to render a select dropdown
function renderSelect($id, $name, $label, $options = [], $selectedValue = null, $required = true) {
    ?>
    <div class="form-group row">
        <label for="<?php echo htmlspecialchars($name); ?>"><h3 class="emphasized"><?php echo htmlspecialchars($label); ?></h3></label>
        <select id="<?php echo htmlspecialchars($id); ?>" name="<?php echo htmlspecialchars($name); ?>" class="form-control" <?php echo $required ? 'required' : ''; ?>>
            <?php
            foreach ($options as $value => $text) {
                $selected = ($value == $selectedValue) ? 'selected' : '';
                echo "<option value=\"" . htmlspecialchars($value) . "\" $selected>" . htmlspecialchars($text) . "</option>";
            }
            ?>
        </select>
    </div>
    <?php
}

// Function to get category options
function getCategoryOptions($conn, $selectedCategoryId = null) {
    $options = []; // Initialize as an associative array

    // Fetch categories from the database
    $result = $conn->query("SELECT * FROM categories");

    while ($row = $result->fetch_assoc()) {
        // Add each category to the options array
        $options[$row['id']] = $row['name'];
    }
    
    return $options; // Return the associative array of options
}

// Function to get product options
function getProductOptions($conn, $selectedProductId = null) {
    $options = []; // Initialize as an associative array

    // Fetch products from the database
    $result = $conn->query("SELECT * FROM products");

    if ($result) {
        while ($row = $result->fetch_assoc()) {
            // Add each product to the options array
            $options[$row['id']] = $row['name'];
        }
    } else {
        // Handle query error if necessary
        $options[''] = 'Error fetching products'; // Option to indicate an error
    }

    return $options; // Return the associative array of options
}

function renderModal($modalId, $title, $action, $fields, $buttons) {
    echo "
    <div id='{$modalId}' class='modal justify-center items-center'>
        <div class='modal-content'>
            <span class='close-btn' onclick=\"closeModal('{$modalId}')\">&times;</span>
            <h2>{$title}</h2>
            <form action='{$action}' method='POST'>
    ";

    foreach ($fields as $field) {
        if ($field['type'] === 'input') {
            renderModalRowInputField(
                $field['id'], 
                $field['name'], 
                $field['input_type'], 
                $field['label'], 
                $field['placeholder'], 
                $field['value'], 
                $field['required']
            );
        } elseif ($field['type'] === 'select') {
            // Use the renderSelect function to generate the dropdown
            renderSelect(
                $field['id'], 
                $field['name'], 
                $field['label'], 
                $field['options'], 
                $field['selected'] ?? null, // Optional selected value
                $field['required'] ?? true // Default to required
            );
        }
    }

    echo "<input type='hidden' name='action' value='{$buttons['action']}'>";
    if (isset($buttons['hidden_id'])) {
        echo "<input type='hidden' name='id' id='{$buttons['hidden_id']}'>";
    }

    foreach ($buttons['actions'] as $button) {
        echo "<button type='{$button['type']}' class='btn {$button['class']} full'>{$button['label']}</button>";
    }

    echo "
            </form>
        </div>
    </div>
    ";
}


// Add Category Modal
renderModal(
    'addCategoryModal',              // Modal ID
    'Add Category',                  // Modal Title
    './scripts/add-edit.php', // Form action
    [
        ['type' => 'input', 'id' => 'categoryName', 'name' => 'name', 'input_type' => 'text', 'label' => 'Name', 'placeholder' => 'Enter Category Name', 'value' => '', 'required' => true],
        ['type' => 'input', 'id' => 'categoryDescription', 'name' => 'description', 'input_type' => 'text', 'label' => 'Description', 'placeholder' => 'Enter Category Description', 'value' => '', 'required' => false]
    ],
    [
        'action' => 'addCategory',  // Hidden action field for form processing
        'actions' => [
            ['type' => 'submit', 'class' => 'btn-success', 'label' => 'Add'],
            ['type' => 'button', 'class' => 'btn-transparent', 'label' => 'Cancel', 'onclick' => "closeModal('addCategoryModal')"]
        ]
    ]
);

// Edit Category Modal
renderModal(
    'editCategoryModal',              // Modal ID
    'Edit Category',                  // Modal Title
    './scripts/add-edit.php', // Form action
    [
        ['type' => 'input', 'id' => 'editCategoryName', 'name' => 'name', 'input_type' => 'text', 'label' => 'Name', 'placeholder' => 'Enter Category Name', 'value' => '', 'required' => true],
        ['type' => 'input', 'id' => 'editCategoryDescription', 'name' => 'description', 'input_type' => 'text', 'label' => 'Description', 'placeholder' => 'Enter Category Description', 'value' => '', 'required' => false]
    ],
    [
        'action' => 'editCategory', // Hidden action field for form processing
        'hidden_id' => 'editCategoryId', // Hidden input for the category ID
        'actions' => [
            ['type' => 'submit', 'class' => 'btn-success', 'label' => 'Update'],
            ['type' => 'button', 'class' => 'btn-transparent', 'label' => 'Cancel', 'onclick' => "closeModal('editCategoryModal')"]
        ]
    ]
);

// Add Product Modal
renderModal(
    'addProductModal',                   // Modal ID
    'Add Product',                       // Modal Title
    './scripts/add-edit.php',            // Form action
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
            'type' => 'textarea',
            'id' => 'productDescription',
            'name' => 'description',
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
            ['type' => 'button', 'class' => 'btn-transparent', 'label' => 'Cancel', 'onclick' => "closeModal('addProductModal')"]
        ]
    ]
);

// Edit Product Modal
renderModal(
    'editProductModal',                  // Modal ID
    'Edit Product',                      // Modal Title
    './scripts/add-edit.php',            // Form action
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
            'type' => 'textarea',
            'id' => 'editProductDescription',
            'name' => 'description',
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
            'selected' => 2,
            'options' => getCategoryOptions($conn, $selectedCategoryId), // Populate with the correct category ID
            'required' => true
        ]
    ],
    [
        'action' => 'editProduct',          // Hidden action field for form processing
        'hidden_id' => 'editProductId',    // Hidden input for the product ID
        'actions' => [
            ['type' => 'submit', 'class' => 'btn-warning', 'label' => 'Update'],
            ['type' => 'button', 'class' => 'btn-transparent', 'label' => 'Cancel', 'onclick' => "closeModal('editProductModal')"]
        ]
    ]
);

// Add Variant Modal
renderModal(
    'addVariantModal',                   // Modal ID
    'Add Variant',                       // Modal Title
    './scripts/add-edit.php',            // Form action
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
            ['type' => 'button', 'class' => 'btn-transparent', 'label' => 'Cancel', 'onclick' => "closeModal('addVariantModal')"]
        ]
    ]
);
// Edit Variant Modal
renderModal(
    'editVariantModal',                  // Modal ID
    'Edit Variant',                      // Modal Title
    './scripts/add-edit.php',            // Form action
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
            'selected' => NULL,
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
            ['type' => 'submit', 'class' => 'btn-warning', 'label' => 'Update'],
            ['type' => 'button', 'class' => 'btn-transparent', 'label' => 'Cancel', 'onclick' => "closeModal('editVariantModal')"]
        ]
    ]
);



?>


















