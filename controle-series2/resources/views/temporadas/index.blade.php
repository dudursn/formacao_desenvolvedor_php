@extends("templates.template")

@section("cabecalho", "Temporadas de " . $serie->nome)

@section("conteudo")
    <ul class="list-group mb-2">

        <li class="list-group-item label-template 
            d-flex justify-content-between align-items-center">
            <span>NOME</span>
            <span>ASSISTIDOS/TOTAL</span>
        </li>

        @foreach ($temporadas as $temporada)
        
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <a href="{{ route('listar_episodios', ['temporada' => $temporada]) }}">
                    Temporada {{ $temporada->numero }}
                </a>
                <span class="badge badge-secondary">
                    {{ $temporada->getEpisodiosAssistidos()->count(). '/' . $temporada->episodios->count()}}
                </span>
            </li>
        @endforeach

    </ul>

    <div class="mt-2 d-flex justify-content-between mt-2 mb-2">
        <a href="{{ route('listar_series')}}"><button type="button" class="btn btn-info">Voltar</button></a>
        <span></span>
    </div>
@endsection
