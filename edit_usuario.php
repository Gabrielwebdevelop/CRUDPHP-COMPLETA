<?php
// Inicia a sessão
session_start();
include_once('conexao.php');
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$result_usuario = "SELECT * FROM usuarios WHERE id = '$id'";
$resultado_usuario = mysqli_query($conn, $result_usuario);
$row_usuario = mysqli_fetch_assoc($resultado_usuario);
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
        }

        .container {
            max-width: 400px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #fff;
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1 class="mt-4 mb-4 text-center">Cadastrar Usuário</h1>
        <?php
        // Exibe a mensagem de sessão, se houver, e depois a remove
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        ?>

        <!-- Formulário para cadastrar um novo usuário -->
        <form action="proc_edit_usuario.php" method="post">
            <div class="form-group">
                <input type="hidden" name="id" value="<?php echo $row_usuario['id']; ?>">
                <label for="nome">Nome:</label>
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o nome completo" value="<?php echo $row_usuario['nome']; ?>" required>
                
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Digite o seu e-mail" value="<?php echo $row_usuario['email']; ?>" required>
                
            </div>

            <button type="submit" class="btn btn-primary btn-block">Editar</button>

            <!-- Botão para listar usuários -->
            <a href="listar.php" class="btn btn-secondary btn-block mt-3">Listar Usuários</a>
        </form>
        <br><br>

    </div>

    <!-- Bootstrap JS e jQuery (opcional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

</body>

</html>