<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link rel="stylesheet" href="<?= base_url('/style.css'); ?>">
</head>
<body>
    <div id="container">
        <header>
            <h1>Admin Portal Berita</h1>
            <a class="btn" id="logout" href="<?= base_url('/user/logout');?>">Logout</a>
        </header>
        <nav class="navMenu">
            <a href="<?= base_url('/admin/artikel'); ?>" class="<?php echo($_SERVER['REQUEST_URI']=="/admin/artikel") ? "active" : ""; ?>">Dashboard</a>
            <a href="<?= base_url('/artikel'); ?>" class="<?php echo($_SERVER['REQUEST_URI']=="/artikel") ? "active" : ""; ?>">Artikel</a>
            <a href="<?= base_url('/admin/artikel/add'); ?>" class="<?php echo($_SERVER['REQUEST_URI']=="/admin/artikel/add") ? "active" : ""; ?>">Tambah Artikel</a>
        </nav>
        <br>

        