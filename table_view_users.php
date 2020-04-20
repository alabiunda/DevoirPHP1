<table id="user-list">
    <tr>
        <th>Nom d'utilisateur</th>
        <th>Mot de passe</th>
    </tr>
    <?php foreach($user_list as $user): ?>
        <tr>
            <form action="index.php" method="post">
                <td><input type="text" name="username" value="<?= $user->__get('username'); ?>"></td>
                <td><input type="number" name="password" value="<?= $user->__get('password'); ?>"></td>
                <td><input type="hidden" name="pkUser" value="<?= $user->__get('pk'); ?>"></td>
                <td><input type="submit" name="type" value="deleteUser"></></td>
                <td><input type="submit" name="type" value="editUser"></></td>
            </form>
        </tr>
    <?php endforeach; ?>
</table>