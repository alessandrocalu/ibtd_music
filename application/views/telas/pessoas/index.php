
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?php echo $title; ?></h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div id="msg_modal"></div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Listagem de Pessoas
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-lista">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Grupo</th>    
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($pessoas as $pessoa_item): ?>
                                <tr>
                                    <td><?php echo $pessoa_item['id']; ?></td>
                                    <td><?php echo $pessoa_item['nome']; ?></td>
                                    <td><?php echo $pessoa_item['email']; ?></td>
                                    <td><?php echo $pessoa_item['grupo']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-6 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->