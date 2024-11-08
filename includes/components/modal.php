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
function renderSelect($id, $name, $label, $options = [], $selectedId = null, $required = true) {
    ?>
    <div class="form-group row">
        <label for="<?php echo htmlspecialchars($id); ?>">
            <h3 class="emphasized"><?php echo htmlspecialchars($label); ?></h3>
        </label>
        <select id="<?php echo htmlspecialchars($id); ?>" name="<?php echo htmlspecialchars($name); ?>" class="form-control" <?php echo $required ? 'required' : ''; ?>>
            <?php
            foreach ($options as $value => $text) {
                $selected = ($value === $selectedId) ? 'selected' : ''; // Use strict comparison
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

    // Check if the query was successful
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            // Add each product to the options array
            $options[$row['id']] = $row['name'];
        }
    } else {
        // Handle query failure (optional)
        error_log("Database query failed: " . $conn->error);
        return false; // Or handle in another way as needed
    }

    return $options; // Return the associative array of options
}

function renderModal($modalId, $title, $action, $fields, $buttons) {
    echo "

    <div id='{$modalId}' class='modal justify-center items-center'>
        <div class='modal-content justify-start'>
            <span class='close-btn' onclick=\"closeModal('{$modalId}')\">&times;</span>
            <h2 class='emphasized'>{$title}</h2>
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
    echo "<div class='flex-row gap-1 mt-1'>";
    foreach ($buttons['actions'] as $button) {
        $onclick = isset($button['onclick']) ? "onclick='{$button['onclick']}'" : '';
        echo "<button type='{$button['type']}' class='btn {$button['class']} full' {$onclick}>{$button['label']}</button>";
    }

    echo "
                </div>
            </form>
        </div>
    </div>
    ";
}
?>