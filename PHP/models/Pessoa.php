<?php

Class Pessoa{

    private $pdo;
    // CONEXÃO COM BANCO DE DADOS
    public function __construct(
        $dbname, 
        $host, 
        $user, 
        $senha)
    {
        
        try {
            $this->pdo = new PDO(
                "mysql:dbname=".$dbname.";
                host=".$host,$user,$senha);
        } catch (PDOException $e) {
            echo "Erro com banco de dados: ".$e->getMessage();
            exit();
        } catch (Exception $e) {
            echo "Erro comum".$e->getMessage();
            exit();
        }
    }

    //FUNÇÃO PARA BUSCAR OS DADOS E ENVIAR PARA A TABELA
    public function buscarDados()
    {
        $res = array();
        $cmd = $this->pdo->query(
            "SELECT * FROM 
            pessoa 
            ORDER BY 
            nome"
        );
        $res = $cmd->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }

    //FUNÇÃO PARA CADASTRAR PESSOA
    public function cadastrarPessoa(
        $nome, 
        $telefone, 
        $email)
    {
        //Função de verificação com base no email da pessoa
        $cmd = $this->pdo->prepare(
            "SELECT 
            id 
            FROM 
            pessoa 
            WHERE 
            email = :e"
        );
        $cmd->bindValue(
            ":e", $email
        );
        $cmd->execute();
        if ($cmd->rowCount() > 0) {
            return false;

        } else {
            $cmd = $this->pdo->prepare(
                "INSERT INTO pessoa (
                nome, 
                telefone, 
                email)
                VALUES (
                :n, 
                :t, 
                :e)"
            );
            $cmd->bindValue(
                ":n", $nome
            );
            $cmd->bindValue(
                ":t", $telefone
            );
            $cmd->bindValue(
                ":e", $email
            );
            $cmd->execute();
            header("location:index.php");

            return true;
        }
    }

    //FUNÇÃO PARA EXCLUIR PESSOA
    public function excluirPessoa($id){
        $cmd = $this->pdo->prepare(
            "DELETE FROM 
            pessoa
            WHERE
            id = :id"
        );
        $cmd->bindValue(
            ":id", $id
        );
        $cmd->execute();
    }

    //BUSCAR DADOS DE 1 PESSOA
    public function buscarDadosPessoa($id){
        $res = array();
        $cmd = $this->pdo->prepare(
            "SELECT * FROM
            pessoa
            WHERE 
            id = :id"
        );
        $cmd->bindValue(
            ":id", $id
        );
        $cmd->execute();
        $res = $cmd->fetch(PDO::FETCH_ASSOC);
        return $res;
    }

    //FUNÇÃO EDITAR
    public function atualizarDados(
        $id,
        $nome,
        $telefone,
        $email)
    {
        $cmd = $this->pdo->prepare(
            "UPDATE
            pessoa 
            SET
            nome = :n,
            telefone = :t,
            email = :e
            WHERE
            id = :id"
        );
        $cmd->bindValue(
            ":n", $nome
        );
        $cmd->bindValue(
            ":t", $telefone
        );
        $cmd->bindValue(
            ":e", $email
        );
        $cmd->bindValue(
            ":id", $id
        );
        $cmd->execute();
        header("location:index.php");

    }
}