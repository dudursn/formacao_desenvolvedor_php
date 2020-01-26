@extends("templates.layout")

@section("cabecalho", "Séries")

@section("conteudo")
    @if(isset($mensagem) && isset($tipo_alert))
            
            @component("components.alert")
                @slot("tipo", $tipo_alert)
                @slot("title")
                    Erro
                @endslot
                {{ $mensagem }}
            @endcomponent
            
    @endif

    <a href="{{ route('form_criar_serie')}}" class="btn btn-dark mb-2">Adicionar</a>

    <ul class="list-group">

        @foreach ($series as $serie)
            <li class="list-group-item d-flex justify-content-between align-items-center"> {{ $serie->nome }} 
            <form method="post" action="{{ route('remover_serie', ['serie_id' => $serie->serie_id]) }}"
                onsubmit="return confirm('Tem certeza que deseja remover {{ addslashes( $serie->nome )}}?')">
                    @csrf
                    @method('DELETE')
                <button class="btn btn-danger btn-sm">
                    <i class="far fa-trash-alt"></i>
                </button>
            </form>
            </li>
        @endforeach

    </ul>
@endsection
