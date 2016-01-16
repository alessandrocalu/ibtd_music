<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Editar Grupo</h4>
            </div>
            <div class="modal-body">

                <form id="frmModalEdit" action="" method = "post">
                    <div id="msg_edit"></div>
                    <div class="form-group">
                        <label>Nome</label>
                        <input class="form-control" placeholder="Digite o Nome" name="nome" value="<?php echo $grupo_item['nome']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status">
                            <option value="0" <?php echo ($grupo_item['status'] != 1?' selected':''); ?> >Inativo</option>
                            <option value="1" <?php echo ($grupo_item['status'] == 1?' selected':''); ?> >Ativo</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id" value="<?php echo $grupo_item['id']; ?>" />
                        <button type="button" class="btn btn-primary" name="salvar" value="salvar" onclick="update_modal()">Gravar</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal" >Voltar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>