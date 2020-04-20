<?php
    $results = array();
    $has_search = false;
    $err = false;
    if(isset($_GET['search'])) {
        $has_search = true; 
        $db_con = new PDO('mysql:host=localhost;dbname=demo', 'root', '');
        $db_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $statement = $db_con->prepare("SELECT * FROM products WHERE name LIKE '%' ? '%';");
        try {
            $statement->execute([$_GET['search']]);
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            $err = true;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Super Safe Shop 2.0</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/style.css">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="assets/script.js"></script>
</head>
<body>
    <header>
        <h1>Super Safe Shop 2.0</h1>
        <section class="search">
            <form action="prepared_statement.php" method="get" autocomplete="none">
                <input type="search" autocomplete="none" id="search-inp" name="search" placeholder="Trouvez nos produits">
                <input type="submit" value="Recherche">
            </form>
        </section>
    </header>
    <main>
        
        <section class="results">
            <?php if ($err) : ?> 
                <span class="error">Une erreur est survenue<span class="smiley">:(</span></span>
            <?php elseif ($has_search && !empty($results)): ?>
                <span class="count"><?= sizeof($results) ?> produits correspondent</span>
                <table>
                    <tr>
                        <th>Nom</th>
                        <th>Prix</th>
                        <th>Quantité</th>
                    </tr>
                    <?php foreach($results as $r): ?>
                        <tr>
                            <?php foreach($r as $val): ?>
                                <td><?= $val ?></td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php elseif ($has_search): ?>
                <span class="warning">Aucun résultat pour votre recherche "<?= $_GET['search'] ?>"</span>
            <?php endif; ?>
        </section>
    </main>
</body>
</html>