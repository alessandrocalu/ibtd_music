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
                    Edita Pessoa
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form id="form" action="<?php echo base_url('index.php/pessoas/edit'); ?>" method = "post">
                                <div id="msg_edit"></div>
                                <div class="form-group">
                                    <label>Nome</label>
                                    <input class="form-control" placeholder="Digite o Nome" name="nome" value="<?php echo $pessoa_item['nome']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input class="form-control" placeholder="Digite o Email" name="email" value="<?php echo $pessoa_item['email']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Grupo</label>
                                    <select class="form-control" name="id_grupo">
                                        <option value="0" >Nenhum</option>
                                        <?php foreach ($grupos as $grupo_item): ?>
                                            <option  <?php echo (( $grupo_item['id'] == $pessoa_item['id_grupo'])?'selected':''); ?> value="<?php echo $grupo_item["id"]; ?>" ><?php echo $grupo_item["nome"]; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <input type="hidden" name="id" value="<?php echo $grupo_item['id']; ?>" />
                                <input type="hidden" name="acao" value="gravar" />
                                <button type="submit" class="btn btn-primary">Gravar</button>
                                <button id="btn-voltar" type="button" onclick="voltar()" class="btn btn-default">Voltar</button>                ]
                            </form>
                        </div>
                    </div>        
                </div>    
            </div>
        </div>
    </div>
</div>