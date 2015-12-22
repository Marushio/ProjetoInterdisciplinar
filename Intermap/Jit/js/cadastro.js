function iniciarOpcoes(id){
				$.get( "php/pesquisa_cadastro.php", function( data ) {
					var options = "";
					$.each(data, function(key, value){
						options += '<option value="'+ key +'">' + value + "</option>";
					});
					$( "#"+id ).html( options );
				}, 'json');		
			};
		function cadastrarUsuario(id){			
			var login = $("#usuarioLogin").val();
			var Senha = $("#usuarioSenha").val();			
			$.ajax({
				method: "get",
				url: "php/cadastro.php",
					success: function( data ) {
					$("#mensagemUsuario").html(data);
					document.getElementById("usuarioLogin").value="";
					document.getElementById("usuarioSenha").value="";
					
					iniciarOpcoes(id);
					
				},
				data: {login: login,Senha:Senha},
				error: function(data){
						alert(data);
					}			
			})		
		};
		function cadastrarInteracao(){			
			var usuario_r = $("#usuario_remetente").val();
			var codUsuario = $("#codUsuarioDestino").val();	
			var dataMensagem = $("#data_Mensagem").val();	
			
			$.ajax({
				method: "get",
				url: "php/cadastro.php",
					success: function( data ) {
					
					$("#mensagemInteracao").html(data);
				},
				data: {usuario_r: usuario_r,codUsuario:codUsuario,dataMensagem:dataMensagem},
				error: function(data){
						alert(data);
					}			
			})		
		};
		function removerUsuario(id){			
			var usuarioRemover = $("#usuario_remover").val();
			$.ajax({
				method: "get",
				url: "php/cadastro.php",
					success: function( data ) {					
					$("#mensagemRemocao").html(data);
					iniciarOpcoes(id);
					},
				data: {usuarioRemover: usuarioRemover},
				error: function(data){
						alert(data);
					}			
			})		
		};
		function alterarUsuario(id){	
			var usuario_alterar = $("#usuarioAlterar").val();
			var novo_UsuarioLogin = $("#novoUsuarioLogin").val();
			var novo_UsuarioSenha = $("#novoUsuarioSenha").val();
			$.ajax({
				method: "get",
				url: "php/cadastro.php",
				success: function( data ) {					
					$("#mensagemAlteracao").html(data);	
					iniciarOpcoes(id);
					document.getElementById("novoUsuarioLogin").value="";
					document.getElementById("novoUsuarioSenha").value="";
					},
				data: {novo_UsuarioLogin: novo_UsuarioLogin,
					   novo_UsuarioSenha: novo_UsuarioSenha,
				       usuario_alterar:usuario_alterar},
				error: function(data){
						alert(data);
					}			
			})		
		};