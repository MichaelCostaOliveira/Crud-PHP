<?php
session_start();
include_once("conexao.php");
extract($_POST);
if(isset($nome)&& isset($senha)){

    $sql = "select * from crud_inserir where nome = '$nome' and senha ='$senha'";
    $rs = mysqli_query($conn,$sql);
        if(mysqli_num_rows($rs)>0){
          
        $_SESSION['logado']=TRUE;
        if($lembrar){
            setcookie('nome', $nome ,time()+1*10*1);
            setcookie('senha',$senha, time()+1*10*1);
            setcookie('lembrar',TRUE, time()+1*10*1);
        }else{
            setcookie('nome', null);
            setcookie('senha', null);
            setcookie('lembrar', null);
        }
            header('location: produtos.php');
        }else{
             $_SESSION['mssa'] = "<p style='color:red;'>Nome ou Senha incorretos</p>";
        header("Location: logar.php");
    }
}