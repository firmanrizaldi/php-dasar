<?php
session_start() ;

if ( !isset($_SESSION["login"]) ) {
    header("Location: login.php") ;
}
require "function.php" ;
    if( isset($_POST["submit"])) {
        
        if ( tambah($_POST) > 0 ) {
            echo "<script>
                alert('data berhasil di tambahkan!') ;
                document.location.href='index.php' ;
            </script>" ;
        }
        else {
            echo "<script>
                alert('data gagal di tambahkan!') ;
                document.location.href='index.php' ;
            </script>" ;
        }

    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tambah data</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
    <h1>Tambah data Mahasiswa</h1>

    <form action="" method="POST" enctype="multipart/form-data">
        <ul>
            <li>
            <label> NRP : </label>
            <input type="text" name="nrp" id="nrp" required>
            </li>
            <li>
            <label> Nama : </label>
            <input type="text" name="nama" id="nama" required>
            </li>
            <li>
            <label> Email : </label>
            <input type="text" name="email" id="email" required>
            </li>
            <li>
            <label> Jurusan : </label>
            <input type="text" name="jurusan" id="jurusan" required>
            </li>
            <li>
            <label> Gambar : </label>
            <input type="file" name="gambar" id="gambar" >
            </li>
            <li>
            <button type="submit" name="submit">Tambah data !</button>
            </li>
        </ul>

    </form>


</body>
</html> 