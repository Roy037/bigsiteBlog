<?php
require 'config/database.php';
// truy van vao submit
if (isset($_POST['submit'])) {
    // get form data
    $username_email = filter_var($_POST['username_email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    // cac truong hop nhap thieu,thi in ra thong bao
    if (!$username_email) {
        $_SESSION['signin'] = "Username or Email required";
    } elseif (!$password) { // neu dung thi $password---------------⇣
        $_SESSION['signin'] = "Password Required";
    } else {
        // fetch user from database
        //tim ve data da luu trong signin
        $fetch_user_query = "SELECT * FROM users WHERE username='$username_email' OR email='$username_email'"; 
        $fetch_user_result = mysqli_query($connection, $fetch_user_query);                                     //tim ve ket qua cua data

        if (mysqli_num_rows($fetch_user_result) == 1) {
        
            //$fetch_user_result là kết quả của truy vấn, là kết quả trả về của các hàm: mysqli_query(),
            $user_record = mysqli_fetch_assoc($fetch_user_result); 
            //check pass trong mysqli_query
            $db_password = $user_record['password'];               
            // bat dau SO SANH password voi passworf da dang ki
            if (password_verify($password, $db_password)) { //⇠----|
                $_SESSION['user-id'] = $user_record['id'];
                // neu user la admin
                if ($user_record['is_admin'] == 1) {
                    $_SESSION['user_is_admin'] = true;
                }
                // cho phep admin dang nhap voi tu cach admin/
                header('location: ' . ROOT_URL . 'admin/');
            } else {
                $_SESSION['signin'] = "Please check your input";
            }
        } else {
            $_SESSION['signin'] = "User not found";
        }
    }

    // neu xay ra loi,chuyen duong ve dang dang nhap ban dau
    if (isset($_SESSION['signin'])) {
        $_SESSION['signin-data'] = $_POST;
        header('location: ' . ROOT_URL . 'signin.php');
        die();
    }
} else { //neu la normal user thi duoi .php
    header('location: ' . ROOT_URL . 'signin.php');
    die();
}
