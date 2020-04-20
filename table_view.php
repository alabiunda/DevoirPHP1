<table id="product-list">
    <tr>
        <th>Nom</th>
        <th>Prix</th>
        <th>Quantité</th>
    </tr>
    <?php foreach($product_list as $product): ?>
        <tr>
            <form action="index.php" method="post">
            <td><input type="text" name="name" value="<?= $product->__get('name'); ?>"></td>
            <td><input type="number" name="price" value="<?= $product->__get('price'); ?>"></td>
            <td><input type="number" name="quantity" value =<?= $product->__get('quantity'); ?>></td>
            <td><input type="hidden" name="pk" value="<?= $product->__get('pk'); ?>"></td>
            <td><input type="submit" name="type" value="delete"></></td>
            <td><input type="submit" name="type" value="edit"></></td>
            </form>
        </tr>
    <?php endforeach; ?>
</table>