<?php
	header('Content-Type: application/json');
 
  
	require("bdCon.php");

	//$dbh = new PDO('pgsql:host=localhost;port=5432;dbname=intermapBD', 'postgres', '');
	
	
	
    //vetor Nós
	$json=array();		
	//Busca por todos os usuarios cadastrados
	$sqlUser = 'SELECT * FROM Usuario';	
	// para cada tupla da tababela usuario
	foreach($dbh->query($sqlUser) as $linhaUser){			
		$codUsuario=$linhaUser['cod_usuario'];
		$loUsuario=$linhaUser['login'];
		//vetor com nós que sairam da mesma fonte 
		$adjacencies=array();			
		//Busca por todos os registros de bate papo por usuario remetente
		$sql = "SELECT * FROM Batepapo_conversa WHERE cod_usuario_r = '$codUsuario'";
		foreach($dbh->query($sql) as $linha){				
			array_push($adjacencies,
					 //variaveis da tabela Batepapo_conversa
					array('nodeTo' => $linha['cod_usuario'],					   
						'nodeFrom' => $linha['cod_usuario_r'],
							 'data'=>array(
										 '$color'=> '#909291',
										) 
						)
			);	
		}		
		//adicioando valores ao vetor  Nós
		array_push($json,
					array('adjacencies'=>$adjacencies,
								'data'=>array(
											'$color'=>'#83548B',
											'$type'=>'circle',
											'$dim'=>10
										),
								'id'=>$codUsuario,
								'name'=>$loUsuario
					)	
		);
	}
	
		
	echo json_encode($json);
		
?>
