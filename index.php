<?php
    include './PHP/controllers/pessoa.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta 
        name="viewport" 
        content="width=device-width, initial-scale=1.0">

        <link 
            rel="stylesheet" 
            href="/CSS/estilo.css">
        <link 
            rel="stylesheet" 
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

        <title>Cadastro</title>
</head>
<body>
    <div class="row">

<!-------------------------------------------------FORMULÁRIO DE CADASTRO--------------------------------------------------------->
        <div id="esquerda" class="col-md-5 p-5">
            <!-- 
                if( $erroMensagem ) {
                    <div class="aviso">
                        <h4>
                            echo $erroMensagem;
                        </h4>
                    </div>
                } 
            -->
            <form method="POST" class="p-5 m-5 bg-warning">
                <h2 class="text-center"><?php echo isset($pessoa) ? "Atualizar Pessoa" : "Cadastrar Pessoa"; ?></h2>
                <div class="form-group">
                    <label for="nome" class="d-block">Nome</label>
                    <input 
                        type="text" 
                        name="nome"
                        class="form-control mb-3" 
                        id="nome"
                        value="<?php if (isset($pessoa)) { echo $pessoa['nome']; } ?>">
                </div>

                <div class="form-group">
                    <label for="telefone" class="d-block">Telefone</label>
                    <input 
                        type="text" 
                        name="telefone"
                        class="form-control mb-3" 
                        id="telefone"
                        value="<?php if (isset($pessoa)) { echo $pessoa['telefone']; } ?>">
                </div>

                <div class="form-group">
                    <label for="email" class="d-block">Email</label>
                    <input 
                        type="email" 
                        name="email"
                        class="form-control mb-3" 
                        id="email"
                        value="<?php if (isset($pessoa)) { echo $pessoa['email']; } ?>">
                </div>

                <input 
                    type="submit"
                    class="btn d-grid gap-2" 
                    name="<?php echo isset($pessoa) ? "atualizar" : "cadastrar"; ?>"
                    value="<?php echo isset($pessoa) ? "Atualizar" : "Cadastrar"; ?>">

            </form>
        </div>

<!---------------------------------------------TABELA COM A LISTAGEM DO CADASTRO-------------------------------------------------->
        <div id="direita" class="col-md-7 p-5 ">
            <table class="table p-5 mt-5">
                <thead class="table-warning">
                    <tr id="titulo">
                        <td>NOME</td>
                        <td>TELEFONE</td>
                        <td colspan="2">EMAIL</td>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php
                    
                    if (count($dados) > 0) {
                        for ($i=0; $i < count($dados); $i++) { 
                            
                            echo "<tr>";
                            foreach ($dados[$i] as $campo => $valor) {
                                if ($campo != "id") {
                                    echo "<td>".$valor."</td>"; 
                                }
                            }
                            ?>
                            <td>
                                <a href="index.php?id_up=<?php echo $dados[$i]['id'];?>">Editar</a>
                                <a href="index.php?id=<?php echo $dados[$i]['id'];?>">Excluir</a>
                            </td>
                            <?php
                            echo "</tr>";
                        }
                    } else {
                        ?>
                            <div class="aviso">
                                <h4>
                                    Ainda não temos pessoas cadastradas no banco de dados!
                                </h4>
                            </div>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script 
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js">
    </script>
    <script 
        src="https://cdn.jsdelivr.net/npm/sweetalert2@11">
    </script>

</body>
</html>