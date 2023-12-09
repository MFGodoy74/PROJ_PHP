<?php
require_once'CLASSES/usuarios.php';
$u = new Usuario;
?>
<html lang="pt-br">
<head>
   <meta charset="utf-8"/>
   <title>Projeto Login</title>
   <link rel="stylesheet" href="CSS/estilo.css">
</head>
<body>
<div id="corpo-form">
    <h1>Cadastrar</h1>
  <form method="post">
   <input type="Nome" name="nome"placeholder="Nome Completo" maxlength="30">
   <input type="telefone" name="telefone"placeholder="telefone" maxlength="30">
   <input type="email" name="email"placeholder="Usuário" maxlength="30"> 
	 <input type="passoword" name="senha"placeholder="Senha"maxlength="15">
   <input type="passoword" name="ConfSenha"placeholder="Confirmar Senha"maxlength="15">
	 <input type="submit" value="Cadastrar">
	 </form>
	 </div>

   <?php
   //Verificar se clicou no botão
   if(isset($_POST['nome']))
  {
        $nome = $_POST['nome'];
        $telefone = $_POST['telefone'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $ConfirmarSenha = $_POST['ConfSenha'];
        //verificar campo nulo
        if (!empty($nome)&& !empty($telefone)&& !empty($email)&& !empty($senha)&& !empty($ConfirmarSenha))
      {
            $u->conectar("projeto_coletas","localhost","root","Paranagua26");
               if($u->msgErro =="") //se esta tudo ok
            {
              if ($senha == $ConfirmarSenha)
              {
                  if($u->Cadastrar($nome,$telefone,$email,$senha))                  
                  {
                     echo "cadastrado com sucesso";
                  }
                  else
                  {
                     echo "Email cadastrado";
                  }
              }  
               else
               {
                echo"A senha confirmada não corresponde com a nova senha";
               }
            }
            else
            {
              echo "Erro:".$u->msgErro;
            }  

      } else 
      {
        echo"Favor preencher todos os campos";
      }    

      }

      ?>
  

</body>
</html>
