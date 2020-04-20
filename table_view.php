<table id="product-list">
    <tr>
        <th>Nom</th>
        <th>Prix</th>
        <th>Quantité</th>
    </tr>
    <?php foreach($product_list as $product): ?>
        <tr>
            <td><?= $product->__get('name'); ?></td>
            <td><?= $product->__get('price'); ?></td>
            <td><?= $product->__get('quantity'); ?></td>
            <td><button type="button" class="delete-btn">DELETE</button></td>
        </tr>
    <?php endforeach; ?>
</table>