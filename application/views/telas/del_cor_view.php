<script>
$('#modal_del_cor').modal();

</script>

<!-- Modal Grupos de Produtos -->
    <div class="modal fade" id="modal_del_cor" tabindex="2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" style="z-index: 99999">
        <div class="modal-dialog">
            <div class="modal-content">                
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Desativar Cor</h4>
                </div>
                <div class="modal-body">  
                    <div id="msg_editar"></div>
                    <p>Deseja realmente desativar a cor abaixo?</p>
                    <div class="form-group">
                        <label for="nome">Cor</label>
                        <input type="text" name="nome_cor" class="form-control" id="nome" value="<?=$cor->nome; ?>" disabled />
                    </div>
                    
                </div>
                <div class="modal-footer">                    
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>                                                          
                    <button type="button" class="btn btn-danger" onclick="excluir_cor(<?=$cor->id; ?>)" data-dismiss="modal">Desativar cor</button>                                                          
                </div>
               </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->