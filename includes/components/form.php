
<?php
// Function to render a single column input field
function renderColInputField($id, $type, $label, $placeholder, $value = '', $required = true) {
    ?>
    <div class="col">
        <label for="<?php echo htmlspecialchars($id); ?>"><h3 class="emphasized"><?php echo htmlspecialchars($label); ?></h3></label>
        <input type="<?php echo htmlspecialchars($type); ?>" id="<?php echo htmlspecialchars($id); ?>" name="<?php echo htmlspecialchars($id); ?>" class="form-control" placeholder="<?php echo htmlspecialchars($placeholder); ?>" value="<?php echo htmlspecialchars($value); ?>" <?php echo $required ? 'required' : ''; ?>>
    </div>
    <?php
}

// Function to render a row of input fields
function renderInputFieldRow($fields) {
    ?>
    <div class="form-group row gap-4">
        <?php
        foreach ($fields as $field) {
            renderColInputField($field['id'], $field['type'], $field['label'], $field['placeholder'], $field['value'], $field['required']);
        }
        ?>
    </div>
    <?php
}

// Function to render a section with a title and description
function renderSectionDescription($title, $description) {
    ?>
        <div class="col">
            <h3 class="emphasized"><?php echo htmlspecialchars($title); ?></h3>
            <p><?php echo htmlspecialchars($description); ?></p>
        </div>
    <?php
}

function authForm($formType) {
    $isLogin = $formType === 'login';

    $title = $isLogin ? 'Login' : 'Create Account';
    $backgroundUrl = './assets/images/hero-banner-image-1.png'; // Update if needed for different backgrounds
    $submitButtonText = $isLogin ? 'Login' : 'Sign Up';
    $alternateText = $isLogin ? 'Do not have an account?' : 'Already have an account?';
    $alternateLinkText = $isLogin ? 'Sign Up' : 'Login';
    $alternateLinkHref = $isLogin ? 'sign-up.php' : 'login.php';

    // Form structure
    echo '<div class="row form-container">';
    
    if ($isLogin) {
        echo '<div class="col form-image m-0" style="background-image: url(\'' . $backgroundUrl . '\');"></div>';
    } 
    
    // Open form tag with action
    echo '<div class="col">
            <form action="' . ($isLogin ? 'login.php' : 'sign-up.php') . '" method="POST">
                <h2 class="emphasized">' . $title . '</h2>';

    if (!$isLogin) {
        // Sign-up specific fields
        echo renderInputFieldRow([
            ['id' => 'first_name', 'type' => 'text', 'label' => 'First Name', 'placeholder' => 'Enter first name', 'value' => '', 'required' => true],
            ['id' => 'last_name', 'type' => 'text', 'label' => 'Last Name', 'placeholder' => 'Enter last name', 'value' => '', 'required' => true],
        ]);
    }

    // Shared fields
    echo renderInputFieldRow([
        ['id' => 'email', 'type' => 'email', 'label' => 'Email address', 'placeholder' => 'Enter email', 'value' => '', 'required' => true],
    ]);

    echo renderInputFieldRow([
        ['id' => 'password', 'type' => 'password', 'label' => 'Password', 'placeholder' => 'Enter your password', 'value' => '', 'required' => true],
    ]);

    if (!$isLogin) {
        // Sign-up specific fields
        echo renderInputFieldRow([
            ['id' => 'confirm_password', 'type' => 'password', 'label' => 'Confirm Password', 'placeholder' => 'Confirm your new password', 'value' => '', 'required' => true],
        ]);
    }

    echo '<div class="form-group row">
            <button type="submit" class="btn btn-primary full mt-2"><h3 class="m-0">' . $submitButtonText . '</h3></button>
        </div>
        <div class="form-group row mt-3">
            <p class="mr-1">' . $alternateText . '</p> 
            <p class="emphasized"><a href="' . $alternateLinkHref . '">' . $alternateLinkText . '</a></p>
        </div>
    </form>
    </div>';

    if (!$isLogin) {
        echo '<div class="col form-image m-0" style="background-image: url(\'' . $backgroundUrl . '\');"></div>';
    }
    
    echo '</div>'; // End of form-container
}




// Function to generate the profile update form
function profileForm($userDetails) {
    ?>
    <div class="row form-container">
        <div class="row px-4 pt-4">
            <h2 class="emphasized mb-0">Profile Details</h2>
        </div>
        <form action="profile.php" method="POST">
            <input type="hidden" name="form_type" value="update_account">
            <div class="row gap-4">
                <?php 
                    renderSectionDescription('Personal Information', 'Here you can update your personal information such as your contact number and email address.');
                ?>
                <div class="col">
                    <?php   
                        renderInputFieldRow([
                            ['id' => 'first_name', 'type' => 'text', 'label' => 'First Name', 'placeholder' => 'Enter first name', 'value' => $userDetails['first_name']],
                            ['id' => 'last_name', 'type' => 'text', 'label' => 'Last Name', 'placeholder' => 'Enter last name', 'value' => $userDetails['last_name']],
                        ]);
                        renderInputFieldRow([
                            ['id' => 'email', 'type' => 'email', 'label' => 'Email address', 'placeholder' => 'Enter email', 'value' => $userDetails['email']],
                        ]);
                        renderInputFieldRow([
                            ['id' => 'contact_number', 'type' => 'tel', 'label' => 'Contact Number', 'placeholder' => 'Enter contact number', 'value' => $userDetails['contact_number']],
                        ]);
                    ?>
                </div>
            </div>
            <div class="row gap-4">
                <?php 
                   renderSectionDescription('Address', 'Here you can update your personal information such as your shipping address.');
                ?>
                <div class="col">
                    <?php   
                        renderInputFieldRow([
                            ['id' => 'address_first_line', 'type' => 'text', 'label' => 'Address', 'placeholder' => 'Enter address line 1', 'value' => $userDetails['address_line1']],
                        ]);
                        renderInputFieldRow([
                            ['id' => 'address_second_line', 'type' => 'text', 'label' => '', 'placeholder' => 'Enter address line 2', 'value' => $userDetails['address_line2']],
                        ]);
                        renderInputFieldRow([
                            ['id' => 'country', 'type' => 'text', 'label' => 'Country', 'placeholder' => 'Enter country', 'value' => $userDetails['country']],
                            ['id' => 'postal_code', 'type' => 'number', 'label' => 'Postal Code', 'placeholder' => 'Enter postal code', 'value' => $userDetails['postal_code']],
                        ]);
                    ?>
                    <div class="form-group row">
                        <button type="submit" class="btn btn-primary full mt-2"><h3 class="m-0">Update Account Details</h3></button>
                    </div>
                </div>
            </div>
        </form>

        <form>
            <div class="row gap-4">
                <div class="col">
                    <h3 class="emphasized">Password</h3>
                    <p>Here you can change your password.</p>
                </div>
                <div class="col">
                    <?php
                    renderInputFieldRow([
                        ['id' => 'password', 'type' => 'password', 'label' => 'Current Password', 'placeholder' => 'Enter your current password'],
                    ]);
                    renderInputFieldRow([
                        ['id' => 'new_password', 'type' => 'password', 'label' => 'New Password', 'placeholder' => 'Enter your new password'],
                    ]);
                    renderInputFieldRow([
                        ['id' => 'confirm_password', 'type' => 'password', 'label' => 'Confirm Password', 'placeholder' => 'Confirm your new password'],
                    ]);
                    ?>
                    <div class="form-group row">
                        <button type="submit" class="btn btn-primary full mt-2"><h3 class="m-0">Change Password</h3></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php
}
?>




