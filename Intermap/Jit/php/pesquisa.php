<?php
	header('Content-Type: application/json');
 
  
	require("bdCon.php");

	//$dbh = new PDO('pgsql:host=localhost;port=5432;dbname=intermapBD', 'postgres', '');
	
	
	
    //vetor Nós
	$json=array();	
	
    $sqlUser = 'SELECT * FROM Usuario';
	// para cada tupla da tababela usuario
	foreach($dbh->query($sqlUser) as $linhaUser){			
		$codUsuario=$linhaUser['cod_usuario'];
		$loUsuario=$linhaUser['login'];
		//vetor com nós que sairam da mesma fonte 
		$adjacencies=array();			
		//Busca por todos os registros de bate papo por usuario remetente
		//logica para usar os filtros de data
		if(!empty($_GET['dataInicio']) && !empty($_GET['dataFim'])){			
			$dataInicio   = $_GET['dataInicio'];
			$dataFim   = $_GET['dataFim'];
			if(strtotime($dataInicio)<=strtotime($dataFim)){
					
				//Busca pela data especifica
				$sql = "SELECT * FROM batepapo_conversa WHERE cod_usuario = '$codUsuario' AND data_mensagem BETWEEN '$dataInicio' AND '$dataFim'";	
			}else{
				
				echo("ErroForçado xD");
			}
			
		}else{	
			//Busca por todas as interações cadastradas
			$sql = "SELECT * FROM Batepapo_conversa WHERE cod_usuario = '$codUsuario'";
		}
		
		foreach($dbh->query($sql) as $linha){				
			array_push($adjacencies,
					 //variaveis da tabela Batepapo_conversa
					array('nodeTo' => $linha['cod_usuario_r'],					   
						'nodeFrom' => $linha['cod_usuario'],
							 'data'=>array(
										 '$color'=> '#909291',
									
										) 
						)
			);	
		}		
		//adicioando valores ao vetor  Nós
		//if(!empty($adjacencies)){
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
	/*	}else{
			array_push($json,
						array('adjacencies'=>$adjacencies,
							'data'=>array(
										'$color'=>'#909291'										
									),
							'id'=>$codUsuario,
							'name'=>$loUsuario	
						)	
			);
			
		}*/
	}
	
		
	echo json_encode($json);
		
?>
