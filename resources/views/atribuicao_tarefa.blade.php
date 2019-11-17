<html>
<head>
<title>SCRUM</title>
<script type="text/javascript" src="<?php echo asset('js/jquery.min.js')?>"></script>
<script type="text/javascript" src="<?php echo asset('js/datatables.min.js')?>"></script>
<script type="text/javascript" src="<?php echo asset('js/jquery.mask.min.js')?>"></script>
<script type="text/javascript" src="<?php echo asset('js/bootstrap.min.js')?>"></script>
<link rel="stylesheet" href="<?php echo asset('css/bootstrap.min.css')?>" type="text/css">
<script language="javascript">
function voltar(){
    window.location.replace("{{ Route('listagemUsuarios') }}");
}
function aparecerBotaoAR(id){
    $('#BtnAtribuir'+id).attr('display','block');
    $('#BtnAtribuir'+id).fadeIn('slow');
    $('#BtnRemover'+id).attr('display','block');
    $('#BtnRemover'+id).fadeIn('slow');
    $('#BtnDesatribuir'+id).fadeOut('slow');
    $('#BtnDesatribuir'+id).attr('display','none');
}
function sumirBotaoAR(id,nome){
    $('#BtnAtribuir'+id).fadeOut('slow');
    $('#BtnAtribuir'+id).attr('display','none');
    $('#BtnRemover'+id).fadeOut('slow');
    $('#BtnRemover'+id).attr('display','none');
    $('#BtnDesatribuir'+id).attr('display','block');
    $('#BtnDesatribuir'+id).fadeIn('slow');
    $('#btn_desatribuir'+id).attr('title','Desatribuir esta tarefa de '+nome);
}
function atribuirTarefa(id_tarefa,id_usuario,nome_usuario){
    $.getJSON("/scrum/public/edicaoTarefa/"+id_tarefa, function (data){
        $('#msgRetornoGeral').html('Tarefa "'+data.titulo+'" atribuída com sucesso');
    });
    $.post("{{ Route('atribuirTarefa') }}",{'_token':'{{ csrf_token() }}','id_tarefa' : id_tarefa, 'id_usuario' : id_usuario},function(data){
        $('#msgRetornoGeral').attr('display','block');
        $('#msgRetornoGeral').fadeIn('slow');
        setTimeout("$('#msgRetornoGeral').fadeOut('slow')",4000);
        setTimeout("$('#msgRetornoGeral').attr('display','none')",5000);
    });
    setTimeout("sumirBotaoAR("+id_tarefa+",'"+nome_usuario+"')",0);
    $('#hd_usuario_atribuido').val(nome_usuario);
}
function desatribuirTarefa(id_tarefa,titulo){
    $.getJSON("/scrum/public/edicaoTarefa/"+id_tarefa, function (data){
        $('#msgRetornoGeral').html('Tarefa "'+data.titulo+'" atribuída com sucesso');
    });
    $.post("{{ Route('desatribuirTarefa') }}",{'_token':'{{ csrf_token() }}','id_tarefa' : id_tarefa},function(data){
        $('#msgRetornoGeral').attr('display','block');
        $('#msgRetornoGeral').fadeIn('slow');
        setTimeout("$('#msgRetornoGeral').fadeOut('slow')",4000);
        setTimeout("$('#msgRetornoGeral').attr('display','none')",5000);
        setTimeout("aparecerBotaoAR("+id_tarefa+")",0);
    });
    $('#hd_usuario_atribuido').val('');
}
function edicaoTarefa(id){
	$.getJSON("/scrum/public/edicaoTarefa/"+id, function (data){
		$('#id_tarefa').val(data.id);
		$('#titulo_tarefa_edicao').val(data.titulo);
		$('#desc_tarefa_edicao').val(data.descricao);
	});
}
function removerTarefa(id){
    if(window.confirm("Tem certeza que deseja remover esta tarefa?")){
        $.post("{{ Route('removerTarefa') }}",{'_token':'{{ csrf_token() }}','id' : id},function(data){
            $('#msgRetornoGeral').html('Tarefa removida com sucesso');
            $('#msgRetornoGeral').attr('display','block');
            $('#msgRetornoGeral').fadeIn('slow');
            $('#msgRetornoGeral').attr('role','alert');
            $('#msgRetornoGeral').attr('class','alert alert-danger col-lg-12');
            setTimeout("$('#msgRetornoGeral').fadeOut('slow')",4000);
            setTimeout("$('#msgRetornoGeral').attr('display','none')",5000);
            setTimeout("$('#"+id+"').fadeOut('slow')",2000);
            setTimeout("$('#msgRetornoGeral').attr('class','alert alert-success col-lg-12')",5000);
        });
    }
}
$(document).ready(function(){
	$('#listagem_tarefas').DataTable();
    $('#botao_cadastro_tarefa').click(function(){
        if($('#titulo_tarefa_cadastro').val() != "" && $('#desc_tarefa_cadastro').val() != ""){
            $.post("{{ Route('cadastrarTarefa') }}",{ 
                '_token':'{{ csrf_token() }}',
                'titulo' : $('#titulo_tarefa_cadastro').val(),
                'descricao' : $('#desc_tarefa_cadastro').val() },function(data){
                $('#msgRetornoCadastro').html('Tarefa cadastrada com sucesso.');
                $('#msgRetornoCadastro').attr('display','block');
                $('#msgRetornoCadastro').fadeIn('slow');
                setTimeout("$('#msgRetornoCadastro').fadeOut('slow')",3750);
                setTimeout("$('#msgRetornoCadastro').attr('display','none')",5000);
            });
        }
        else{
            alert("Todos os campos devem ser preenchidos.");
        }
    });
    $('#botao_cancelar_cadastro_tarefa').click(function(){
        $('#modal_cadastro_tarefa').modal('toggle');
        window.location.reload();
    });
    $('#botao_cancelar_edicao_tarefa').click(function(){
        $('#modal_edicao_tarefa').modal('toggle');
    });
	$('#botao_editar_tarefa').click(function(){
	 	$.post("{{ Route('editarTarefa') }}",{
			'_token':'{{ csrf_token() }}', 
			'id' : $('#id_tarefa').val(),
			'titulo' : $('#titulo_tarefa_edicao').val(),
			'descricao' : $('#desc_tarefa_edicao').val()
	 	},function(data){
            $('#titulo'+$('#id_tarefa').val()).html($('#titulo_tarefa_edicao').val());
            $('#descricao'+$('#id_tarefa').val()).html($('#desc_tarefa_edicao').val());
            $('#msgRetornoEdicao').html('Tarefa editada com sucesso.');
            $('#msgRetornoEdicao').attr('display','block');
            $('#msgRetornoEdicao').fadeIn('slow');
			setTimeout("$('#msgRetornoEdicao').fadeOut('slow')",3750);
            setTimeout("$('#msgRetornoEdicao').attr('display','none')",5000);
            console.log('botão editar clicado:\ntítulo: '+$('#titulo_tarefa_edicao').val()+"\ndescrição: "+$('#desc_tarefa_edicao').val());
	 	});
	});
});
</script>
</head>
<body>
    <div class="modal fade modal_cadastro_tarefa" id="modal_cadastro_tarefa" tabindex="-1" role="dialog" data-backdrop="static">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <body>
                    <form id="formulario">
                        <div class="container">
                            <div class="row alert alert-primary" role="alert"><div class="col-lg-12" align="center">Cadastrar Tarefa</div></div>
                            <div class="row">
                                <div class="col-lg-12" align="center"><label><strong>Título:</strong></label>&nbsp;&nbsp;<input type="text" id="titulo_tarefa_cadastro" size="50"></div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12" align="center"><label><strong>Descrição:</strong></label></div>
                                <div class="col-lg-12" align="center"><textarea id="desc_tarefa_cadastro" cols="100" rows="5"></textarea></div>
                            </div>
                            <br>
                            <div class="col-lg-12" align="center">
                                <input type="button" class="btn btn-primary" id="botao_cadastro_tarefa" value="Cadastrar Tarefa">
                                <input type="button" class="btn btn-danger" id="botao_cancelar_cadastro_tarefa" value="Cancelar">
                            </div>
                            <br>
                            <div align="center" class="alert alert-success col-lg-12" role="alert" id="msgRetornoCadastro" style="display: none"></div>
                        </div>
                    </form>
                    </body>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade modal_edicao_tarefa" id="modal_edicao_tarefa" tabindex="-1" role="dialog" data-backdrop="static">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <body>
                    <form id="formulario">
                    	<input type="hidden" id="id_tarefa">
                        <div class="container">
                            <div class="row alert alert-primary" role="alert"><div class="col-lg-12" align="center">Editar Tarefa</div></div>
                            <div class="row">
                                <div class="col-lg-12" align="center"><label><strong>Título:</strong></label>&nbsp;&nbsp;<input type="text" id="titulo_tarefa_edicao" size="50"></div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12" align="center"><label><strong>Descrição:</strong></label></div>
                                <div class="col-lg-12" align="center"><textarea id="desc_tarefa_edicao" cols="100" rows="5"></textarea></div>
                            </div>
                            <br>
                            <div class="col-lg-12" align="center">
                                <input type="button" class="btn btn-primary" id="botao_editar_tarefa" value="Editar Tarefa">
                                <input type="button" class="btn btn-danger" id="botao_cancelar_edicao_tarefa" value="Cancelar">
                            </div>
                            <br>
                            <div align="center" class="alert alert-success col-lg-12" role="alert" id="msgRetornoEdicao" style="display: none"></div>
                        </div>
                    </form>
                    </body>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row alert alert-primary" role="alert"><div class="col-lg-12" align="center">Atribuir Tarefas para <strong>{{ $usuario->nome }}</strong></div></div>
        <p><div class="col-lg-12" align="right"><input type="button" class="btn btn-info" value="Nova Tarefa" data-toggle="modal" data-target="#modal_cadastro_tarefa"></div></p>
        <table id="listagem_tarefas" class="table table-bordered table-striped">
        	<thead>
    			<tr>
                	<th>Título</th>
                	<th>Descrição</th>
                	<th>Ações</th>
            	</tr>
            </thead>
            <tbody>
            	@foreach($tarefas as $tarefa)
            		<tr id="{{ $tarefa->id }}">
            			<td id="titulo{{ $tarefa->id }}" style="width:150px;">{{ $tarefa->titulo }}</td>
            			<td id="descricao{{ $tarefa->id }}"  style="width: 600px;">{{ $tarefa->descricao }}</td>
            			<td style="width: 300px;">
                            @if($tarefa->id_usuario == 0)
                            <span id="BtnAtribuir{{ $tarefa->id }}"><input type="button" class="btn btn-primary" value="Atribuir" title="Atribuir esta tarefa a {{ $usuario->nome }}"  onclick="atribuirTarefa({{ $tarefa->id }},{{ $usuario->id }},'{{ $usuario->nome }}')"></span>
                            @else
                            <span id="BtnAtribuir{{ $tarefa->id }}" style="display : none;"><input type="button" class="btn btn-primary" value="Atribuir" title="Atribuir esta tarefa a {{ $usuario->nome }}"  onclick="atribuirTarefa({{ $tarefa->id }},{{ $usuario->id }},'{{ $usuario->nome }}')"></span>
                            @endif
                            <span id="BtnDesatribuir{{ $tarefa->id }}" @if($tarefa->id_usuario == 0) style="display : none;" @endif><input type="button" id="btn_desatribuir{{ $tarefa->id }}" class="btn btn-danger" value="Desatribuir" title="Desatribuir esta tarefa de {{ $tarefa->Usuario['nome'] }}" onclick="desatribuirTarefa({{ $tarefa->id }},'{{ $tarefa->titulo }}')"></span>&nbsp;
                            <input type="hidden" id="hd_usuario_atribuido" @if(isset($tarefa->Usuario['nome'])) value="{{ $tarefa->Usuario['nome'] }}" @else value="" @endif >
                            <input type="button" class="btn btn-success" value="Editar" title="Editar esta tarefa" data-toggle="modal" data-target="#modal_edicao_tarefa" onclick="edicaoTarefa({{ $tarefa->id }})">&nbsp;
                            @if($tarefa->id_usuario == 0)
                            <span id="BtnRemover{{ $tarefa->id }}"><input type="button" class="btn btn-danger" value="Remover" title="Remover esta tarefa" onclick="removerTarefa({{ $tarefa->id }})"></span>&nbsp;
                            @else
                            <span id="BtnRemover{{ $tarefa->id }}" style="display : none;"><input type="button" class="btn btn-danger" value="Remover" title="Remover esta tarefa" onclick="removerTarefa({{ $tarefa->id }})"></span>&nbsp;
                            @endif
                        </td>
            		</tr>
            	@endforeach
            </tbody>
    	</table>
        <p><div align="center" class="alert alert-success col-lg-12" role="alert" id="msgRetornoGeral" style="display: none"></div></p>
        <div class="col-lg-12" align="center"><input class="btn btn-secondary" type="button" value="Voltar" onclick="voltar()"></div>
    </div></p>
</body>
</html>