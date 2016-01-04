        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Produtos</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Produtos cadastrados
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="text-left margin10">
                                    <a href="javascript:void()" title="Adicionar produto" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#produtos">Adicionar produto</a>
                                    <a href="javascript:void()" title="Gerenciar grupos de produtos" class="btn btn-info btn-sm" data-toggle="modal" data-target="#grupos">Grupos de Produtos</a>                                
                                    <a href="javascript:void()" title="Gerenciar grupos de cores" class="btn btn-info btn-sm" data-toggle="modal" data-target="#cores">Cores</a>                                
                            </div><!--.row-->
                            
                            
                            <div class="table-responsive">
                                <div id="msg_produto2"></div>
                               <?php echo ($this->session->flashdata('msg')) ? $this->session->flashdata('msg') : '';?>
                                
                                <table class="table table-striped table-bordered table-hover" id="dataTables-produtos">
                                    <thead>
                                        <tr>
                                            <th width="20">ID</th>
                                            <th>Nome</th>
                                            <th class="col_acoes">Ações</th>                                            
                                        </tr>
                                    </thead>                                     
                                    
                                    
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                            
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->            
            
        </div>
        <!-- /#page-wrapper -->

  