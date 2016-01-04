<script>
$('#modal_editar').modal();
select_grupo_edit(<?=$produto->id_grupo; ?>, 0);

</script>

<!-- Modal Grupos de Produtos -->
    <div class="modal fade" id="modal_editar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="post" id="frmUpdateProduto">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Atualização de registro</h4>
                </div>
                <div class="modal-body">  
                    <div id="msg_editar"></div>
                    
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input type="text" name="nome_produto" onblur="nome_produto_edit()" class="form-control" id="nome" value="<?=$produto->nome; ?>" />
                        <div id="msg_valida_nome"></div>
                    </div>
                    <div class="form-group">
                        <label for="desc">Descrição</label>
                        <textarea class="form-control" id="desc" name="descricao"><?=$produto->descricao; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="desc">Tamanho</label>
                        <select class="form-control" name="tamanho">
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
                        <select class="form-control" name="cor">
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
                    <input type="hidden" name="produto" value="<?=$produto->id; ?>" />
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>                    
                    <button type="button" class="btn btn-primary" id="btnCadProduto" onclick="update_produto()">Salvar</button>                    
                </div>
               </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->