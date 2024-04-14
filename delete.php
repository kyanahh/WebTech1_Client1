<?php
    include ('connection.php');


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve the ID of the row to delete
        $studid = $_POST['studid'];

        // Perform the deletion and handle any necessary error checking
        // Replace the following code with your actual deletion logi

        $sql = "DELETE FROM tbl_contacts WHERE studid = $studid";
        if (mysqli_query($conn, $sql)) {
            // Deletion successful, redirect to index.php
            mysqli_close($conn);
            header("Location: ContactList.php");
            exit;
        } else {
            // Error occurred during deletion
            mysqli_close($conn);
            echo "Error deleting record: " . mysqli_error($conn);
        }
    }

?>
