<?php
$contacts_file = 'components/contacts.json';

// Read contact data from JSON file
if (file_exists($contacts_file)) {
    $contacts_data = json_decode(file_get_contents($contacts_file), true);
    $contacts = $contacts_data['contacts'];
} else {
    $contacts = [];
}

// Function to save the contact data to the JSON file
function saveContacts($contacts) {
    global $contacts_file;
    $contacts_data = ['contacts' => $contacts];
    file_put_contents($contacts_file, json_encode($contacts_data, JSON_PRETTY_PRINT));
}
?>
