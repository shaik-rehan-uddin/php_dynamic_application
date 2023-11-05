<?php
include('components/contacts_handler.php');
include('components/header.php');
?>

<div class="container">
    <h2>View Contacts</h2>
    <?php
    if (!empty($contacts)) {
        echo '<table>';
        echo '<tr>';
        echo '<th>First Name</th>';
        echo '<th>Last Name</th>';
        echo '<th>Email</th>';
        echo '<th>Phone</th>';
        echo '<th>Notes</th>';
        echo '<th></th>';
        echo '<th></th>';
        echo '</tr>';

        foreach ($contacts as $contact) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($contact['first_name']) . '</td>';
            echo '<td>' . htmlspecialchars($contact['last_name']) . '</td>';
            echo '<td>' . htmlspecialchars($contact['email']) . '</td>';
            echo '<td>' . htmlspecialchars($contact['phone']) . '</td>';
            echo '<td>' . htmlspecialchars($contact['notes']) . '</td>';
            echo '<td><button class="edit-button" onclick="location.href=\'edit_contact.php?id=' . $contact['id'] . '\'">Edit</button></td>';
            echo '<td><button class="delete-button" onclick="deleteContact(' . $contact['id'] . ', \'' . htmlspecialchars($contact['first_name']) . ' ' . htmlspecialchars($contact['last_name']) . '\')">Delete</button></td>';
            echo '</tr>';
        }

        echo '</table>';
    } else {
        echo 'No contacts found.';
        echo '<button class="get-started" onclick="redirectToAddContact()" style="margin-top:10px">Add New Contact</button>';
    }
    ?>
</div>

<script>
function deleteContact(contactId,contactName) {
    if (confirm("Are you sure you want to delete the contact: " + contactName)) {
        window.location.href = 'delete_contact.php?id=' + contactId;
    }
}
function redirectToAddContact() {
          window.location.href = 'add_contact.php';
      }
    </script>
</script>

<?php include('components/footer.php'); ?>
