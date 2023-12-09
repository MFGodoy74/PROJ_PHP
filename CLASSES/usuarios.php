<?php

Class Usuario
{
	private $pdo;
	public $msgErro = ""; //ok conexão bem succedida

		public function conectar($nome, $host, $usuario, $senha)
        {
           global $pdo;
           try
           {           	
                $pdo=new PDO("mysql:dbname=".$nome.";host=".$host,$usuario,$senha);
           } catch (PDOException $e) {
	           $msgErro = $e->getmessage();
           }
    }       

	public function cadastrar($nome,$telefone,$email,$senha)
    {
         global $pdo;
         // Verificar se já esta cadastrado
         $sql=$pdo->prepare("SELECT id_usuario FROM usuarios WHERE email=:e");
         $sql->bindValue(":e",$email);
         $sql->execute();
         if($sql->rowcount() >0)
         {
         	return false; //Já esta cadastrado
         }
         else
         {
         	//Caso for falso ou seja não esta cadastrado, cadastrar
         	$sql= $pdo-> prepare("INSERT INTO usuarios (nome,telefone,email,senha) VALUES (:n, :t, :e, :s)");
         	$sql->bindValue(":n",$nome);
         	$sql->bindValue(":t",$telefone);
         	$sql->bindValue(":e",$email);
         	$sql->bindValue(":s",md5($senha));
         	$sql->execute();
         	return true;
         }
         
    }

	public function Logar($mail,$senha)
    {
         global $pdo; 
         // autenticar informações de acesso.

         $sql=$pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :e AND senha =:s");
         $sql->bindValue(":e",$email);
         $sql->bindValue(":s",md5($senha));
         $sql->execute();
         if($sql->rowcount()>0)
         {
          //Acesso permitido (sessão)
         	$dado=$sql->fetch();
         	session_start();
         	$_SESSION['id_usuario']=$dado['id_usuario'];
         	return true; //Cadastrado com sucesso entrada permitida
         }
         else
         {
            return false; //Usuario não cadsatrado! (Acesso negado)
         }
   
    }
}    

?>