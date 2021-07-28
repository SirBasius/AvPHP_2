<?php
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <div class="container">
        <h1>Login</h1>
        <form action="?class=User&action=login" method="post">
            <div class="form-control">
                <label for="email">E-mail</label>
                <input placeholder="email *" type="email" name="email" id="email" required>
            </div>
            <div class="form-control">
                <label for="password">Senha</label>
                <input placeholder="password *" type="password" name="password" id="password" required>
            </div>
            <button type="submit">Login</button>
            <div>
                <span>Não possui uma conta?</span>
                <a href="?view=register">Registre-se</a>
            </div>
        </form>
    </div>
</body>

</html>