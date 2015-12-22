<?php
	require("bdCon.php");
	
	$sucesso=false;
	//parte de inserção de novo usuario
	if(!empty($_GET['login']) && !empty($_GET['Senha'])){
		$sucesso=false;		
		$login = $_GET['login'];
		$senha   = $_GET['Senha'];  	 
		$sql = "INSERT INTO Usuario VALUES ('','$login','$senha')";
		$resultado = $dbh->exec($sql);
		echo("Usuario $login cadastrado com sucesso!");
		$sucesso=true;		
	}
    //parte de inserção de inserção de nova interação
	if(!empty($_GET['usuario_r']) && !empty($_GET['codUsuario']) && !empty($_GET['dataMensagem'])){
		$sucesso=false;
		$cod_usuario_r  = $_GET['usuario_r'];
		$cod_usuario = $_GET['codUsuario']; 	
		$dataMensagem = $_GET['dataMensagem']; 		
		$sqlIteracao="INSERT INTO batepapo_conversa VALUES (NULL,$cod_usuario,$cod_usuario_r,'Padrao','Ola','$dataMensagem')";
		$resultado = $dbh->exec($sqlIteracao);
		echo("Interação de $cod_usuario_r com $cod_usuario cadastrada com sucesso!");
		$sucesso=true;	
	}

	if(!empty($_GET['usuarioRemover'])){
		$sucesso=false;
		$codUsuario=$_GET['usuarioRemover'];
		$dbh->query("DELETE FROM Usuario WHERE cod_usuario = $codUsuario");
		$dbh->query("DELETE FROM batepapo_conversa WHERE cod_usuario_r = $codUsuario OR cod_usuario = $codUsuario");
		echo("Usuario deletado com sucesso!");  
		$sucesso=true;
	}
  
	if(!empty($_GET['usuario_alterar'])){	
		$cod_usuario=$_GET['usuario_alterar'];
		$sucesso=false;
		if(!empty($_GET['novo_UsuarioLogin'])){
			$login = $_GET['novo_UsuarioLogin'];
			$sql = "UPDATE Usuario SET login = '$login' WHERE cod_usuario=$cod_usuario";
			$dbh->exec($sql);
			$sucesso=true;
		}else if(!empty($_GET['novo_UsuarioSenha'])){
			$senha = $_GET['novo_UsuarioSenha'];
			$sql = "UPDATE Usuario SET senha = '$senha' WHERE cod_usuario=$cod_usuario";
			$dbh->exec($sql);
			$sucesso=true;
		} 
		if($sucesso==true){
			echo("Dados do usuario alterados com sucesso!"); 
		}		
			
	}
	if($sucesso==false){		
		echo("Erro, Verifique os campos.");
	}	
  
?>