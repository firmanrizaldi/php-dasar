<?php
session_start() ;

if ( !isset($_SESSION["login"]) ) {
    header("Location: login.php") ;
}
require "function.php" ;

    //pagination
        //konfigurasi pagination
        $jumlahdataperhalaman= 2 ;
        
        $jumlahdata = count(query("SELECT * FROM mahasiswa")) ;
        
        $jumlahhalaman = ceil($jumlahdata / $jumlahdataperhalaman) ;
        //if else ternary
        $halamanaktif = ( isset($_GET["halaman"] )) ? $_GET["halaman"] : 1 ;
        $awaldata = ($jumlahdataperhalaman*$halamanaktif) - $jumlahdataperhalaman ;
        
    

$mahasiswa = query("SELECT * FROM mahasiswa LIMIT $awaldata,$jumlahdataperhalaman ") ;

    if( isset($_POST["cari"])) {
        $mahasiswa = query("SELECT * FROM mahasiswa LIMIT $awaldata,$jumlahdataperhalaman ") ;
        $mahasiswa = cari($_POST["keyword"]);
        
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Halaman Admin</title>
    <meta name="viewport" content="widtd=device-widtd, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>

<a href="logout.php">logout</a>

<h1>Daftar Mahasiswa</h1>

<a href="tambah.php">Tambah data mahasiswa</a><br><br>

<form action="" method="POST">

    <input type="text" name="keyword" size="48" autofocus 
    placeholder="Masukan keyword pencarian . . . " autocomplete="off">
    <button type="submit" name="cari">cari!</button><br><br>

</form>

<!-- navigasi -->
<?php if($halamanaktif > 1): ?>
<a href="?halaman=<?= $halamanaktif - 1 ; ?> ">&laquo</a>
<?php endif; ?>

<?php for($i= 1 ; $i <= $jumlahhalaman ; $i++) : ?>
<?php if( $i == $halamanaktif) :?>
    <a href="?halaman=<?= $i ?>" style="font-weight: bold ; color: red ;"><?= $i ?></a>
    <?php else :?>
    <a href="?halaman=<?= $i ?>"><?= $i ?></a>
    <?php endif?>
<?php endfor; ?>

<?php if($halamanaktif < $jumlahhalaman): ?>
<a href="?halaman=<?= $halamanaktif + 1; ?> ">&raquo</a>
<?php endif; ?>

    <table border="1" cellpadding="10" cellspacing="0">
           <th>No</th>
            <th>Aksi</th>
            <th>Gambar</th>
            <th>NRP</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Jurusan</th>
        </tr>
        <?php $i = 1 ?>
        <?php foreach ($mahasiswa as $row ) : ?>
        <tr>
            <td><?= $i + $awaldata?></td>
            <td><a href="ubah.php?id=<?=$row["id"] ?>">ubah</a> |
                <a href="delete.php?id=<?=$row["id"] ?>">delete</a>
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
    
</body>
</html>