<?php
/* isso permite q eu possa trabalhar com sessoes */
session_start();

require_once '../config/conexao.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    /* pegamos os dados */
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    /* Prepara a consulta no banco de dados dizendo: "Procure todas as colunas (*) da tabela usuarios onde a coluna email seja igual ao parâmetro :email". */
    $sql = $pdo->prepare("
        SELECT * FROM usuarios WHERE email = :email
    ");

    /* Substitui o parâmetro :email pelo valor real da variável $email (que veio de $_POST['email']) de forma segura, prevenindo ataques de SQL Injection. */
    $sql->execute([
        ':email' => $email
    ]);

    /* Executa a busca e pega a primeira linha encontrada, transformando-a em um array associativo armazenado na variável $usuario. */
    $usuario = $sql->fetch(PDO::FETCH_ASSOC);

    if($usuario && password_verify($senha, $usuario['senha'])){
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_nome'] = $usuario['nome'];
        $_SESSION['usuario_email'] = $usuario['email'];

        header('location: ../painel/index.php');
    }else {
        echo '<h1 class="text-center mt-3 text-danger">Email ou senha incorretos.</h1>';
    }
}

?>
<!doctype html>
<html lang="pt_br" data-bs-theme="dark">

<head>
    <title>Login</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS v5.3.8 -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
        crossorigin="anonymous" />
</head>

<body>
    <main class="container">
        <div class="mx-auto w-75">
            <h1 class="text-center mt-3">Login</h1>
            <form class="w-50 mx-auto shadow p-3 mb-5 bg-body-tertiary rounded" method="POST" action="">
                <div class="form-floating mb-3">
                    <input type="email" name="email" required class="form-control" id="floatingInput" placeholder="meuemail@gmail.com">
                    <label for="floatingInput">Email:</label>
                </div>
                <div class="form-floating">
                    <input type="password" name="senha" required class="form-control" id="floatingPassword" placeholder="Senha">
                    <label for="floatingPassword">senha:</label>
                </div>
                <div class="d-flex mt-3 w-100 justify-content-center">
                    <button type="submit" class="btn btn-success w-75">Entrar</button>
                </div>
            </form>
        </div>
    </main>
    <!-- Bootstrap JavaScript Bundle (includes Popper) -->
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>