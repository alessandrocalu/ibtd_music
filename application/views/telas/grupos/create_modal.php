<!-- Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Adicionar Grupo</h4>
            </div>
            <div class="modal-body">

                <form id="frmModalAdd" action="" method = "post">
                    <div id="msg_add"></div>
                    <div class="form-group">
                        <label>Nome</label>
                        <input class="form-control" placeholder="Digite o Nome" name="nome" required>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status">
                            <option value="0" >Inativo</option>
                            <option value="1" >Ativo</option>
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