<?php
include('components/contacts_handler.php');
include('components/header.php');

// Initialize variables to store form data and error messages
$first_name = $last_name = $email = $phone = $notes = '';
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate input
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $notes = $_POST["notes"];

    // Perform basic validation
    if (empty($first_name)) {
        $errors[] = "First Name is required.";
    }
    if (empty($last_name)) {
        $errors[] = "Last Name is required.";
    }
    if (empty($email)) {
        $errors[] = "Email is required.";
    }
    if (empty($phone)) {
        $errors[] = "Phone Number is required.";
    }

    // If there are no validation errors, add the data to the contacts array and save to JSON file
    if (empty($errors)) {
        $newContact = [
            'id' => count($contacts) + 1, // Assign a new ID
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'phone' => $phone,
            'notes' => $notes,
        ];

        // Add the new contact to the array
        $contacts[] = $newContact;

        // Save the updated contact data to the JSON file
        saveContacts($contacts);

        // Redirect to the contact list page
        header("Location: index.php");
    }
}
?>

<div class="container">
    <h2>Add Contact</h2>
    <form method="POST" action="add_contact.php" autocomplete="on">
        <label for="first_name">First Name</label>
        <input type="text" name="first_name" id="first_name" placeholder="Eg: John" value="<?php echo $first_name; ?>" required>

        <label for="last_name">Last Name</label>
        <input type="text" name="last_name" id="last_name" placeholder="Eg: Roger" value="<?php echo $last_name; ?>" required>

        <label for "email">Email Address</label>
        <input type="email" name="email" id="email" placeholder="Eg: example@mail.com" value="<?php echo $email; ?>" required>

        <label for="phone">Phone Number</label>
        <input type="tel" name="phone" id="phone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="Eg: 123-456-7890" value="<?php echo $phone; ?>" required>

        <label for="notes">Notes/Comments</label>
        <textarea name="notes" id="notes"><?php echo $notes; ?></textarea>

        <button type="submit">Save</button>
        <button type="button" onclick="window.location.href='index.php'">Cancel</button>

        <?php
        if (!empty($errors)) {
            echo '<div class="error-msg">';
            foreach ($errors as $error) {
                echo '<p>' . $error . '</p>';
            }
            echo '</div>';
        }
        ?>
    </form>
</div>

<?php include('components/footer.php'); ?>