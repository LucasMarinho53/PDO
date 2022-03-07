<?php
    require_once('.\conexão.php');

    function fnAddAluno($nome, $email) {
        
        $link = getConnection();
        $query = "insert into aluno(nome, email) values ('{$nome}', '{$email}')";
        $result = mysqli_query($link, $query);

        if(!$result) {
            throw new \Exception("Error ao gravar no banco", 1);
            return false;
        }
        return true;
    }

    function fnListAlunos()
    {
        $link = getConnection();
        $query = "select * from aluno";
        $result = mysqli_query($link, $query);
        $alunos = array();

        while($row = mysqli_fetch_assoc($result))
        {
            array_push($aluno, $row);
        }
        return $aluno;
    }


