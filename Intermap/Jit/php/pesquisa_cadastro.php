<?php
	header('Content-Type: application/json');
	require("bdCon.php");

	foreach($dbh->query("SELECT * FROM Usuario") as $linha){
		$cod_usuario  = $linha['cod_usuario'];
		$usuarios[$cod_usuario] = $linha['login'];
	}

	echo json_encode($usuarios);
?>