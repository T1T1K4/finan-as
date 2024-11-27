<?php
session_start();
require_once('conexao.php');

// Verifica se o formulário foi enviado
if (isset($_POST['createdespesas'])) {
    // Obtém os dados do formulário
    $Ano = mysqli_real_escape_string($conn, $_POST['Ano']);
    $dropdownMonth = mysqli_real_escape_string($conn, $_POST['dropdownMonth']);
    
    $categoria = mysqli_real_escape_string($conn, $_POST['categoria']);
    $tipo = mysqli_real_escape_string($conn,$_POST['tipo'] );
    $descricoes = $_POST['description']; 
    $valor = $_POST['valor'];         

    // Verifica se há dados válidos
    if (!empty($descricoes) && !empty($valor)) {
        // Salva as informações no banco
        foreach ($descricoes as $key => $descricao) {
            $descricao = mysqli_real_escape_string($conn, $descricao);
            $valorGasto = mysqli_real_escape_string($conn, $valor[$key]);

            // Query para salvar no banco
            $sql = "INSERT INTO despesas (ano, mes, descricao, valor, categoria) 
            VALUES ('$Ano', '$dropdownMonth', '$descricao', '$valorGasto', '$categoria')";

            // Executa a query e verifica se tem erros
            if (!mysqli_query($conn, $sql)) {
                echo "Erro ao salvar: " . mysqli_error($conn);
                exit();
            }
        }

        // Redireciona após salvar tudo
        header('Location: index.php');
        exit();
    } else {
        echo "Por favor, preencha todos os campos.";
    }
}
?>
