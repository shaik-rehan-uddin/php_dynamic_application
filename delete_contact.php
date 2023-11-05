<?php
include('components/contacts_handler.php');
include('components/header.php');

if (isset($_GET['id'])) {
    $contactId = $_GET['id'];
    $contactFound = false;

    foreach ($contacts as $key => $contact) {
        if ($contact['id'] == $contactId) {
            $contactFound = true;
            // Delete the contact from the array
            unset($contacts[$key]);

            // Reindex the array
            $contacts = array_values($contacts);

            // Save the updated contact data to the JSON file
            saveContacts($contacts);

            // Redirect to the contact list page
            header("Location: index.php");
            exit;
        }
    }

    if (!$contactFound) {
        echo "Contact not found.";
        // You may want to add a redirect or link back to index.php here
    }
} else {
    echo "Contact ID not provided.";
}

include('components/footer.php');
?>
