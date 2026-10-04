<?php
require_once '../config/conexao.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    /* transforma a senha em uma senha hash */
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    $sql = $pdo->prepare("
        /* aqui ele fala: 'inserir na tabela usuarios (nome, email, senha)' */
        INSERT INTO usuarios (nome, email, senha)
        /* aqui ele fala: 'valores sao (:nome, :emailn :senha) podia ser tambem (?, ?, ?) isso serve para proteger de sql inject' */
        VALUES (:nome, :email, :senha)
    ");

    /* aqui ele passa o prepare em um array, falando q os parametro sao as variaveis */
    $sql->execute([
        ':nome' => $nome,
        ':email' =>$email,
        ':senha' =>$senhaHash
    ]);

    $sucesso = true;
}

?>
<!doctype html>
<html lang="pt_br" data-bs-theme="dark">

<head>
    <title>Cadastro</title>
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
            <h1 class="text-center mt-3">Criar conta</h1>
            <?php if(isset($sucesso)): ?>
                 <h1 class="text-center mt-3 text-success">Usuario cadastrado com sucesso!</h1>

                 <script>
                    setTimeout(function(){
                        window.location.href = "../login/login.php";
                    }, 2000);
                 </script>
            <?php endif; ?>
            <form class="w-50 mx-auto shadow p-3 mb-5 bg-body-tertiary rounded" method="POST" action="">
                <div class="form-floating mt-3 mb-3">
                    <input autocomplete="off" type="text" name="nome" required class="form-control" id="floatingInput" placeholder="meunome meusobrenome">
                    <label for="floatingInput">Insira seu nome</label>
                </div>
                <div class="form-floating mb-3">
                    <input autocomplete="off"  type="email" name="email" required class="form-control" id="floatingInput" placeholder="meuemail@gmail.com">
                    <label for="floatingInput">Insira seu Email</label>
                </div>
                <div class="form-floating">
                    <input autocomplete="off"  type="password" name="senha" required class="form-control" id="floatingPassword" placeholder="Senha">
                    <label for="floatingPassword">Insira sua senha</label>
                </div>
                <div class="d-flex mt-3 w-100 justify-content-center">
                    <button type="submit" class="btn btn-success w-75">Cadastrar</button>
                </div>
            </form>
        </div>
    </main>
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>