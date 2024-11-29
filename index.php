<?php
// Início da sessão e conexão com o banco
session_start();
require_once("conexao.php");
$sql = "SELECT * FROM despesas";
$despesas = mysqli_query($conn, $sql);
if (!empty($_GET['search'])) {
    $data = mysqli_real_escape_string($conn, $_GET['search']);
    $sql = "SELECT * FROM despesas WHERE ano LIKE '%$data%' ORDER BY id DESC";
} else {
    $sql = "SELECT * FROM despesas ORDER BY id DESC";
}

$despesas = mysqli_query($conn, $sql);
?>

<!-- Início do documento HTML -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Finanças</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>

<!-- Início da imagem de fundo -->
<div class="container-fluid bg-image"></div>
<!-- Fim da imagem de fundo -->

<!-- Início da navbar -->
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand">Minhas despesas</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- Fim da navbar -->

<!-- Início do conteúdo principal -->
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h1 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Finanças
                        </button>
                    </h1>
                    
                    <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <!-- Botões de filtro e nova despesa -->
                            <button class="btn btn-secondary" type="button">
                                <a href="createdespesas.php" class="text-decoration-none  text-light">Nova despesa</a>
                            </button>
                            <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                            Pesquisar
                            </button>
                            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
                                <div class="offcanvas-header">
                                    <h5 class="offcanvas-title" id="offcanvasExampleLabel">Filtro de pesquisa</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                </div>
                                    <div class="offcanvas-body">
                                        <div>
                                             <div class="box-search">
                                                <input type="search" class="form-control" placeholder="Pesquisar Ano" id="pesquisar">
                                             </div>
                                        </div>
                                    </div>
                            </div>
                            <!-- Início da tabela -->
                                    <?php include('mensagem.php'); ?>
                                    <div class="table-responsive mt-3">
                                        <table class="table table-striped table-hover">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Ano</th>
                                                    <th>Mês</th>
                                                    <th>Descrição</th>
                                                    <th>Valor</th>
                                                    <th>Categoria</th>
                                                    <th>Ações</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (mysqli_num_rows($despesas) > 0) {
                                                    while ($row = mysqli_fetch_assoc($despesas)) {
                                                        echo "<tr>";
                                                        echo "<td>" . $row['id'] . "</td>";
                                                        echo "<td>" . $row['ano'] . "</td>";
                                                        echo "<td>" . $row['mes'] . "</td>";
                                                        echo "<td>" . $row['descricao'] . "</td>";
                                                        echo "<td>R$ " . number_format($row['valor'], 2, ',', '.') . "</td>";
                                                        echo "<td>" . $row['categoria'] . "</td>";
                                                        echo "<td>
                                                                <a href='editardespesa.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm'>Editar</a>
                                                                <a href='deletardespesa.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Tem certeza que deseja excluir?\")'>Excluir</a>
                                                            </td>";
                                                        echo "</tr>";
                                                    }
                                                } else {
                                                    echo "<tr><td colspan='7' class='text-center'>Nenhuma despesa encontrada.</td></tr>";
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- Adicionar itens da tabela aqui -->
                            </div>
                            <!-- Fim da tabela -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Fim do conteúdo principal -->

<!-- Início do rodapé -->
<footer class="bg-dark text-light fs-10">
    <div class="container">
        <div class="row">
            <div class="col">
                <h3>Finanças</h3>
            </div>
            <div class="col">
                <h4>Menu</h4>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-decoration-none text-light">Home</a></li>
                    <li><a href="#" class="text-decoration-none text-light">Nova Despesa</a></li>
                </ul>
            </div>
            <div class="col col-lg-3 text-center">
                <h4>Redes Sociais</h4>
                <div>
                    <a href="#" class="text-decoration-none text-light"><i class="bi bi-github fs-4 me-1"></i></a>
                    <a href="#" class="text-decoration-none text-light"><i class="bi bi-linkedin fs-4 me-1"></i></a>
                    <h7>George</h7>
                </div>
                <div>
                    <a href="#" class="text-decoration-none text-light"><i class="bi bi-github fs-4 me-1"></i></a>
                    <a href="#" class="text-decoration-none text-light"><i class="bi bi-linkedin fs-4 me-1"></i></a>
                    <h7>Carlos</h7>
                </div>
            </div>
        </div>
        <hr>
        <div class="d-flex justify-content-between">
            <p>2024 © Dispesas.</p>
            <div>
                <a href="" class="text-decoration-none text-light me-4">Terms of Use</a>
                <a href="" class="text-decoration-none text-light me-4">Privacy Policy</a>
            </div>
        </div>
    </div>
</footer>
<!-- Fim do rodapé -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
<script>
var search = document.getElementById('pesquisar');

search.addEventListener("keydown", function(event) {
    if (event.key === "Enter") {
        searchData();
    }
});

function searchData() {
    let searchValue = document.getElementById('pesquisar').value;
    window.location = 'index.php?search=' + searchValue;
}
</script>
</html>