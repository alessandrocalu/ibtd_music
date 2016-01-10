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
        ]
    });
});

$('#dataTables-lista').on( 'draw.dt', function () {
    $('#dataTables-lista_length').parent().removeClass( 'col-sm-6' );
    $('#dataTables-lista_length').parent().addClass( 'col-sm-4' );

    $('#dataTables-lista_filter').parent().removeClass( 'col-sm-6' );
    $('#dataTables-lista_filter').parent().addClass( 'col-sm-4' );

    //Adiciona button para chamar Adiçao de registro
    $('#dataTables-lista_filter').parent().parent().append( "<div class='col-sm-4'> <button id='btn-incluir' class='btn btn-primary pull-right' type='button'>Incluir registro</button></div>" );

    $('#btn-incluir').on( 'click', function () {
        $('#page-wrapper-add').removeClass('hide');
    });
});



