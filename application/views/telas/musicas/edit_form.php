<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Editar Música</h4>
            </div>
            <div class="modal-body">

                <form id="frmModalEdit" action="" method = "post">
                    <div id="msg_edit"></div>
                    <div class="form-group">
                        <label>Nome</label>
                        <input class="form-control" placeholder="Digite o Nome" name="nome" value="<?php echo $musica_item['nome']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Autor</label>
                        <input class="form-control" placeholder="Digite o Autor" name="autor" value="<?php echo $musica_item['autor']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Palavras</label>
                        <input class="form-control" placeholder="Digite palavras da letra" name="palavras" value="<?php echo $musica_item['palavras']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Link da Letra</label>
                        <input class="form-control" placeholder="Digite o Link da Letra" name="link_letra" value="<?php echo $musica_item['link_letra']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Link da Vídeo</label>
                        <input class="form-control" placeholder="Digite o Link do Vídeo" name="link_video" value="<?php echo $musica_item['link_video']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Link da Cifra</label>
                        <input class="form-control" placeholder="Digite o Link da Cifra" name="link_cifra" value="<?php echo $musica_item['link_cifra']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Link DataShow</label>
                        <input class="form-control" placeholder="Digite o Link DataShow" name="link_datashow" value="<?php echo $musica_item['link_datashow']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Grupo</label>
                        <select class="form-control" name="id_grupo">
                            <option value="0" >Nenhum</option>
                            <?php foreach ($grupos as $grupo_item): ?>
                                <option  <?php echo (( $grupo_item['id'] == $musica_item['id_grupo'])?'selected':''); ?> value="<?php echo $grupo_item["id"]; ?>" ><?php echo $grupo_item["nome"]; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id" value="<?php echo $musica_item['id']; ?>" />
                        <button type="button" class="btn btn-primary" name="salvar" value="salvar" onclick="update_modal()">Gravar</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal" >Voltar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>