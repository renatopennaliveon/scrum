<html>
<head>
<title>SCRUM</title>
<script type="text/javascript" src="<?php echo asset('js/jquery.min.js')?>"></script>
<link rel="stylesheet" href="<?php echo asset('css/bootstrap.min.css')?>" type="text/css">
<script type="text/javascript" src="<?php echo asset('js/bootstrap.min.js')?>"></script>

<script language="javascript">
$(document).ready(function(){
	$('#botao_cadastro').click(function(){
		$.post("{{ Route('cadastrarUsuario') }}",{ '_token':'{{ csrf_token() }}', 'nome' : $('#nome').val(), 'email' : $('#email').val(), 'celular' : 'celular', 'login' : 'login', 'senha' : 'senha', 'papel_scrum' : 'papel_scrum' },function(data){
			console.log(data);
		});
	});
});
</script>
</head>
<body>
<br>
<form>
	<div class="container">
			<div class="row">
				<div class="col-lg-3"><label>Nome</label></div><div class="col-lg-3"><input type="text" id="nome" required="required"></div>
				<div class="col-lg-3"><label>E-mail</label></div><div class="col-lg-3"><input type="email" id="email" required="required"></div>
			</div>
			<div class="row col-lg-12" align="center">
				<button type="button" class="btn btn-primary" id="botao_cadastro">Teste de Cadastro</button>
			</div>
	</div>
</form>
</body>
</html>