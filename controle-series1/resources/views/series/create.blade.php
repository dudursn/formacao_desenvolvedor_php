@extends("templates.layout")

@section("cabecalho", "Adicionar Séries")

@section("conteudo")

	@if ($errors->any())
		@component("components.alert")
			@slot("tipo", "alert-danger")
			@slot("title", "Erro")
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		
		@endcomponent
	@endif
	
	<form method="post">
		@csrf
		<div class="input-group mb-2">
			<label for="nome">Nome:</label>
			<input type="text" class="form-control" name="nome">
		</div>

		<button type="submit" class="btn btn-primary">Adicionar</button>
		<a href="{{ route('listar_series') }}"><button type="button" class="btn btn-info">Voltar</button></a>

	</form>
@endsection
