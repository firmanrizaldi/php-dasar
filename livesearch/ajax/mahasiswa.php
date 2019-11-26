<?php

require '../function.php' ;

$keyword = $_GET["keyword"] ;

$query = "SELECT * FROM mahasiswa
            WHERE
            nama LIKE '%$keyword%' OR
            nrp LIKE '%$keyword%' OR
            email LIKE '%$keyword%' OR
            jurusan LIKE '%$keyword%'
            ";

$mahasiswa = query($query) ;
?>

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
 <td><?= $i ?></td>
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
