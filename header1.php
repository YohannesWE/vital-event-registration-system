<?php 
include_once('languge.php');
?>

<style>
.header {
    background-color: rgb(0, 110, 185);
    padding: 20px;
    display: flex;
    align-items: center;
    justify-content: flex-start;
    color: white;
}

.header img {
    width: 100px;
    height: 90px;
    margin-right: 20px;
}

.header h4 {
    margin: 0;
    font-weight: bold;
    color: white;
    font-size: 24px;
}

.header a {
    color: white;
    text-decoration: none;
    padding: 10px;
}

.header a:hover {
    background-color: rgb(73, 139, 184);
}
</style>

<header class="header">
    <img src="/ksw02/logo.png" alt="Logo of the company" title="Logo of the company" />
    <h5><?= __('head') ?></h5>
</header>
