
<?php require __DIR__ . '/../inicio-html.php'; ?>
    <?php 
        if(isset($_SESSION["msg"] )){
    ?>
             <!--Erro -->
            <div class="col-md-12">
                <label for=""></label>
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Fechar"><span aria-hidden="true">×</span>
                    </button>
                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true">
                    </span>
                    <span class="sr-only">Erro:</span><?php echo $_SESSION["msg"] ?>.
                </div>
            </div>
    <?php 
            unset($_SESSION["msg"] );
        }
    ?>

    <div class="jumbotron">
        <h1><?php echo $titulo ?></h1>
    </div>
    <form action="salvar-curso" method="post">
        <div class="form-group">
            <label class="col-md-2 control-label" for="txtDescricao">Descrição:</label>  
            <div class="col-md-12">
                <input type="text" name="txtDescricao" id="txtDescricao" 
                    maxlength="80" placeholder="Nome" class="form-control input-md">
            </div>
            <br>
        </div> 
        <button type="submit" class="btn btn-info">Salvar</button>
            
        <a href="listar-cursos">
            <button type="button" id="btnVoltar" name="btnVoltar" class="btn btn-default">
                Voltar
            </button>
        </a>
    </form>

<?php require __DIR__ . '/../fim-html.php'; ?>