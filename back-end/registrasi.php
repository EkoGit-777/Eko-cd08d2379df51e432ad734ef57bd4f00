<?php
$conn = mysqli_connect("localhost","root","","test") or die(mysqli_error());
$username = $_POST['username'];
$password = $_POST['password'];
$password2 = $_POST['password2'];

if($password != $password2)
    header("Location: ../front-end/registrasi.html");

$query = $conn->query("select * from data_user where status=1");
$cek = $query->num_rows;
if ($query->num_rows == 1)
{
    foreach($query as $key => $val){
        $id=$val['id'];
    }
    $sql = "UPDATE data_user SET status=0 WHERE id=" . $id;
    if(mysqli_query($conn, $sql)) {
        $sql = "INSERT INTO data_user(username,password,status,waktu) VALUES (" . $username . "," . $password . ",1,CURRENT_TIMESTAMP)";
        if(mysqli_query($conn, $sql)) {
            session_start();
            $_SESSION['username'] = $username;
            header("Location: ../front-end/index.html");
        }else{
            header("Location: ../front-end/registrasi.html");
        }
    }else{
        header("Location: ../front-end/registrasi.html");
    }
}else{
    $sql = "INSERT INTO data_user(username,password,status,waktu) VALUES ('" . $username . "','" . $password . "',1,CURRENT_TIMESTAMP)";
    if(mysqli_query($conn, $sql)) {
        session_start();
        $_SESSION['username'] = $username;
        header("Location: ../front-end/index.html");
    }else{
        header("Location: ../front-end/registrasi.html");
    }
}

$conn->close();
?>