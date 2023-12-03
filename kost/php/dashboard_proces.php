<?php 
include "../koneksi.php";

function getData($sql){
    global $koneksi;

    $result = mysqli_query($koneksi, $sql);
    if (!$result) {
        die("Query failed: " . mysqli_error($koneksi));
    }

    return $result;  // Mengembalikan objek mysqli_result
}
?>


<?php 
//include "../koneksi.php";
//function getData($sql){
   // global $koneksi;

    //$result = mysqli_query($koneksi, $sql);
    //$rows = [];
    //while ($row = mysqli_fetch_assoc($result)){
        //$rows[] = $row;
    //}
    //return $rows;
//}
?>