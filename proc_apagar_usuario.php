<?php 
session_start();
include_once("conexao.php");

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

if (!empty($id)) {
    $result_usuario = "DELETE FROM usuarios WHERE id = '$id'";
    $resultado_usuario = mysqli_query($conn, $result_usuario);

    if ($resultado_usuario) {
        $_SESSION['mensagem'] = "<p style='color: green;'>Usuário apagado com sucesso!</p>";
        header("Location: listar.php");
    } else {
        $_SESSION['mensagem'] = "<p style='color: red;'>Usuário não foi apagado com sucesso!</p>";
        header("Location: listar.php");
    }
} else {
    $_SESSION['mensagem'] = "<p style='color: red;'>Necessário selecionar um usuário</p>";
    header("Location: listar.php");
}
?> 

