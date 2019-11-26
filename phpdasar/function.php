<?php
    $con = mysqli_connect("localhost", "root", "", "db_phpdasar") ;

    function query($query) {

        global $con ;
        $result = mysqli_query($con,$query) ;
        $rows =[] ;
        while ( $row = mysqli_fetch_assoc($result)) {
            $rows[] = $row ;
        }
        return $rows;
    }

    function tambah($data) {
        global $con ;
        $nrp =htmlspecialchars($data["nrp"]);
        $nama =htmlspecialchars($data["nama"]);
        $email =htmlspecialchars($data["email"]);
        $jurusan =htmlspecialchars($data["jurusan"]);
        
        // upload gambar
        $gambar = upload(); 
            if(!$gambar) {
                return false ;
            }

        $query = "INSERT INTO mahasiswa
                VALUES
                ('','$nama','$nrp','$email','$jurusan','$gambar') " ;

        mysqli_query($con,$query) ;

        return mysqli_affected_rows($con) ;
    }

    function upload() {

        $namafile   = $_FILES['gambar']['name'] ;
        $ukuranfile = $_FILES['gambar']['size'] ;
        $error      = $_FILES['gambar']['error'] ;
        $tmpName    = $_FILES['gambar']['tmp_name'] ;

        // cek apakah tidak ada gambar yg di upload

            if ($error === 4){
                echo"<script>
                    alert('pilih gambar terlebih dahulu') ;
                </script>" ;

                return false ;
            }

        // cek yang di upload gambar atau bukan

        $extensiGambarValid = ['jpg', 'jpeg' ,'png'] ;
        $extensiGambar = explode('.',$namafile) ;
        $extensiGambar = strtolower(end($extensiGambar));

            if( !in_array($extensiGambar,$extensiGambarValid) ) {  
            echo"<script>
                alert('yang anda upload bukan gambar') ;
                </script>" ;
            return false ;
            }

        // cek jika ukuran terlalu besar

            if ( $ukuranfile > 1000000) {
                echo"<script>
                alert('ukuran gambar terlalu besar') ;
                </script>" ;
                return false ;
                }

        // lolos pengecekan
        //generate nama baru
                $namaFileBaru= uniqid() ;
                $namaFileBaru.= '.' ;
                $namaFileBaru.= $extensiGambar ;

    


        move_uploaded_file($tmpName,'./gambar/'.$namaFileBaru) ;
        
        return $namaFileBaru ;


    }


    function hapus($id) {
        global $con ;
        mysqli_query($con,"DELETE FROM mahasiswa where id = $id") ;

        return mysqli_affected_rows($con) ;
    }

    function ubah($data) {
        global $con ;
            $id = $data["id"] ;
            $nrp =htmlspecialchars($data["nrp"]);
            $nama =htmlspecialchars($data["nama"]);
            $email =htmlspecialchars($data["email"]);
            $jurusan =htmlspecialchars($data["jurusan"]);
            $gambarLama =htmlspecialchars($data["gambarLamaa"]);

            // cek apakah user pilih gambar baru atau tidak
            if ( $_FILES['gambar']['error'] === 4) {
                    $gambar = $gambarLama ; }
            else {
                $gambar = upload() ;
            }

      

        $query = "UPDATE mahasiswa SET
                    nrp = '$nrp',
                    nama = '$nama',
                    email = '$email',
                    jurusan = '$jurusan',
                    gambar = '$gambar'
                WHERE id =$id
                    " ;

        mysqli_query($con,$query) ;

        return mysqli_affected_rows($con) ;


    }

        function cari($keyword){
            $query ="SELECT * FROM mahasiswa
                        WHERE
                        nama LIKE '%$keyword%' OR
                        nrp LIKE '%$keyword%' OR
                        email LIKE '%$keyword%' OR
                        jurusan LIKE '%$keyword%'
                    " ;
            return query($query) ;

        }

        function registrasi($data) {
            global $con ;
            
            $username =strtolower(stripslashes($data["username"]));
            $password =mysqli_real_escape_string($con,$data["password"]);
            $password2 =mysqli_real_escape_string($con,$data["password2"]);

            //username sudah ada atau belum 
            $result= mysqli_query($con,"SELECT username FROM user 
            WHERE username = '$username' ") ;
                
                if ( mysqli_fetch_assoc($result)) {
                    echo "<script>
                            alert('username sudah terdaftar!') ;
                          </script>" ;

                    return false ;

                }
            
            // cek konfirmasi password

            if ( $password !== $password2) {
                echo "<script>
                alert('password tidak sesuai!') ;
                </script>" ;
                return false ;
            }

            // enkripsi password
            $password = password_hash($password, PASSWORD_DEFAULT) ;
        
            
            // tambahkan userbaru ke database
            mysqli_query($con,"INSERT INTO user VALUES('','$username','$password')") ;

            return mysqli_affected_rows($con) ;





        }





?>