<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script>

    $(document).ready(function() {
        $('#dataTables-lista').DataTable({
            responsive: true,
            language: {
                lengthMenu:'Mostrar _MENU_ registros',
                search: 'Buscar: ',
                info: 'Mostrando _START_ de _END_ de _TOTAL_ registros.',
                infoFiltered:'(_MAX_ registro(s) filtrados)',
                infoEmpty: 'Nenhum registro encontrado',
                emptyTable:'Nenhum registro encontrado',
                paginate: {
                    previous: 'Anterior',
                    next: 'Próximo'
                },
                zeroRecords: 'Nenhum registro encontrado',
                thousands: '.',
                decimal: '',
                loadingRecords: "Carregando...",
                processing: 'Processando...'
            },
            columnDefs: [
                { searchable: false,
                    orderable: false,
                    width: 30,
                    targets: 0 }
            ],
            <?php echo  $columns.',' ?>
            ajax: './<?php echo $controller; ?>/lista_json'
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


    function add_modal(){

        var dados = $('#frmModelMoAdd').serialize();

        $.ajax({
            type: 'POST',
            data: dados,
            url: './<?php echo $controller; ?>/add_json',
            beforeSend: function(){
                $('#msg_add').html('<div class="alert alert­info">Aguarde, adicionando <?php echo strtolower($title); ?>...</div>');
            },
            success: function(e){
                if (e == 'OK') {
                    $('#msg_add').html('<div class="alert alert­danger">Dados gravados com sucesso.</div>').fadeOut(5000);
                    $('#addModal').modal('hide');
                    lista();
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


    function lista(){
        // tabela de cores
        var tab = $('#dataTables-lista').DataTable();
        tab.ajax.reload( null, false );
    }

    function clear_form(){
        $('#msg_add').html('');

    }
</script>

