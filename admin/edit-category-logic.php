<?php
require 'config/database.php';

if (isset($_POST['submit'])) {
    //truy xuat care trong data base
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $description = filter_var($_POST['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    // validate input
    //check tieu de va mo ta
    if (!$title || !$description) {
        //hien thi thong bao bieu mau khong hop le
        $_SESSION['edit-category'] = "Invalid form input on edit category page";
    } else {
        //cau len UPDATE VA SET ,tìm đúng title va description WHERE ID đó
        $query = "UPDATE categories SET title='$title', description='$description' WHERE id=$id LIMIT 1";
        //concec lại bảng
        $result = mysqli_query($connection, $query);

        if (mysqli_errno($connection)) {
            $_SESSION['edit-category'] = "Couldn't update category";
        } else {
            $_SESSION['edit-category-success'] = "Category $title updated successfully";
        }
    }
}

header('location: ' . ROOT_URL . 'admin/manage-categories.php');
die();
