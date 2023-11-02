<?php
session_start(); //inisialisasi session
if(session_destroy()) { //menghapus session
    header("Location: home.php");
}
?>
