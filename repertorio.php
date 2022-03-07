<?php

    require_once './conexão.php';

    function create($aluno)
    {
        try {
            $con = getConnection();

            $stmt = $con->prepare("INSERT INTO aluno(nome, email) VALUES (:nome, :email)");

            $stmt->bindParam(":email", $aluno->email);
            $stmt->bindParam(":nome", $aluno->nome);

            if ($stmt->execute())
                echo "Aluno cadastrado com sucesso";
        } catch (PDOException $error) {
            echo "Erro ao cadastrar o aluno. Erro: {$error->getMessage()}";
        } finally {
            unset($con);
            unset($stmt);
        }
    }

    function get()
    {
        try {
            $con = getConnection();

            $rs = $con->query("SELECT nome, email FROM aluno");

            while ($row = $rs->fetch(PDO::FETCH_OBJ)) {
                echo $row->nome . "<br>";
                echo $row->email . "<br>";
            }
        } catch (PDOException $error) {
            echo "Erro ao listar os alunos. Erro: {$error->getMessage()}";
        } finally {
            unset($con);
            unset($rs);
        }
    }

    function find($nome)
    {
        try {
            $con = getConnection();
            $stmt = $con->prepare("SELECT nome, email FROM aluno WHERE nome LIKE :nome");
            $stmt->bindValue(":nome", "%{$nome}%");

            if($stmt->execute()) {
                if($stmt->rowCount() > 0) {
                    while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
                        echo $row->nome . "<br>";
                        echo $row->email . "<br>";
                    }
                }
            }
        } catch (PDOException $error) {
            echo "Erro ao buscar o aluno '{$nome}'. Erro: {$error->getMessage()}";
        } finally {
            unset($con);
            unset($stmt);
        }
    }

    function update($aluno)
    {
        try {
            $con = getConnection();

            $stmt = $con->prepare("UPDATE aluno SET nome = :nome, email = :email WHERE id = :codigo");

            $stmt->bindParam(":codigo", $aluno->codigo);
            $stmt->bindParam(":nome", $aluno->nome);
            $stmt->bindParam(":email", $aluno->email);

            if ($stmt->execute())
                echo "Aluno atualizado com sucesso";
        } catch (PDOException $error) {
            echo "Erro ao atualizar o aluno. Erro: {$error->getMessage()}";
        } finally {
            unset($con);
            unset($stmt);
        }
    }

    function delete($codigo)
    {
        try {
            $con = getConnection();

            $stmt = $con->prepare("DELETE FROM aluno WHERE id = ?");
            $stmt->bindParam(1, $codigo);

            if ($stmt->execute())
                echo "Aluno deleto com sucesso";
        } catch (PDOException $error) {
            echo "Erro ao deletar o aluno. Erro: {$error->getMessage()}";
        } finally {
            unset($con);
            unset($stmt);
        }
    }

    ## Teste do create
    // $cidade = new stdClass(); # cria uma classe genérica
    // $cidade->nome = "Rio de Janeiro"; # definição do atributo nome no objeto
    // $cidade->uf = "RJ"; # definição do atributo uf no objeto
    // create($cidade);
    
    // echo "<br><br>---<br><br>";
    
    ## Teste do get
    get();

    echo "<br><br>---<br><br>";
    
    ## Teste do find
    // find("Ca");

    ## Teste do update
    // $cidade = new stdClass();
    // $cidade->nome = "Macaé";
    // $cidade->uf = "RJ";
    // $cidade->codigo = 2;
    // update($cidade);

    ## Teste do delete
    delete(2);

    echo "<br><br>---<br><br>";

    ## Teste do get
    get();