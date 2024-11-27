<?php
session_start();
require_once('conexao.php');

// Função para atualizar o saldo com base no tipo de transação
function atualizarSaldo($conn, $ano, $mes, $valor, $tipo) {
    // Seleciona o saldo atual
    $sqlSaldo = "SELECT saldo FROM saldos WHERE ano = '$ano' AND mes = '$mes'";
    $querySaldo = mysqli_query($conn, $sqlSaldo);
    
    if (mysqli_num_rows($querySaldo) > 0) {
        // Se houver saldo, pega o valor atual do saldo
        $saldo = mysqli_fetch_assoc($querySaldo)['saldo'];
        
        // Se for entrada, soma o valor ao saldo
        if ($tipo === 'entrada') {
            $novoSaldo = $saldo + $valor;
        } else if ($tipo === 'saida') {
            // Se for saída, subtrai o valor do saldo
            $novoSaldo = $saldo - $valor;
        }

        // Atualiza o saldo no banco
        $sqlUpdateSaldo = "UPDATE saldos SET saldo = '$novoSaldo' WHERE ano = '$ano' AND mes = '$mes'";
        mysqli_query($conn, $sqlUpdateSaldo);
    } else {
        // Se não houver saldo, insere o saldo inicial
        $novoSaldo = ($tipo === 'entrada') ? $valor : -$valor;
        $sqlInsertSaldo = "INSERT INTO saldos (ano, mes, saldo) VALUES ('$ano', '$mes', '$novoSaldo')";
        mysqli_query($conn, $sqlInsertSaldo);
    }
}

// Verifica se o formulário foi enviado
if (isset($_POST['createdespesas'])) {
    // Obtém os dados do formulário
    $id_despesa = mysqli_real_escape_string($conn, $_POST['id_despesa']); // ID da despesa existente
    $ano = mysqli_real_escape_string($conn, $_POST['ano']);
    $mes = mysqli_real_escape_string($conn, $_POST['mes']);
    $tipo = $_POST['tipo'];  // Tipo agora será manipulado dentro do loop
    
    // As variáveis de descrição e valor são arrays, então precisamos iterar sobre elas
    $descricoes = $_POST['descricao'];
    $valores = $_POST['valor'];

    // Verifica se há dados válidos
    if (!empty($descricoes) && !empty($valores)) {
        // Salva as informações no banco
        foreach ($descricoes as $key => $descricao) {
            // Escapa cada descrição e valor individualmente
            $descricao = mysqli_real_escape_string($conn, $descricao);
            $valorGasto = mysqli_real_escape_string($conn, $valores[$key]);

            // Agora o tipo é recuperado corretamente do array, por exemplo, tipo[$key]
            $tipoDespesa = mysqli_real_escape_string($conn, $tipo[$key]);

            // Query para salvar no banco
            $sql = "INSERT INTO despesas (id, ano, mes, descricao, valor, tipo) 
                    VALUES ('$id_despesa', '$ano', '$mes', '$descricao', '$valorGasto', '$tipoDespesa')";

            // Executa a query e verifica se tem erros
            if (!mysqli_query($conn, $sql)) {
                echo "Erro ao salvar: " . mysqli_error($conn);
                exit();
            }

            // Atualiza o saldo considerando o tipo de transação (entrada ou saída)
            atualizarSaldo($conn, $ano, $mes, $valorGasto, $tipoDespesa);
        }
    }

    // Redireciona de volta para o formulário
    header("Location: exibir.php?id=$id_despesa");
    exit();
}
?>
