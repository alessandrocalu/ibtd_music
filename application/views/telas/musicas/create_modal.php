<!-- Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Adicionar Música</h4>
            </div>
            <div class="modal-body">

                <form id="frmModalAdd" action="" method = "post">
                    <div id="msg_add"></div>
                    <div class="form-group">
                        <label>Nome</label>
                        <input class="form-control" placeholder="Digite o Nome" name="nome" required>
                    </div>
                    <div class="form-group">
                        <label>Autor</label>
                        <input class="form-control" placeholder="Digite o Autor/Banda" name="autor" required>
                    </div>
                    <div class="form-group">
                        <label>Palavras</label>
                        <input class="form-control" placeholder="Digite palavras da letra" name="palavras" required>
                    </div>
                    <div class="form-group">
                        <label>Link Letra</label>
                        <input class="form-control" placeholder="Digite o Link Letra" name="link_letra" required>
                    </div>
                    <div class="form-group">
                        <label>Link Vídeo</label>
                        <input class="form-control" placeholder="Digite o Link Vídeo" name="link_video" required>
                    </div>
                    <div class="form-group">
                        <label>Link Cifra</label>
                        <input class="form-control" placeholder="Digite o Link Cifra" name="link_cifra" required>
                    </div>
                    <div class="form-group">
                        <label>Link DataShow</label>
                        <input class="form-control" placeholder="Digite o Link DataShow" name="link_datashow" required>
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
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" name="salvar" value="salvar" onclick="add_modal()">Gravar</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal"  onclick="clear_form_add()" >Voltar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>