<script>
$('#modal_del_prod').modal();
select_grupo_edit(<?=$produto->id_grupo; ?>, 1);

</script>

<!-- Modal Grupos de Produtos -->
    <div class="modal fade" id="modal_del_prod" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
        <div class="modal-dialog">
            <div class="modal-content">                
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Desativar produto</h4>
                </div>
                <div class="modal-body">  
                    <div id="msg_editar"></div>
                    <p>deseja realmente desativar o produto abaixo?</p>
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input type="text" name="nome_produto" class="form-control" id="nome" value="<?=$produto->nome; ?>" disabled />
                    </div>
                    <div class="form-group">
                        <label for="desc">Descrição</label>
                        <textarea class="form-control" id="desc" name="descricao" disabled><?=$produto->descricao; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="desc">Tamanho</label>
                        <select class="form-control" name="tamanho" disabled>
                            <?php                                
                                foreach($tamanho as $tm):
                                   if($tm->id === $produto->id_tamanho){ 
                                       $selectTm = 'selected';                                        
                                   }else{
                                       $selectTm = "";
                                   }
                                   echo '<option value="'.$tm->id.'" '.$selectTm.'>'.$tm->nome.'</option>';
                                endforeach;
                            ?>                            
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="desc">Cor</label>
                        <select class="form-control" name="cor" disabled>
                            <option value="">Selecione a cor</option>
                            <?php                            
                                foreach($cores as $ln):
                                    if($ln->id === $produto->id_cor){ 
                                        $selectCor = 'selected';                                         
                                    }else{
                                        $selectCor = '';
                                    }
                                    echo '<option value="'.$ln->id.'" '.$selectCor.'>'.$ln->nome.'</option>';
                                endforeach;
                            ?>
                        </select>
                    </div>                                       
                    
                    <div class="form-group">
                        <label for="desc">Grupo</label>
                        <div class="select-grupo"></div>
                    </div>
                    
                </div>
                <div class="modal-footer">                    
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>                                                          
                    <button type="button" class="btn btn-danger" onclick="excluir_produto(<?=$produto->id; ?>)" data-dismiss="modal">Desativar produto</button>                                                          
                </div>
               </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->