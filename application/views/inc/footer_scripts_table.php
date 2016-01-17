<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script>


    var table = '';
    $(document).ready(function() {

        <?php if (isset($tipoTable) && ($tipoTable == 'tree')){ ?>
            $("#dataTables-lista").treeFy({
                        treeColumn: 1
                    });
        <?php } ?>
            table = $('#dataTables-lista').DataTable({
                responsive: true,
                language: {
                    lengthMenu: 'Mostrar _MENU_ registros',
                    search: 'Buscar: ',
                    info: 'Mostrando _START_ de _END_ de _TOTAL_ registros.',
                    infoFiltered: '(_MAX_ registro(s) filtrados)',
                    infoEmpty: 'Nenhum registro encontrado',
                    emptyTable: 'Nenhum registro encontrado',
                    paginate: {
                        previous: 'Anterior',
                        next: 'Próximo'
                    },
                    zeroRecords: 'Nenhum registro encontrado',
                    thousands: '.',
                    decimal: '',
                    loadingRecords: "Carregando...",
                    processing: 'Processando...'
                }
        <?php if (isset($tipoTable) && ($tipoTable == 'tree')){ ?>
                ,
                ordering: false

        <?php } else { ?>
                ,
                order: [[ 1, 'asc' ]],
                columnDefs: [
                    {
                        searchable: false,
                        orderable: false,
                        width: 30,
                        targets: 0
                    }
                ],
                <?php echo  $columns.',' ?>
                ajax: './<?php echo $controller; ?>/lista_json'

        <?php } ?>

            });
    });

    $('#dataTables-lista').on( 'draw.dt', function () {
        if ($('#dataTables-lista_length').parent().hasClass('col-sm-6')) {
            $('#dataTables-lista_length').parent().removeClass('col-sm-6');
            $('#dataTables-lista_length').parent().addClass('col-sm-4');

            $('#dataTables-lista_filter').parent().removeClass('col-sm-6');
            $('#dataTables-lista_filter').parent().addClass('col-sm-4');

            //Adiciona button para chamar Adiçao de registro
            $('#dataTables-lista_filter').parent().parent().append("<div class='col-sm-4'> <button class='btn btn-primary pull-right' data-target='#addModal' data-toggle='modal' >Incluir registro</button></div>");
        }
    });

    $('#dataTables-lista tbody').on( 'click', 'tr', function () {
        <?php if (isset($tipoTable) && ($tipoTable == 'tree')){ ?>
            edit_modal( table.row( this ).data()[0] );
        <?php } else { ?>
            edit_modal( table.row( this ).data().id );
        <?php } ?>
    } );


    function add_modal(){

        var dados = $('#frmModalAdd').serialize();

        $.ajax({
            type: 'POST',
            data: dados,
            url: './<?php echo $controller; ?>/add_json',
            beforeSend: function(){
                $('#msg_add').html('<div class="alert alert-info">Aguarde, gravando <?php echo strtolower($title); ?>...</div>');
            },
            success: function(e){
                if (e == 'OK') {
                    <?php if (isset($tipoTable) && ($tipoTable == 'tree')){ ?>

                        $('#msg_add').html('<div class="alert alert-success">Dados gravados com sucesso.</div>');
                        location.reload();

                    <?php } else { ?>

                        $('#msg_add').html('');
                        $('#frmModalAdd').each (function(){
                            this.reset();
                        });
                        $('#addModal').modal('hide');

                        lista();
                        modal_sucess('Dados gravados com sucesso.');

                    <?php } ?>
                }
                else
                {
                    $('#msg_add').html('<div class="alert alert-danger"> Erro: '+e+'</div>');
                }
            },
            error: function(){
                $('#msg_add').html('<div class="alert alert-danger">Erro: Requisição a servidor falhou, tende novamente!</div>');
            }
        });
    }


    function edit_modal(id){
        $.ajax({
            type: 'GET',
            url: './<?php echo $controller; ?>/edit_form/'+id,
            beforeSend: function(){
                $('#msg_modal').html('<div class="alert alert-info">Aguarde carregando <?php echo strtolower($title); ?>...</div>');
            },
            success: function(e){

                $('#msg_modal').html('');
                $('#retorno_modal').html(e);
                $('#editModal').modal();

            },
            error: function(){
                $('#msg_modal').html('<div class="alert alert-danger">Erro: Requisição a servidor falhou, tende novamente!</div>');
            }
        });
    }

    function update_modal(){

        var dados = $('#frmModalEdit').serialize();

        $.ajax({
            type: 'POST',
            data: dados,
            url: './<?php echo $controller; ?>/update_json',
            beforeSend: function(){
                $('#msg_edit').html('<div class="alert alert-info">Aguarde, gravando <?php echo strtolower($title); ?>...</div>');
            },
            success: function(e){
                if (e == 'OK') {
                    <?php if (isset($tipoTable) && ($tipoTable == 'tree')){ ?>

                        $('#msg_edit').html('<div class="alert alert-success">Dados gravados com sucesso.</div>');
                        location.reload();

                    <?php } else { ?>

                        $('#msg_edit').html('');
                        $('#frmModalEdit').each (function(){
                            this.reset();
                        });
                        $('#editModal').modal('hide');

                        lista();
                        modal_sucess('Dados gravados com sucesso.');

                    <?php } ?>

                }
                else
                {
                    $('#msg_edit').html('<div class="alert alert-danger"> Erro: '+e+'</div>');
                }
            },
            error: function(){
                $('#msg_edit').html('<div class="alert alert-danger">Erro: Requisição a servidor falhou, tende novamente!</div>');
            }
        });
    }


    function lista(){
        // tabela de cores
        var tab = $('#dataTables-lista').DataTable();
        tab.ajax.reload( null, false );
    }

    function clear_form_add(){
        $('#msg_add').html('');
        $('#frmModelMoAdd').each (function(){
            this.reset();
        });
    }

    function modal_sucess(msg){
        $('#msg_modal').html('<div class="alert alert-success">'+msg+'</div>');
    }
</script>

