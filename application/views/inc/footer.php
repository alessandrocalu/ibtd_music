  </div>
    <!-- /#wrapper -->

    <!-- jQuery Version 1.11.0 -->
    <script src="<?php echo base_url('layout/adm/js/jquery-1.11.0.js'); ?>"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url('layout/adm/js/bootstrap.min.js'); ?>"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url('layout/adm/js/plugins/metisMenu/metisMenu.min.js'); ?>"></script>

    <!-- DataTables JavaScript -->
    <script src="<?php echo base_url('layout/adm/js/plugins/dataTables/jquery.dataTables.js'); ?>"></script>
    <script src="<?php echo base_url('layout/adm/js/plugins/dataTables/dataTables.bootstrap.js'); ?>"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url('layout/adm/js/funcoes.js'); ?>"></script>
    <script src="<?php echo base_url('layout/adm/js/funcoes_produtos.js'); ?>"></script>
   
    
    
    <!-- Modal Grupos de Produtos -->
    <div class="modal fade" id="grupos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Gerência de grupos de produtos</h4>
                </div>
                <div class="modal-body">
                     <a href="javascript:void()" class="btn btn-primary btn-sm" data-toggle="collapse" data-target="#addgrupo" aria-expanded="false" aria-controls="collapseExample">
                        <i class="glyphicon glyphicon-plus"></i> Adicionar Grupo
                    </a>
                    
                    <div class="collapse margin10" id="addgrupo">
                        <div class="well">
                            <form method="post" action="" id="frmCategoria">
                                <div class="form-group">
                                    <label for="nome_grupo">Grupo</label>
                                    <input type="text" name="nome_grupo" id="nome_grupo" class="form-control" />
                                </div>
                                
                                <div class="form-group">
                                    <label for="grupo_pai">Grupo Pai</label>
                                    <div class="select-grupo-add"></div>
                                </div>    
                                
                                <div class="form-group">
                                    <input type="button" id="btnAddCategoria" onclick="add_categoria()" class="btn btn-primary btn-sm" value="Cadastrar" />                                    
                                </div>
                                
                                <div class="form-group">
                                    <div id="msg_grupo"></div>
                                </div>
                                
                            </form>
                        </div>
                    </div>   
                    
                    <div id="msg_grupo2"></div><!--#msg2_cor-->
                    <div id="lista_categorias"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>                    
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
        
    
    <!-- Modal Add Produtos -->
    <div class="modal fade" id="cores" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Cores</h4>
                </div>
                <div class="modal-body">
                    
                    <a href="javascript:void()" class="btn btn-primary btn-sm" data-toggle="collapse" data-target="#addcor" aria-expanded="false" aria-controls="collapseExample">
                        <i class="glyphicon glyphicon-plus"></i> Adicionar Cor
                    </a>
                    
                    <div class="collapse margin10" id="addcor">
                        <div class="well">
                            <form method="post" action="" id="frmCor">
                                <div class="form-group">
                                    <label for="nome_cor">Cor</label>
                                    <input type="text" name="nome_cor" id="nome_cor" class="form-control" />
                                </div>
                                
                                <div class="form-group">
                                    <input type="button" id="btnAddCor" onclick="add_cor()" class="btn btn-primary btn-sm" value="Cadastrar" />                                    
                                </div>
                                
                                <div class="form-group">
                                    <div id="msg_cor"></div>
                                </div>
                                
                            </form>
                        </div>
                    </div>   
                    
                    
                    <div id="msg_cor2" class="margin10"></div><!--#msg2_cor-->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-cores">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th class="col_acoes">Ações</th>                                            
                            </tr>
                        </thead>                                     


                    </table>
                    
                    <div id="results"></div>
                </div>    
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>                    
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    
    <!-- Modal Add Produtos -->
    <div class="modal fade" id="produtos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="post" id="frmProduto">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Cadastrar Produto</h4>
                </div>
                <div class="modal-body">
                    <div id="msg_produto"></div>
                    
                    <div class="form-group">
                        <label for="nome">Nome *</label>
                        <input type="text" onblur="valida_nome()" name="nome_produto" class="form-control" id="nome" />
                        <div id="msg_valida_nome"></div>
                    </div>
                    <div class="form-group">
                        <label for="desc">Descrição</label>
                        <textarea class="form-control" id="desc" name="descricao"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="desc">Tamanho</label>
                        <select class="form-control" name="tamanho">
                            <?php
                                foreach($tamanho as $tm):
                                    echo '<option value="'.$tm->id.'">'.$tm->nome.'</option>';
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
                                    echo '<option value="'.$ln->id.'">'.$ln->nome.'</option>';
                                endforeach;
                            ?>
                        </select>
                    </div>                                       
                    
                    <div class="form-group">
                        <label for="desc">Grupo</label>
                        <div class="select-grupo-add"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="text-left"><small>*Campo obrigatório</small></div>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>                    
                    <button type="button" id="btnCadProduto" class="btn btn-primary" onclick="add_produto()">Cadastrar</button>                    
                </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->