<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar - Usuários</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="index.css">
</head>
<style>
    /* Tira essa bomba, serve para não ficar com as funções em negrito */
    th {
        font-weight: normal;
    }

    input, select, button {
        margin: 5px 0;
        font-size: 14px;
    }
</style>
<body>

<div class="container-fluid bg-image"></div>

<!-- Formulário de Despesas -->
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Dispesas <i class="bi bi-cash-coin"></i>
                        <a href="index.php" class="btn btn-danger float-end">Voltar</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="acoes.php" method="POST" class="me-3">
                        <div class="input-group dropdown me-2 align-items-center">
                            <span class="input-group-text">Insira</span>
                            <input type="number" name="ano" class="form-control text-center" placeholder="Ano" required>
                            <select name="mes" class="form-select text-center" required>
                                <option value="1">Janeiro</option>
                                <option value="2">Fevereiro</option>
                                <option value="3">Março</option>
                                <option value="4">Abril</option>
                                <option value="5">Maio</option>
                                <option value="6">Junho</option>
                                <option value="7">Julho</option>
                                <option value="8">Agosto</option>
                                <option value="9">Setembro</option>
                                <option value="10">Outubro</option>
                                <option value="11">Novembro</option>
                                <option value="12">Dezembro</option>
                            </select>
                        </div>

                        <div class="container mt-5 text-center">
                            <table class="table table-bordered mt-4">
                                <thead>
                                    <tr>
                                        <th>Descrição</th>
                                        <th>Valor</th>
                                        <th>Categoria</th>
                                        <th>Tipo</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody id="table-body">
                                </tbody>
                            </table>
                            <button id="add-row" class="btn btn-success w-100">Adicionar um novo gasto</button>
                        </div>

                        <script>
                            document.getElementById("add-row").addEventListener("click", function (e) {
                                e.preventDefault(); // Impede o comportamento padrão do botão
                                const tableBody = document.getElementById("table-body");
                                const newRow = `
                                    <tr>
                                        <td><input type="text" name="descricao[]" class="form-control" placeholder="Descrição"></td>
                                        <td><input type="number" name="valor[]" class="form-control" placeholder="Gastos"></td>
                                        <td><input type="text" name="categoria[]" class="form-control" placeholder="Categoria"></td>
                                        <td>
                                            <select name="tipo[]" class="w-full mt-1 px-3 py-2 border rounded" required>
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

                        <div class="col">
                            <button type="submit" name="createdespesas" class="btn btn-primary float-end mt-4">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

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
                    <li><a href="#" class="text-decoration-none text-light">Despesas</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>

</body>
</html>
