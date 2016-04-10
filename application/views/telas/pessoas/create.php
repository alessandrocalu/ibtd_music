<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?php echo $title; ?></h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div id="msg_modal"></div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Nova Pessoa
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form id="form" action="<?php echo base_url('index.php/pessoas/create'); ?>" method = "post">
                                <div id="msg_add"></div>
                                <div class="form-group">
                                    <label>Nome</label>
                                    <input class="form-control" placeholder="Digite o Nome" name="nome" required>
                                </div>
                                <div class="form-group">
                                    <label>Autor</label>
                                    <input class="form-control" placeholder="Digite o Email" name="email" required>
                                </div>
                                <div class="form-group">
                                    <label>Grupo</label>
                                    <select class="form-control" name="id_grupo">
                                        <option value="0" >Nenhum</option>
                                        <?php foreach ($grupos as $grupo_item): ?>
                                            <option value="<?php echo $grupo_item["id"]; ?>" ><?php echo $grupo_item["nome"]; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <input type="hidden" name="acao" value="gravar" />
                                <button type="submit" class="btn btn-primary">Gravar</button>
                                <button id="btn-voltar" type="button" onclick="voltar()" class="btn btn-default">Voltar</button>
                            </form>
                        </div>
                    </div>        
                </div>    
            </div>
        </div>
    </div>
</div>