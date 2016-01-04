<script>
$('#modal_del_grupo').modal();
select_grupo_edit(<?=$grupo->id_grupo_pai; ?>, 0);

$(document).ready(function(){
    $('#grupo_pai').attr('disabled', 'true');    
});
</script>

    <!-- Modal Grupos de Produtos -->
    <div class="modal fade" id="modal_del_grupo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" style="z-index: 9999">
        <div class="modal-dialog">
            <div class="modal-content">                
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Desativar Grupo</h4>
                </div>
                <div class="modal-body">  
                    <div id="msg_editar"></div>
                    <p>Deseja realmente desativar o grupo abaixo?</p>
                    <div class="form-group">
                        <label for="nome">Grupo</label>
                        <input type="text" name="nome_produto" class="form-control" id="nome" value="<?=$grupo->nome; ?>" disabled />
                    </div>                    
                    <div class="form-group">
                        <label for="desc">Grupo Pai</label>
                        <div class="select-grupo"></div>
                    </div>
                    
                </div>
                <div class="modal-footer">                    
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>                                                          
                    <button type="button" class="btn btn-danger" onclick="excluir_categoria(<?=$grupo->id; ?>)" data-dismiss="modal">Desativar grupo</button>                                                          
                </div>
               </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->