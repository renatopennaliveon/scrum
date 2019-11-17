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
	$('#botao_edicao').click(function(){
		if($('#nome').val() != "" && $('#email').val() != "" && $('#celular').val() != "" && $('#login').val() != "" && $('#papel_scrum').val() != ""){
			$.post("{{ Route('editarUsuario') }}",{ 
				'_token':'{{ csrf_token() }}', 
				'id' : $('#id').val(), 
				'nome' : $('#nome').val(), 
				'email' : $('#email').val(), 
				'celular' : $('#celular').val(), 
				'login' : $('#login').val(), 
				'papel_scrum' : $('#papel_scrum').val() },function(data){
				console.log(data);
				$('#msgRetorno').html('Usuário editado com sucesso.');
				$('#msgRetorno').attr('display','block');
				$('#msgRetorno').fadeIn('slow');
				setTimeout("$('#msgRetorno').fadeOut('slow')",3750);
				setTimeout("$('#msgRetorno').attr('display','none')",5000);
			});
		}
		else{
			alert("O preenchimento de todos os campos é obrigatório.");
		}
	});
});
</script>
</head>
<body>
<form>
	<div class="container">
		<div class="row alert alert-primary" role="alert"><div class="col-lg-12" align="center">Edição de Usuário</div></div>
		<input type="hidden" id="id" value="{{ $usuario->id }}">
        <p><div class="col-lg-12" align="right"><input type="button" class="btn btn-success" value="Listagem de Usuários" onclick="listagemUsuario()"></div><br>
		<div class="row">
			<div class="col-lg-3"><label>Nome</label></div><div class="col-lg-3"><input type="text" id="nome" placeholder="Nome" value="{{ $usuario->nome }}" required="required"></div>
			<div class="col-lg-3"><label>E-mail</label></div><div class="col-lg-3"><input type="text" id="email" placeholder="E-mail" value="{{ $usuario->email }}" required="required"></div>
		</div>
		<div class="row">
			<div class="col-lg-3"><label>Celular</label></div><div class="col-lg-3"><input type="text" id="celular" placeholder="Celular" value="{{ $usuario->celular }}" required="required"></div>
			<div class="col-lg-3"><label>Papel Scrum</label></div>
			<div class="col-lg-3">
				<select id="papel_scrum">
				<option value="">Papel Scrum</option>
				<option value="sm" <?php if($usuario->papel_scrum == 'sm'){ echo 'selected'; } ?>>Scrum Master</option>
				<option value="po" <?php if($usuario->papel_scrum == 'po'){ echo 'selected'; } ?>>Product Owner</option>
				<option value="equipe" <?php if($usuario->papel_scrum == 'equipe'){ echo 'selected'; } ?>>Equipe</option>
				</select>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-3"><label>Login</label></div><div class="col-lg-3"><input type="text" id="login" placeholder="Login" value="{{ $usuario->login }}" required="required"></div>
		</div>
		<br>
		<div class="col-lg-12" align="center">
			<input type="button" class="btn btn-primary" id="botao_edicao" value="Editar Usuário">
		</div>
		<br>
		<div align="center" class="alert alert-success col-lg-12" role="alert" id="msgRetorno" style="display: none"></div>
	</div>
</form>
</body>
</html>