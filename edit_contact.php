<?php
include('components/contacts_handler.php');

$first_name = $last_name = $email = $phone = $notes = '';
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate input
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $notes = $_POST["notes"];
    $id = $_POST["id"];

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

    // If there are no validation errors, update the contact data in the array
    if (empty($errors)) {
        $contactFound = false;
        foreach ($contacts as &$contact) {
            if ($contact['id'] == $id) {
                $contactFound = true;
                $contact['first_name'] = $first_name;
                $contact['last_name'] = $last_name;
                $contact['email'] = $email;
                $contact['phone'] = $phone;
                $contact['notes'] = $notes;
                break;
            }
        }

        if ($contactFound) {
            // Save the updated contact data to the JSON file
            saveContacts($contacts);

            // Redirect to the contact list page
            header("Location: index.php");
        } else {
            echo "Contact not found.";
            // You may want to add a redirect or link back to index.php here
        }
    }
} elseif (isset($_GET["id"])) {
    $id = $_GET["id"];
    $contactFound = false;

    foreach ($contacts as $contact) {
        if ($contact['id'] == $id) {
            $contactFound = true;
            $first_name = $contact['first_name'];
            $last_name = $contact['last_name'];
            $email = $contact['email'];
            $phone = $contact['phone'];
            $notes = $contact['notes'];
            break;
        }
    }

    if (!$contactFound) {
        echo "Contact not found.";
        // You may want to add a redirect or link back to index.php here
    }
}

include('components/header.php');
?>

<div class="container">
    <h2>Edit Contact</h2>
    <form method="POST" action="edit_contact.php">
        <input type="hidden" name="id" value="<?php echo $id; ?>">

        <label for="first_name">First Name:</label>
        <input type="text" name="first_name" id="first_name" value="<?php echo $first_name; ?>" required>

        <label for="last_name">Last Name:</label>
        <input type="text" name="last_name" id="last_name" value="<?php echo $last_name; ?>" required>

        <label for="email">Email Address:</label>
        <input type="email" name="email" id="email" value="<?php echo $email; ?>" required>

        <label for="phone">Phone Number:</label>
        <input type="tel" name="phone" id="phone" value="<?php echo $phone; ?>" required>

        <label for="notes">Notes/Comments:</label>
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
