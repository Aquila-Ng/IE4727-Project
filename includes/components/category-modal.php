<?php

include("modal.php");

// Add Category Modal
renderModal(
    'addCategoryModal',              // Modal ID
    'Add Category',                  // Modal Title
    '../includes/scripts/add-edit.php', // Form action
    [
        ['type' => 'input', 'id' => 'categoryName', 'name' => 'name', 'input_type' => 'text', 'label' => 'Name', 'placeholder' => 'Enter Category Name', 'value' => '', 'required' => true]
    ],
    [
        'action' => 'addCategory',  // Hidden action field for form processing
        'actions' => [
            ['type' => 'submit', 'class' => 'btn-success', 'label' => 'Add'],
            ['type' => 'button', 'class' => 'btn-transparent', 'label' => 'Cancel', 'onclick' => 'closeModal("addCategoryModal")']
        ]
    ]
);

// Edit Category Modal
renderModal(
    'editCategoryModal',              // Modal ID
    'Edit Category',                  // Modal Title
    '../includes/scripts/add-edit.php', // Form action
    [
        ['type' => 'input', 'id' => 'editCategoryName', 'name' => 'name', 'input_type' => 'text', 'label' => 'Name', 'placeholder' => 'Enter Category Name', 'value' => '', 'required' => true]
    ],
    [
        'action' => 'editCategory', // Hidden action field for form processing
        'hidden_id' => 'editCategoryId', // Hidden input for the category ID
        'actions' => [
            ['type' => 'submit', 'class' => 'btn-warning', 'label' => 'Update'],
            ['type' => 'button', 'class' => 'btn-transparent', 'label' => 'Cancel', 'onclick' => 'closeModal("editCategoryModal")']
        ]
    ]
);