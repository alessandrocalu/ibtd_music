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
                ]

        <?php } ?>

            });

        <?php 
        if (isset($mensagem)){
        ?>
            $('#retorno_modal').html('<div class="alert alert-danger"> <?php echo $mensagem; ?> </div>');
        <?php 
        }
        ?>
    });

    $('#dataTables-lista').on( 'draw.dt', function () {
        if ($('#dataTables-lista_length').parent().hasClass('col-sm-6')) {
            $('#dataTables-lista_length').parent().removeClass('col-sm-6');
            $('#dataTables-lista_length').parent().addClass('col-sm-4');

            $('#dataTables-lista_filter').parent().removeClass('col-sm-6');
            $('#dataTables-lista_filter').parent().addClass('col-sm-4');

            //Adiciona button para chamar Adiçao de registro
            $('#dataTables-lista_filter').parent().parent().append("<div class='col-sm-4'> <button id='button-new' onclick='novo()' class='btn btn-primary pull-right'>Incluir registro</button></div>");
        }
    });

    $('#dataTables-lista tbody').on( 'click', 'tr', function () {
        <?php if (isset($tipoTable) && ($tipoTable == 'tree')){ ?>
            window.location = '<?php echo "index.php/".$controller."/edit/"; ?>'+table.row( this ).data()[0];
        <?php } else { ?>
            window.location = '<?php echo "index.php/".$controller."/edit/"; ?>'+table.row( this ).data().id;
        <?php } ?>
    } );

    $('.datepicker').datepicker({
        dateFormat: 'dd/mm/yy',
        dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
        dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
        dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
        monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
        monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
        nextText: 'Próximo',
        prevText: 'Anterior'
    });

    function novo() {
        window.location =  '<?php echo  base_url("index.php/".$controller."/create");  ?>'; 
    }

    function abrelocal(link){
        window.location =  link;     
    }
</script>

