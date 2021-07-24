<?php
    session_start(); 
    if(isset($_SESSION['unique_id'])){ // if user is logged in, then go or else directly go to login page
        include_once "config.php";
        $logout_id = mysqli_real_escape_string($conn, $_GET['logout_id']);
        if(isset($logout_id)){
            $status = "Offline now";
            $sql = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE unique_id={$_GET['logout_id']}");   // setting status to offline since he is logging out 
            if($sql){
                session_unset();
                session_destroy();  // destroying all session variables since is user is logging out
                header("location: ../login.php");   
            }
        }else{
            header("location: ../users.php");
        }
    }else{  
        header("location: ../login.php");   // in file paths, / is the root of the current drive; ./ is the current directory;  ../ is the parent of the current directory.
    }
?>