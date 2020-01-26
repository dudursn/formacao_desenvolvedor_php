@extends("templates.template")

@section("cabecalho", "Episódios da Temporada " . $temporada->numero)

@section("conteudo")

    @if(isset($mensagem) && isset($tipo_alert))
            
            @component("components.alert")
                @slot("tipo", $tipo_alert)
                @slot("title")
                    Mensagem
                @endslot
                {{ $mensagem }}
            @endcomponent
            
    @endif
    <form action="{{ route('form_episodios_assistidos', ['temporada' => $temporada])}}" method="post">
        @csrf
        <ul class="list-group mb-2">

            <li class="list-group-item label-template 
                d-flex justify-content-between align-items-center">
                <span>NOME</span>
                <span>ASSISTIDOS</span>
            </li>

            @foreach ($temporada->episodios as $episodio)
            
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="#">
                        Episódio {{ $episodio->numero }}
                    </a>

                    @auth
                    <input type="checkbox"  
                        value="{{ $episodio->episodio_id}}"
                        name="episodios[]"
                        {{ ($episodio->assistido) ? 'checked' : '' }} >
                    @endauth

                    @guest
                    <label for=""> {{ ($episodio->assistido) ? 'SIM' : 'NÃO' }}</label>
                    @endguest
                </li>
            @endforeach
        </ul>

       
        <div class="mt-2 d-flex justify-content-between mt-2 mb-2">
			<a href="{{ route('listar_temporadas', ['serie_id' => $temporada->serie->serie_id]) }}">
                <button type="button" class="btn btn-info">Voltar</button>
            </a>
            @auth
			<button type="submit" class="btn btn-primary">Salvar</button>
            @endauth
		</div>
  
        
    </form>
@endsection
