
<?php 
include "../koneksi.php";
function getData($sql){
    global $koneksi;

    $result = mysqli_query($koneksi, $sql);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}
?>