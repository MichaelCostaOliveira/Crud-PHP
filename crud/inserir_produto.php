<?php
session_start();
    if(!$_SESSION['logado']/*=TRUE*/){
        header('location: index.php');
    }else{
    include_once("conexao.php");
    
    extract($_POST);


   if(empty($produto || $valor || $imagem)){
   $_SESSION['pree'] = "<p style='color:red;'>Por favor preencha todos os campos1!</p>";
    header("Location: produtos.php");
      }else if(empty($produto && $valor || $imagem)){
            $_SESSION['pree'] = "<p style='color:red;'>Por favor preencha todos os campos3!</p>";
            header("Location: produtos.php");
            }else if(empty($produto || $valor && $imagem)){
                $_SESSION['pree'] = "<p style='color:red;'>Por favor preencha todos os campos4!</p>";
                header("Location: produtos.php");
                }

   else{


	$imgBanco = $_FILES['imagem']['name'];
    $caminhoPasta = "C:\wamp64\www\Teste\crud\imagen\\".$_FILES['imagem']['name'];
    

  
	 $i = move_uploaded_file($_FILES['imagem']['tmp_name'], $caminhoPasta );

        if($i == 1){



            $inserir_produto = "INSERT INTO produtos(nome, valor, imagem) VALUES ('".$produto. "', '".$valor."','".$imgBanco."')";
            $insert = mysqli_query($conn, $inserir_produto);
            header("location: produtos.php");
        }
        $_SESSION['pree'] = "<p style='color:green;'>Produto adicionado com sucesso!</p>";
                header("Location: produtos.php");
                
    }
};
?>

