@extends("templates.template")

@section("cabecalho", "Séries")

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

    @auth
    <a href="{{ route('form_criar_serie')}}" class="btn btn-dark mb-2">Adicionar</a>
    @endauth

    <ul class="list-group mb-2">

        <li class="list-group-item label-template 
            d-flex justify-content-between align-items-center">
            <span>NOME</span>
            <span>OPÇÕES</span>
        </li>

        @foreach ($series as $serie)
        
            <li class="list-group-item d-flex justify-content-between align-items-center">

                <span id="nome-serie-{{ $serie->serie_id }}">{{ $serie->nome }}</span>

                <div class="input-group w-50" hidden id="input-nome-serie-{{ $serie->serie_id }}">
                    <input type="text" class="form-control" value="{{ $serie->nome }}">
                    <div class="input-group-append">
                        <button class="btn btn-primary" 
                            onclick="seriesController.editarSerie({{ $serie->serie_id }})">
                            <i class="fas fa-check"></i>
                        </button>
                        @csrf
                    </div>
                </div>

                <span class="d-flex align-items-center">
                    @auth
                    <span >
                        
                        <button class="btn btn-primary btn-sm mr-1" 
                            onclick="seriesController.toggleInput({{ $serie->serie_id }})"
                            data-toggle="tooltip" title="Editar nome da série">

                            <i class="fas fa-edit"></i>
                        </button>
                    </span >
                    @endauth
                    
                    <span>
                        <a href="{{ route('listar_temporadas', ['serie_id' => $serie->serie_id]) }}"
                            class="btn btn-info btn-sm mr-1"
                            data-toggle="tooltip" title="Mostrar temporadas">

                            <i class="fas fa-external-link-alt"></i>
                        </a>
                    </span>
                    
                    @auth
                    <form style="margin-top: 15px" method="post" action="{{ route('remover_serie', ['serie_id' => $serie->serie_id]) }}"
                        onsubmit="return confirm('Tem certeza que deseja remover {{ addslashes( $serie->nome )}}?')">
                            @csrf
                            @method('DELETE')
                        <button class="btn btn-danger btn-sm" data-toggle="tooltip" title="Apagar série">
                            <i class="far fa-trash-alt"></i>
                        </button>
                    </form>
                    @endauth
                   
                </span>

            </li>
        @endforeach

    </ul>
@endsection

<script type="text/javascript" src="{{ URL::asset('js/SeriesController.js') }}"></script>
<script>
    let seriesController = new SeriesController();

</script>