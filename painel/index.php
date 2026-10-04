<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header('location: ../login/login.php');
    exit;
}
?>
<!doctype html>
<html lang="pt_br" data-bs-theme="dark">

<head>
    <title>Painel</title>
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
    <header>
        <nav class="navbar bg-body-tertiary">
            <div class="container-fluid">
                <h1>Bem-vindo, <?php echo $_SESSION['usuario_nome'] ?>!</h1>
                <div class="d-flex">
                    <a class="btn btn-danger" href="../logout.php">Sair</a>
                </div>
            </div>
        </nav>
    </header>
    <main class="container">
        <div class="mx-auto">
            <h1 class="text-primary text-center mt-2">Enviar Email</h1>
            <form class="form-control mt-5" action="enviar.php" method="POST">
                <label for="nome">Nome:</label>
                <input class="form-control my-2" type="text" name="nome" id="nome" required placeholder="Digite seu nome...">

                <label for="email">E-mail:</label>
                <input class="form-control my-2" type="email" name="email" id="email" required placeholder="Digite seu E-mail...">

                <label for="mensagem">Mensagem:</label>
                <textarea class="form-control my-2" name="mensagem" id="mensagem" required placeholder="Digite sua mensagem!"></textarea>

                <label for="email">destinatario:</label>
                <input class="form-control my-2" type="email" name="destinatario" id="destinatario" required placeholder="Digite o E-mail de quem recebera a mensagem...">

                <input  class="my-3 btn btn-primary" target="_blank" type="submit" value="Enviar!">
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