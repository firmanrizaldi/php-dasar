<?php
session_start() ;
require "function.php" ;

//cek dulu cookienya

if ( isset($_COOKIE['id']) && isset($_COOKIE['key']) ) {
     $id = $_COOKIE['id'] ;
     $key = $_COOKIE['key'] ;

     // ambil username berdasarkan id
     $result = mysqli_query($con,"SELECT username FROM user WHERE id = $id") ;
     // mengambil hasil baris sebagai array asosiatif
     $row = mysqli_fetch_assoc($result) ;


    // cek cookie dan username
    if ( $key === hash('sha256', $row['username'])) {
        $_SESSION['login'] = true ;
    }

}

if ( isset($_SESSION["login"]) ) {
    header("Location: index.php") ;
    exit ; 
}



if ( isset($_POST['login'])) {

    $username =$_POST['username'] ;
    $password =$_POST['password'] ;

    $result = mysqli_query($con,"SELECT * FROM user WHERE username ='$username'") ;

    // cek username 
    if (mysqli_num_rows($result) === 1) {

        //cek password
        $row = mysqli_fetch_assoc($result) ;
 
        if( password_verify($password, $row["password"]) ) {
            //set session
            $_SESSION["login"] = true ;

            // cek remember me
            if ( isset($_POST['remember']) ) {
                //buat cookie
                setcookie('id',$row['id'],time () + 60) ;
                setcookie('key',hash('sha256', $row['username'] ),time () + 60) ;
            }

            header("Location: index.php") ;
            exit ;
        }


    }

    $error = true ;

}


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Halaman Login</title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>

<h1> Halaman Login</h1>

<?php if ( isset($error)) : ?> 
    <p style ="color:red ;font-style:italic;">username / password salah</p>
<?php endif ; ?>

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
       <input type="checkbox" name="remember" id="remember"> 
       <label for="remember">remember me</label>
        
    <li>
        <button type="submit" name="login">Login!</button>
    </li>
    </ul>

</form>
    









</body>
</html>