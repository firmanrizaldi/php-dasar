<?php
session_start() ;

if ( !isset($_SESSION["login"]) ) {
    header("Location: login.php") ;
}
require "function.php" ;


$mahasiswa = query("SELECT * FROM mahasiswa") ;

    if( isset($_POST["cari"])) {
        
        $mahasiswa = cari($_POST["keyword"]);
        
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Halaman Admin</title>
    <style>
        .loader {
            width:80px ;
            position:absolute ;
            top: 125px;
            left:320px;
            z-index: -1 ;
            display:none ;
        }
    </style>
    
    
</head>
<body>

<a href="logout.php">logout</a> | <a href="cetak.php" target="_blank">cetak</a>

<h1>Daftar Mahasiswa</h1>

<a href="tambah.php">Tambah data mahasiswa</a><br><br>

<form action="" method="POST">

    <input type="text" name="keyword" size="48" autofocus 
    placeholder="Masukan keyword pencarian . . . " autocomplete="off" id="keyword">
    <button type="submit" name="cari" id="tombolcari">cari!</button><br><br>

    <img src="gambar/loader.gif" class="loader">

</form>


<div id="container">
    <table border="1" cellpadding="10" cellspacing="0">

            <th>No</th>
            <th>Aksi</th>
            <th>Gambar</th>
            <th>NRP</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Jurusan</th>
        </tr>
        <?php $i = 1 ;?>
        <?php foreach ($mahasiswa as $row ) : ?>
        <tr>
            <td><?= $i ;?></td>
            <td><a href="ubah.php?id=<?=$row["id"] ;?>">ubah</a> |
                <a href="delete.php?id=<?=$row["id"] ;?>">delete</a>
            </td>
            <td><img src="gambar/<?=$row["gambar"] ?>" width="60"></td>
            <td><?=$row["nrp"] ; ?></td>
            <td><?=$row["nama"] ; ?></td>
            <td><?=$row["email"] ; ?></td>
            <td><?=$row["jurusan"] ; ?></td>
        </tr>
    
        <?php $i++ ?>
        <?php endforeach ; ?>
    
    </table>
    </div>


<script src="js/jquery-3.4.1.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>