<?php 
/* inicia a sessao para trabalhar com sessao */
session_start();

/* remove as variaveis armazenadas na funcao */
session_unset();

/* destroi a sessao */
session_destroy();

/* manda o usuario de volta para a pagina de login */
header('location: login/login.php');
exit;
?>