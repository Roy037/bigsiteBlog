<?php
require 'config/database.php';

if (isset($_POST['submit'])) {
    //truy xuat nut submit
    // get form data
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $description = filter_var($_POST['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    // gợi ý gợi ý cho người dùng
    if (!$title) {
        $_SESSION['add-category'] = "Enter title";
    } elseif (!$description) {
        $_SESSION['add-category'] = "Enter description";
    }

    // false chuyển hướng lại trang thêm danh mục nếu dầu vào không hợp lệ
    if (isset($_SESSION['add-category'])) {
        $_SESSION['add-category-data'] = $_POST;
        header('location: ' . ROOT_URL . 'admin/add-category.php');
        die();
    } else {
        // true thêm vào data,insert vào categories title va description
        $query = "INSERT INTO categories (title, description) VALUES ('$title', '$description')";
        $result = mysqli_query($connection, $query);
        //mysqli_errno truy xuat lai vao database neu loi thi trở lại thêm danh mục và hiển thị thông báo
        if (mysqli_errno($connection)) {
            $_SESSION['add-category'] = "Couldn't add category";
            header('location: ' . ROOT_URL . 'admin/add-category.php');
            die();
        } else {
            $_SESSION['add-category-success'] = "$title category added successfully";
            header('location: ' . ROOT_URL . 'admin/manage-categories.php');
            die();
        }
    }
}
