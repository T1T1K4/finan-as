<?php
// Início da sessão e conexão com o banco
session_start();
require_once("conexao.php");

// Verificando a pesquisa e ajustando a consulta
$sql = "SELECT * FROM despesas";
if (!empty($_GET['search'])) {
    $data = mysqli_real_escape_string($conn, $_GET['search']);
    $sql .= " WHERE ano LIKE '%$data%' ORDER BY id DESC";
} else {
    $sql .= " ORDER BY id DESC";
}

$despesas = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="index.css">
    <title>Minhas Despesas</title>
</head>
<body>

<!-- Início da imagem de fundo -->
<div class="container-fluid bg-image"></div>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand">Minhas Despesas</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="index.php">Home</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Conteúdo Principal -->
<div class="container mt-4">
    <div class="accordion" id="accordionExample">
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                    Finanças
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <button class="btn btn-secondary">
                        <a href="createdespesas.php" class="text-decoration-none text-light">Nova Despesa</a>
                    </button>
                    <button class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample">
                        Pesquisar
                    </button>
                    <div class="offcanvas offcanvas-start" id="offcanvasExample">
                        <div class="offcanvas-header">
                            <h5>Filtro de Pesquisa</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
                        </div>
                        <div class="offcanvas-body">
                            <input type="search" class="form-control" id="pesquisar" placeholder="Pesquisar Ano">
                        </div>
                    </div>
                    <?php include('mensagem.php'); ?>
                    <div class="table-responsive mt-3">
                        <table class="table table-striped">
                            <thead class="table-dark">
                                <tr>
                                    
                                    <th>Ano</th>
                                    <th>Valor</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (mysqli_num_rows($despesas) > 0): ?>
                                    <?php while ($row = mysqli_fetch_assoc($despesas)): ?>
                                        <tr>
                                            
                                            <td><?= $row['ano'] ?></td>
                                            <td>R$ <?= number_format($row['valor'], 2, ',', '.') ?></td>
                                            <td><a href="exibir.php?id=<?= $row['id'] ?>" class="btn btn-primary btn-sm">Exibir</a></td>
                                        </tr>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr><td colspan="4" class="text-center">Nenhuma despesa encontrada.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Rodapé -->
<footer class="bg-dark text-light">
    <div class="container">
        <div class="row">
            <div class="col">
                <h3>Finanças</h3>
            </div>
            <div class="col">
                <h4>Menu</h4>
                <ul>
                    <li><a href="index.php" class="text-decoration-none text-light">Home</a></li>
                    <li><a href="createdespesas.php" class="text-decoration-none text-light">Nova Despesa</a></li>
                </ul>
            </div>
            <div class="col">
                <h4>Contato</h4>
                <ul>
                    <li>Email: contato@financas.com</li>
                </ul>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
