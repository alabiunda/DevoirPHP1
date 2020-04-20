<?php 
include 'Product.php';
include 'ProductManager.php';
include 'User.php';
include 'UserManager.php';
$product_manager = new ProductManager();
$display = 'list';
$user_manager = new UserManager();
$displayUser ='list';
if(isset($_POST) && isset($_POST['type']) && $_POST['type'] == 'create') {
    $product = $product_manager->save($_POST);
}

if(isset($_POST) && isset($_POST['type']) && $_POST['type'] == 'delete') {
    $product = $product_manager->delete($_POST['pk']);
}

if(isset($_POST) && isset($_POST['type']) && $_POST['type'] == 'edit') {
    $product = $product_manager->update($_POST['name'],$_POST['price'],$_POST['quantity'],$_POST['pk']);
}

if(isset($_GET) && isset($_GET['pk'])) {
    $product = $product_manager->fetch($_GET['pk']);
    $display = 'one';
} else {
    $product_list = $product_manager->fetchAll();
}

if(isset($_POST) && isset($_POST['type']) && $_POST['type'] == 'editUser') {
    $user = $user_manager->update($_POST['username'],$_POST['password'],$_POST['pk']);
}

if(isset($_POST) && isset($_POST['type']) && $_POST['type'] == 'createUser') {
    $user = $user_manager->save($_POST);
}

if(isset($_POST) && isset($_POST['type']) && $_POST['type'] == 'deleteUser') {
    $user = $user_manager->delete($_POST['pkUser']);
}

if(isset($_GET) && isset($_GET['pkUser'])) {
    $user = $user_manager->fetch($_GET['pkUser']);
    $displayUser = 'one';
} else {
    $user_list = $user_manager->fetchAll();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles.css">
    <meta charset="UTF-8">
    <title>Document</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
    <script src="script.js"></script>
</head>
<body>
        <section style="border: solid; padding: 20px">
            <h3 style="text-decoration: underline">Gestion des Produits : </h3>
            <form action="index.php" method="get" id="search-form">
                <label for="pk-search">Rechercher</label>
                <input type="number" name="pk" id="pk-search">
                <input type="submit" value="Rechercher">
            </form>

            <form action="index.php" method="post">
                <input type="hidden" name="type" value="create">
                <input type="text" name="name">
                <input type="number" name="price" step="0.01">
                <input type="number" name="quantity" min="0">
                <input type="submit">
            </form>

            <form action="index.php" method="post">

            </form>
            <section id="ajax-rsp">

            </section>

            <?php if($display == 'one') include 'unique_view.php'; ?>
            <?php if($display == 'list') include 'table_view.php'; ?>
        </section>
        <section style="border: solid; padding: 20px">
            <h3 style="text-decoration: underline">Gestion des Utilisateurs :</h3>
            <form action="index.php" method="get" id="search-form">
                <label for="pk-search">Rechercher</label>
                <input type="number" name="pkUser" id="pk-search">
                <input type="submit" value="Rechercher">
            </form>

            <form action="index.php" method="post">
                <input type="hidden" name="type" value="createUser">
                <input type="text" name="username">
                <input type="text" name="password">
                <input type="submit">
            </form>

            <form action="index.php" method="post">

            </form>
            <section id="ajax-rsp">

            </section>

            <?php if($displayUser == 'one') include 'unique_view_user.php'; ?>
            <?php if($displayUser == 'list') include 'table_view_users.php'; ?>
        </section>
</body>
</html>

