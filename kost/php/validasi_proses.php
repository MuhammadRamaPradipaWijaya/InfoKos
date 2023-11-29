<?php
include "../../koneksi.php";

// Check if 'id_tagihan' is set in the POST data
if (isset($_POST['id_tagihan'])) {
    $id_tagihan = $_POST['id_tagihan'];

    // Update the 'stats' field in the 'tagihan' table
    $query = "UPDATE tagihan SET stats=1 WHERE no_tagihan='$id_tagihan'";
    $data = mysqli_query($koneksi, $query);

    // Check if the update was successful
    if ($data) {
        // Redirect to tagihan.php if successful
        header("location:../tagihan.php");
        exit();
    } else {
        // Handle the case where the update fails
        echo "Error updating tagihan: " . mysqli_error($koneksi);
        // You might want to handle the error more gracefully, e.g., display a user-friendly message
    }
} else {
    // Handle the case where 'id_tagihan' is not set in the POST data
    echo "Invalid request. Please provide 'id_tagihan'.";
    // You might want to redirect or display an error message to the user
}
?>
