<?php require __DIR__ . '/../inicio-html.php'; 
    use Alura\Cursos\Config\CursoConfig;

?>
    
    <div class="jumbotron">
        <h1><?php echo $titulo ?></h1>
    </div>
    <div class="container" style="margin-bottom:50px;">
        <?php 
            if(isset($_SESSION["msg"] )){
        ?>
                <!--Erro -->
                <div class="col-md-12">
                    <label for=""></label>
                    <div class="alert <?= $_SESSION["alert"] ?> alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Fechar"><span aria-hidden="true">×</span>
                        </button>
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true">
                        </span>
                        <span class="sr-only">Erro:</span><?php echo $_SESSION["msg"] ?>
                    </div>
                </div>
        <?php 
                unset($_SESSION["msg"] );
                unset($_SESSION["alert"] );
            }
        ?>
        <a href="<?= CursoConfig::novo() ?>" class="btn btn-primary md-2" style="margin-bottom:25px;">Novo Curso</a>
        <ul class="list-group">
            <?php foreach ($cursos as $curso): ?>
                <li class="list-group-item">
                    <?= "Id: {$curso->getId()} - Descrição: {$curso->getDescricao()}"; ?>
                
                    <a href="<?= CursoConfig::apagar( $curso->getId() )?>">
                        <button class="btn btn-danger btn-sm" style="float:right; margin-left:5px;">Delete</button>
                    </a>
                    <a href="<?= CursoConfig::editar( $curso->getId() )?>">
                        <button class="btn btn-info btn-sm" style="float:right;">Editar</button>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

<?php require __DIR__ . '/../fim-html.php'; ?>
