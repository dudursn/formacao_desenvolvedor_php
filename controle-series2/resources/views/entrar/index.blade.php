@extends("templates.template")

@section("cabecalho", "Login")

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

    <form action="{{ route('entrar') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" name="email" id="email" required class="form-control">
        </div>

        <div class="form-group">
            <label for="password">Senha</label>
            <input type="password" name="password" id="password" required min="1" class="form-control">
        </div>
     

        <button type="submit" class="btn btn-primary mt-3">
            Entrar
        </button>

        <a href="{{ route('form_registrar') }}" class="btn btn-secondary mt-3">
            Registrar-se
        </a>
    </form>

@endsection