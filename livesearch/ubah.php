<?php
session_start() ;

if ( !isset($_SESSION["login"]) ) {
    header("Location: login.php") ;
}

require "function.php" ;

$id =$_GET["id"] ;

$mhs = query("SELECT * FROM mahasiswa WHERE id= $id")[0];
    if( isset($_POST["submit"])) {

        if ( ubah($_POST) > 0 ) {
            echo "<script>
                alert('data berhasil di ubah!') ;
                document.location.href='index.php' ;
            </script>" ;
        }
        else {
            echo "<script>
                alert('data gagal di ubah!') ;
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
    <h1>Ubah data Mahasiswa</h1>

    <form action="" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?=$mhs['id']?>">
    <input type="hidden" name="gambarLama" value="<?=$mhs['gambar']?>">
        <ul><li>
            <label> NRP : </label>
            <input type="text" name="nrp" id="nrp" required value="<?=$mhs['nrp']?>">
            </li>
            <li>
            <label> Nama : </label>
            <input type="text" name="nama" id="nama" required value="<?=$mhs['nama']?>">
            </li>
            <li>
            <label> Email : </label>
            <input type="text" name="email" id="email" required value="<?=$mhs['email']?>">
            </li>
            <li>
            <label> Jurusan : </label>
            <input type="text" name="jurusan" id="jurusan" required value="<?=$mhs['jurusan']?>">
            </li>
            <li>
            <label> Gambar : </label>
            <img src="gambar/<?=$mhs["gambar"] ?>" width="60"><br>
            <input type="file" name="gambar" id="gambar" ><br><br>
            </li>
            <li>
            <button type="submit" name="submit">Ubah data !</button>
            </li>
        </ul>

    </form>


</body>
</html> 