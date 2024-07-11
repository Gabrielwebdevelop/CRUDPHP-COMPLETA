
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD-Listar</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 60px;
        }

        .container {
            background-color: #ffffff;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
        }

        .pagination {
            justify-content: center;
        }
    </style>
</head>

<body style="background-color: black;">

    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="#">CRUD-Listar</a>
    </nav>

    <div class="container mt-5">
    <?php
        // Inicia a sessão
        session_start();

        // Inclui o arquivo de conexão com o banco de dados
        include_once('conexao.php');
        ?>
        <img src="https://i.gifer.com/D1D7.gif" class="img-fluid" alt="Goku GIF">
        <h1 class="text-center mt-4 mb-5">Listar Usuários</h1>
        <?php
        // Exibe a mensagem de sessão, se houver, e depois a remove
        if (isset($_SESSION['msg'])) {
            echo '<div class="alert alert-success">' . $_SESSION['msg'] . '</div>';
            unset($_SESSION['msg']);
        }

        // Recebe o número da página atual via GET e sanitiza o valor
        $pagina_atual = filter_input(INPUT_GET, 'pagina', FILTER_SANITIZE_NUMBER_INT);
        // Define a página atual, padrão é 1 se não estiver definida
        $pagina = (!empty($pagina_atual)) ? $pagina_atual : 1;

        // Define a quantidade de itens por página
        $qnt_result_pg = 2;

        // Calcula o início da visualização
        $inicio = ($qnt_result_pg * $pagina) - $qnt_result_pg;

        // Consulta para selecionar os usuários com limite para paginação
        $select_user = "SELECT * FROM usuarios LIMIT $inicio, $qnt_result_pg";
        $selected_user = mysqli_query($conn, $select_user);

        // Consulta para contar o número total de usuários
        $result_pg = "SELECT COUNT(id) as num_result FROM usuarios";
        $resultado_pg = mysqli_query($conn, $result_pg);
        $row_pg = mysqli_fetch_assoc($resultado_pg);

        // Calcula a quantidade total de páginas
        $quantidade_pg = ceil($row_pg['num_result'] / $qnt_result_pg);

        // Verifica se há resultados para exibir
        if (mysqli_num_rows($selected_user) > 0) {
            // Loop para exibir os usuários da página atual
            while ($row_user = mysqli_fetch_assoc($selected_user)) {
                echo  "<div class='card mb-3'>";
                echo "<div class='card-body'>";
                echo  "<p class='card-text'>ID: " . $row_user['id'] . "</p>";
                echo "<p class='card-text'>Nome: " . $row_user['nome'] . "</p>";
                echo "<p class='card-text'>E-mail: " . $row_user['email'] . "</p>";
                echo "<a href='edit_usuario.php?id=" . $row_user['id'] . "' class='btn btn-primary' >Editar</a>"; 
                echo "<a href='proc_apagar_usuario.php?id=" . $row_user['id'] . "' class='btn btn-primary' style='margin-left: 60px';>Apagar</a>";
                echo "</div>";
                echo "</div>";
            }

            // Define o número máximo de links de paginação antes e depois da página atual
            $max_links = 2;

            // Link para a primeira página
            echo "<nav aria-label='Page navigation'>";
            echo "<ul class='pagination justify-content-center'>";

            // Link para a primeira página
            echo "<li class='page-item'><a class='page-link' href='listar.php?pagina=1'>Primeira</a></li>";

            // Loop para gerar links das páginas anteriores
            for ($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++) {
                if ($pag_ant >= 1) {
                    echo "<li class='page-item'><a class='page-link' href='listar.php?pagina=$pag_ant'>$pag_ant</a></li>";
                }
            }

            // Link para a página atual
            echo "<li class='page-item active'><span class='page-link'>$pagina</span></li>";

            // Loop para gerar links das páginas seguintes
            for ($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++) {
                if ($pag_dep <= $quantidade_pg) {
                    echo "<li class='page-item'><a class='page-link' href='listar.php?pagina=$pag_dep'>$pag_dep</a></li>";
                }
            }

            // Link para a última página
            echo "<li class='page-item'><a class='page-link' href='listar.php?pagina=$quantidade_pg'>Última</a></li>";

            echo "</ul>";
            echo "</nav>";
        } else {
            echo "<p class='text-center'>Nenhum usuário encontrado.</p>";
        }

        ?>

        <a href="Cadastro.php" class="btn btn-primary btn-block mt-4">Cadastrar Novo Usuário</a>
    </div>

    <!-- Bootstrap JS e jQuery (opcional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

</body>

</html>
