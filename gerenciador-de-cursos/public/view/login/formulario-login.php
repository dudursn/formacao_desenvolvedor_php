
<?php require __DIR__ . "/../inicio-html.php"; 
    use Alura\Cursos\Config\LoginConfig;
?>
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
    <div class="container" style="margin-bottom:50px;">
        <form action="<?= LoginConfig::salvar() ?>" method="post">

            <div class="form-group">
                <label class="col-md-2 control-label" for="txtEmail">E-mail:</label>  
                <div class="col-md-6">
                    <input type="email" name="txtEmail" id="txtEmail" 
                        maxlength="80" placeholder="Digite o email" class="form-control input-md"
                    >
                </div>
            </div> 

            <div class="form-group">
                <label class="col-md-2 control-label" for="txtSenha">Senha:</label>  
                <div class="col-md-6">
                    <input type="password" name="txtSenha" id="txtSenha" 
                        maxlength="80" placeholder="Digite a senha" class="form-control input-md"
                    >
                </div>
            </div> 
            <button type="submit" class="btn btn-primary">Entrar</button>
                
        </form>
    </div>

<?php require __DIR__ . '/../fim-html.php'; ?>



