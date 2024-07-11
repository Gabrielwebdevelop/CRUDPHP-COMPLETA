<?php
// Inicia a sessão
session_start();

// Inclui o arquivo de conexão com o banco de dados
include_once("conexao.php");

// Sanitiza e obtém os dados do formulário
$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING); 
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

// Cria a consulta SQL para inserir um novo usuário no banco de dados
$create_user = "UPDATE usuarios SET nome='$nome', email = '$email', modified=NOW() WHERE id= '$id'";
$created_user = mysqli_query($conn, $create_user);

// Executa a consulta SQL
//$usuario_criado = mysqli_query($conn, $criar_usuario);

// Verifica se o usuário foi inserido com sucesso
if(mysqli_affected_rows($conn)){
    $_SESSION['msg'] = "<p style='color: green'>Usuário editado com sucesso</p>";
    header("Location: listar.php"); 
}else{
    $_SESSION['msg'] = "<p style='color: red'>Usuário nao foi editado com sucessso</p>";
    header("Location: edit_usuario.php"); 
}

// Encerra a execução do script
exit();
?>
