<?php

    require_once './PHP/models/Pessoa.php';

    $modelPessoa = new Pessoa(
        "cadastro",
        "127.0.0.1:3306",
        "root",
        "secret"
    );

//PHP

    if (isset($_POST['atualizar'])) {
        $id_update = addslashes($_GET['id_up']);
        $nome = addslashes($_POST['nome']);
        $telefone = addslashes($_POST['telefone']);
        $email = addslashes($_POST['email']);

        //EDITAR
        if (
            !empty($nome) && 
            !empty($telefone) && 
            !empty($email)) {
            $modelPessoa->atualizarDados(
                $id_update,
                $nome,
                $telefone,
                $email);                           
        } else {
            ?>
                <div class="aviso">
                    <h4>
                        Preencha todos os campos!
                    </h4>
                </div>
            <?php
        }
    } 
    if (isset($_POST['cadastrar'])) {
        $nome = addslashes($_POST['nome']);
        $telefone = addslashes($_POST['telefone']);
        $email = addslashes($_POST['email']);
        
        //CADASTRAR
        if (
            !empty($nome) && 
            !empty($telefone) && 
            !empty($email)) {
            if(!$modelPessoa->cadastrarPessoa(
                $nome,
                $telefone,
                $email
            ))
            {
                ?>
                    <div class="aviso">
                        <h4>
                            Email já cadastrado!
                        </h4>
                    </div>
                <?php
            }

        } else {
            ?>
                <div class="aviso">
                    <h4>
                        Preencha todos os campos!
                    </h4>
                </div>
            <?php
        }
    }

    //Se tiver o ID na URL ele tenta buscar a Pessoa
    //Caso exista é ATUALIZAR, caso não exista é CADASTRAR
    if (isset($_GET['id_up'])) {
        $id_update = addslashes($_GET['id_up']);
        $pessoa = $modelPessoa->buscarDadosPessoa($id_update);
    }

    //EXCLUIR
    if (isset($_GET['id'])) {
        $id_pessoa = addslashes($_GET['id']);
        $modelPessoa->excluirPessoa($id_pessoa);
        /* Mensagem de cadastro excluido com sucesso! */
        header("location: index.php");
    }

    $dados = $modelPessoa->buscarDados();
?>