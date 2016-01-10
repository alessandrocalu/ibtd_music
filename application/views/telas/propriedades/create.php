<div id="page-wrapper-add" class="hide">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?php echo $title; ?></h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Basic Form Elements
                </div>
                <div class="panel-body">

                    <?php echo validation_errors(); ?>

                        <?php echo form_open('propriedades/create'); ?>
                        <div class="form-group">
                            <label>Nome</label>
                            <input class="form-control" placeholder="Digite o Nome" name="nome">
                        </div>
                        <div class="form-group">
                            <label>Tabela</label>
                            <input class="form-control" placeholder="Digite o Tabela" name="tabela">
                        </div>

                        <button type="submit" class="btn btn-default">Criar nova Propriedade</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>