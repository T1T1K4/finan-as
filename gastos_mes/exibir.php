<?php  
session_start();  
require_once('conexao.php');  

$despesa = null;

// Verifica se o ID está presente na URL  
if (!isset($_GET['id'])) {  
    header('Location: index.php');  
    exit;  
} else {  
    $despesaID = mysqli_real_escape_string($conn, $_GET['id']);  
    $sql = "SELECT * FROM despesas WHERE id = '{$despesaID}'";  
    $query = mysqli_query($conn, $sql);  
    if (mysqli_num_rows($query) > 0) {  
        $despesa = mysqli_fetch_array($query);  
    }  
}  
?>  

<!DOCTYPE html>  
<html lang="pt-br">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">  
    <title>Finanças - Detalhes da Despesa</title>  
</head>  
<body>  

<div class="container mt-4">  
    <div class="row">  
        <div class="col-md-12">  
            <div class="card">  
                <div class="card-header">  
                    <h4>  
                        Detalhes da Despesa  
                        <a href="index.php" class="btn btn-danger float-end">Voltar</a>  
                    </h4>  
                </div>  
                <div class="card-body">  
                    <?php if ($despesa): ?>  
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
                                        <th>Tipo</th>
                                    </tr>  
                                </thead>  
                                <tbody>  
                                    <tr>  
                                        <td><?= htmlspecialchars($despesa['id']) ?></td>  
                                        <td><?= htmlspecialchars($despesa['ano']) ?></td>  
                                        <td><?= htmlspecialchars($despesa['mes']) ?></td>  
                                        <td><?= htmlspecialchars($despesa['descricao']) ?></td>  
                                        <td>R$ <?= number_format($despesa['valor'], 2, ',', '.') ?></td>  
                                        <td><?= htmlspecialchars($despesa['categoria']) ?></td>
                                        <td><?= htmlspecialchars($despesa['tipo']) ?></td>  
                                    </tr>  
                                </tbody>  
                            </table>  
                        </div>  

                        <!-- Formulário para adicionar novas despesas -->  
                        <form action="acoes.php?id=<?= htmlspecialchars($despesa['id']) ?>" method="POST" class="mt-4">  
                            <input type="hidden" name="id_despesa" value="<?= htmlspecialchars($despesa['id']) ?>">  
                            <input type="hidden" name="ano" value="<?= htmlspecialchars($despesa['ano']) ?>">  
                            <input type="hidden" name="mes" value="<?= htmlspecialchars($despesa['mes']) ?>">  
                            <table class="table table-bordered">  
                                <thead>  
                                    <tr>  
                                        <th>Descrição</th>  
                                        <th>Valor</th>  
                                        <th>Categoria</th>  
                                        <th>Tipo</th>
                                        <th>Ações</th>  
                                    </tr>  
                                </thead>  
                                <tbody id="table-body"></tbody>  
                            </table>  
                            <button id="add-row" class="btn btn-success w-100">Adicionar Nova Despesa</button>  
                            <button type="submit" name="createdespesas" class="btn btn-primary w-100 mt-3">Salvar Despesas</button>  
                        </form>  

                    <?php else: ?>  
                        <div class="alert alert-warning" role="alert">  
                            Despesa não encontrada.  
                        </div>  
                    <?php endif; ?>  
                </div>  
            </div>  
        </div>  
    </div>  
</div>  

<script>  
    document.getElementById("add-row").addEventListener("click", function (e) {  
        e.preventDefault();  
        const tableBody = document.getElementById("table-body");  
        const newRow = `  
            <tr>  
                <td><input type="text" name="descricao[]" class="form-control" placeholder="Descrição" required></td>  
                <td><input type="number" name="valor[]" class="form-control" placeholder="Valor" step="0.01" required></td>  
                <td><input type="text" name="categoria[]" class="form-control" placeholder="Categoria" required></td>  
                <td>
                    <select name="tipo[]" id="tipo" class="w-full mt-1 px-3 py-2 border rounded focus:outline-none focus:ring focus:ring-blue-300" required>
                        <option value="entrada">Entrada</option>
                        <option value="saida">Saída</option>
                    </select>
                </td>
                <td><button type="button" class="btn btn-danger" onclick="removeRow(this)">Remover</button></td>  
            </tr>  
        `;  
        tableBody.insertAdjacentHTML("beforeend", newRow);  
    });  

    function removeRow(button) {  
        button.closest("tr").remove();  
    }  
</script>  

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>  
</body>  
</html>  
