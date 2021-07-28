<?php
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cadastrar</title>
</head>

<body>
    <div class="container">
        <h1>Cadastrar</h1>
        <form action="?class=User&action=register" method="post">
            <div class="form-control">
                <label for="username">Username</label>
                <input placeholder="username *" type="text" name="username" id="username" required>
            </div>
            <div class="form-control">
                <label for="nomecompleto">Nome</label>
                <input placeholder="nome *" type="text" name="name" id="name" required>
            </div>
            <div class="form-control">
                <label for="email">E-mail</label>
                <input placeholder="email *" type="email" name="email" id="email" required>
            </div>
            <div class="form-control">
                <label for="senha">Senha</label>
                <input placeholder="senha *" type="password" name="password" id="password" required>
            </div>
            <button type="submit">Cadastrar</button>
            <div>
                <span>Já tem uma conta?</span>
                <a href="?view=login">fazer login</a>
            </div>
        </form>
    </div>
</body>

</html>
