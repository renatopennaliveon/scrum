<html>
<head>
<title>SCRUM</title>
<script type="text/javascript" src="<?php echo asset('js/jquery.min.js')?>"></script>
<script type="text/javascript" src="<?php echo asset('js/datatables.min.js')?>"></script>
<script type="text/javascript" src="<?php echo asset('js/jquery.mask.min.js')?>"></script>
<script type="text/javascript" src="<?php echo asset('js/bootstrap.min.js')?>"></script>
<link rel="stylesheet" href="<?php echo asset('css/bootstrap.min.css')?>" type="text/css">

<script language="javascript">
function removerUsuario(id){
    if(window.confirm("Tem certeza que deseja remover este usuário?")){
        $.post('{{ Route('removerUsuario') }}',{
            '_token':'{{ csrf_token() }}', 
            'id' : id
        },function(data){
            if(data){
//                $('#'+id).html('');
                alert('Usuário removido com sucesso.');
                window.location.reload();
            }
        });
    }
}

function atribuirTarefa(id){
    window.location.replace("/scrum/public/atribuicaoTarefa/"+id);
}

function edicaoUsuario(id){
    window.location.replace("/scrum/public/edicaoUsuario/"+id);
}

function cadastroUsuario(){
    window.location.replace("{{ Route('cadastroUsuario') }}");
}
$(document).ready(function(){
	 $('#listagem_usuario').DataTable();
});
</script>
</head>
<body>
    <div class="container">
        <div class="row alert alert-primary" role="alert"><div class="col-lg-12" align="center">Listagem de Usuários</div></div>
        <p><div class="col-lg-12" align="right"><input type="button" class="btn btn-success" value="Cadastro de Usuário" onclick="cadastroUsuario()"></p>
        <table id="listagem_usuario" class="table table-bordered table-striped">
        	<thead>
    			<tr>
                	<th> Nome </th>
                	<th> E-mail </th>
                	<th> Papel Scrum </th>
                	<th>Ações</th>
            	</tr>
            </thead>

            <tbody>
            	@foreach($usuarios as $usuario)
            		<tr id="{{ $usuario->id }}">
            			<td>{{ $usuario->nome }}</td>
            			<td>{{ $usuario->email }}</td>
            			<td>{{ $usuario->papel_scrum }}</td>
            			<td>
                            @if($usuario->papel_scrum == "Equipe")
                            <input type="button" class="btn btn-primary" value="Atribuir Tarefas" onclick="atribuirTarefa(<?= $usuario->id ?>)">
                            &nbsp;&nbsp;&nbsp;
                            @endif
                            <input type="button" class="btn btn-success" value="Editar" onclick="edicaoUsuario(<?= $usuario->id ?>)">
                            &nbsp;&nbsp;&nbsp;
                            <input type="button" class="btn btn-danger" value="Remover" onclick="removerUsuario(<?= $usuario->id ?>)">
                        </td>
            		</tr>
            	@endforeach
            </tbody>
    	</table>
    </div></p>
</body>
</html>