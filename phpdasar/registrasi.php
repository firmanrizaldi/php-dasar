<?php
require 'function.php' ;

if( isset($_POST["register"])) {

    if ( registrasi($_POST) > 0) {
        echo "<script>
        alert('user baru berhasil di tambahkan!') ;
        document.location.href='login.php' ;
        </script>" ;
    } else {
        echo mysqli_error($con) ; 
    
    }
}


?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Halaman Registrasi</title>
    <style>
       label { display :block ;}
    </style>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
    <h1>Halaman Registrasi</h1>

    <form action="" method="POST">

        <ul>
        <li>
            <label for="username">username : </label>
            <input type="text" name="username" id="username">
        </li>
        <li>
            <label for="password">password : </label>
            <input type="password" name="password" id="password">
        </li>
        <li>
            <label for="password2">konfirmasi password : </label>
            <input type="password" name="password2" id="password2">
        </li>
        <li>
            <button type="submit" name="register">register!</button>
        </li>
    
        </ul>
    
    </form>

    
</body>
</html>