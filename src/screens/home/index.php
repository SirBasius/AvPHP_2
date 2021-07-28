<?php
require_once "src/models/User.php";
$user = $_SESSION["loggedUser"];
if (isset($_GET["search"])) {
    $users = User::search($_GET["search"]);
} else {
    $users = User::listUsers();
}
function logOut()
{
    session_destroy();
    header("Location: /");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>

<body>
    <div class="container">
        <section>
            <form action="?view=home" method="GET">
                <label for="search">Procurar Usuario:</label>
                <input type="text" name="search" value="<?php echo isset($_GET["search"]) ? $_GET["search"] : "" ?>">
                <button type="submit">Enviar</button>
            </form>
            <table>
                <thead>
                    <th>Id</th>
                    <th>Email</th>
                    <th>Username</th>
                    <th>Nome</th>
                </thead>
                <?php foreach ($users as $key => $value) : ?>
                    <tr>
                        <td><?= $value->getId() ?></td>
                        <td><?= $value->getEmail() ?></td>
                        <td><?= $value->getUsername() ?></td>
                        <td><?= $value->getName() ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <form action="?class=User&action=logout" method="post" required>
                <button type="submit">Sair</button>
            </form>
        </section>
    </div>
</body>

</html>