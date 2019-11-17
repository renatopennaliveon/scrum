<html>
<head>
<title>SCRUM</title>
<script type="text/javascript" src="<?php echo asset('js/jquery.min.js')?>"></script>
<script type="text/javascript" src="<?php echo asset('js/jquery.mask.min.js')?>"></script>
<script type="text/javascript" src="<?php echo asset('js/bootstrap.min.js')?>"></script>
<link rel="stylesheet" href="<?php echo asset('css/bootstrap.min.css')?>" type="text/css">

<script language="javascript">
function listagemUsuario(){
    window.location.replace("{{ Route('listagemUsuarios') }}")
}

$(document).ready(function(){
	$('#celular').mask('(99) 99999-9999');
	$('#botao_cadastro').click(function(){
		$.post("{{ Route('cadastrarUsuario') }}",{ 
			'_token':'{{ csrf_token() }}', 
			'nome' : $('#nome').val(), 
			'email' : $('#email').val(), 
			'celular' : $('#celular').val(), 
			'login' : $('#login').val(), 
			'senha' : $('#senha').val(), 
			'papel_scrum' : $('#papel_scrum').val() },function(data){
			console.log(data);
			document.forms[0].reset();
			$('#msgRetorno').html('Usuário cadastrado com sucesso.');
			$('#msgRetorno').attr('display','block');
			$('#msgRetorno').fadeIn('slow');
			setTimeout("$('#msgRetorno').fadeOut('slow')",3750);
			setTimeout("$('#msgRetorno').attr('display','none')",5000);
		});
	});
});
</script>
</head>
<body>
<form>
	<div class="container">
		<div class="row alert alert-primary" role="alert"><div class="col-lg-12" align="center">Cadastro de Usuário</div></div>
        <p><div class="col-lg-12" align="right"><input type="button" class="btn btn-success" value="Listagem de Usuários" onclick="listagemUsuario()"></div><br>
		<div class="row">
			<div class="col-lg-3"><label>Nome</label></div><div class="col-lg-3"><input type="text" id="nome" placeholder="Nome" required="required"></div>
			<div class="col-lg-3"><label>E-mail</label></div><div class="col-lg-3"><input type="text" id="email" placeholder="E-mail" required="required"></div>
		</div>
		<div class="row">
			<div class="col-lg-3"><label>Celular</label></div><div class="col-lg-3"><input type="text" id="celular" placeholder="Celular" required="required"></div>
			<div class="col-lg-3"><label>Papel Scrum</label></div><div class="col-lg-3"><select id="papel_scrum"><option value="">Papel Scrum</option><option value="sm">Scrum Master</option><option value="po">Product Owner</option><option value="equipe">Equipe</option></select></div>
		</div>
		<div class="row">
			<div class="col-lg-3"><label>Login</label></div><div class="col-lg-3"><input type="text" id="login" placeholder="Login" required="required"></div>
			<div class="col-lg-3"><label>Senha</label></div><div class="col-lg-3"><input type="password" id="senha" placeholder="Senha" required="required"></div>
		</div>
		<br>
		<div class="col-lg-12" align="center">
			<input type="button" class="btn btn-primary" id="botao_cadastro" value="Cadastrar Usuário">
		</div>
		<br>
		<div align="center" class="alert alert-success col-lg-12" role="alert" id="msgRetorno" style="display: none"></div>
	</div>
</form>
</body>
</html>