@extends("templates.template")

@section("cabecalho", "Adicionar Séries")

@section("conteudo")

	@if ($errors->any())
		@component("components.alert")
			@slot("tipo", "alert-danger")
			@slot("title", "Mensagem")
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		
		@endcomponent
	@endif
	
	<form method="post">
		@csrf
		<div class="row">
			<div class="col col-5">
				<div class="input-group mb-2">
					<label for="nome">Nome:</label>
					<input type="text" class="form-control col-12" name="nome">
				</div>
			</div>

			<div class="col col-3">
				<div class="input-group mb-2">
					<label for="qtd_temporadas">Número de temporadas:</label>
					<input type="number" min="1" class="form-control col-12" name="qtd_temporadas">
				</div>
			</div>

			<div class="col col-3">
				<div class="input-group mb-2">
					<label for="eps_por_temporada">Número de episódios:</label>
					<input type="number" min="1" class="form-control col-12" name="eps_por_temporada">
				</div>
			</div>
		
		</div>

		<div class="mt-2 d-flex justify-content-between">
			<a href="{{ route('listar_series') }}"><button type="button" class="btn btn-info">Voltar</button></a>
			<button type="submit" class="btn btn-primary">Adicionar</button>
		</div>
	

	</form>
@endsection
