$(document).ready(function() {
    // tabela de produtos
    $('#dataTables-produtos').DataTable({
        'ajax':'./home/produtos',                   
        'order': [[ 0, "desc" ]],                                
        'columns': [
            { 'data':'id'},
            { 'data':'nome'},
            { 'data':'acoes'}
        ]
    });
    // tabela de cores
    $('#dataTables-cores').DataTable({
        'ajax':'./home/cores',                   
        'order': [[ 0, "asc" ]],                                
        'columns': [                    
            { 'data':'nome'},
            { 'data':'acoes'}
        ]
    });    

    // carrega funções de cadastros
    select_grupo();
    lista_categorias();
});


/*******************************************************************************
 * PRODUTOS
 ******************************************************************************/
function lista_produtos(){
    // tabela de cores
    var tab_produtos = $('#dataTables-produtos').DataTable();    
    tab_produtos.ajax.url( './home/produtos' ).load();
}

// visualiza registro de produto
function visualizar_produto(id){
    $.ajax({
        type: 'GET',
        url: './home/ver_produto/'+id,
        beforeSend: function(){
            $('#msg_produto2').html('<div class="alert alert-warning">Aguarde consultando produto...</div>');
        },
        success: function (e){            
            $('#msg_produto2').html('');
            $('#retorno_modal').html(e);
        }
    });
}

// adiciona produto
function add_produto(){
    
    var dados = $('#frmProduto').serialize();
    var nome = $('#nome').val();
    
    if(nome == ""){
        $('#nome').focus();
        $('#msg_valida_nome').html('<span class="text text-danger">Campo nome obrigatório.</span>');
        $('#btnCadProduto').attr('disabled', 'true');
    }else{
        $.ajax({
            type: 'POST',
            data: dados,
            url: './home/add_produto',
            beforeSend: function(){
                $('#msg_produto').html('<div class="alert alert-warning">Aguarde cadastrando produto...</div>');
            },
            success: function(e){                                    
                $('#msg_produto').html(e).fadeOut(5000);
                $('#produtos').modal('hide');  
                $('#btnCadProduto').removeAttr('disabled');
                lista_produtos();
            }
        });
    }
}

// atualiza produto
function update_produto(){
    var dados = $('#frmUpdateProduto').serialize();
    $.ajax({
        type: 'POST',
        data: dados,
        url: './home/update_produto',
        beforeSend: function(){
            $('#msg_editar').html('<div class="alert alert-warning">Aguarde, salvando dados...</div>');
        },
        success: function(e){
            $('#msg_editar').html(e).fadeOut(5000);
            $('#modal_editar').modal('hide').fadeOut(15000);
            lista_produtos();
        },
        error: function(){
            $('#msg_editar').html('<div class="alert alert-danger">Erro ao salvar produto..</div>').fadeOut(5000);
        }
    });
}


// edita produto
function editar_produto(id){
    $.ajax({
        type: 'GET',
        url: './home/editar_produto/'+id,
        beforeSend: function(){
            $('#msg_produto2').html('<div class="alert alert-warning">Aguarde carregando produto...</div>');
        },
        success: function(e){            
            $('#msg_produto2').html('');
            $('#retorno_modal').html(e);            
        },
        error: function(){
            $('#msg_produto2').html('<div class="alert alert-danger">Erro ao carregar produto...</div>').fadeOut(5000);
        }
    });
}

// carrega modal de exclusão de produto
function confirm_del_produto(id){    
    $.ajax({
        type: 'GET',
        url: './home/modal_exclusao_produto/'+id,
        beforeSend: function(){
            $('#msg_produto2').html('<div class="alert alert-warning">Localizando produto...</div>');
        },
        success: function(info){
            $('#retorno_modal').html(info);
        },
        error: function(){
            $('#msg_produto2').html('<div class="alert alert-warning">Erro ao localizar produto, tente novamente.</div>');
        }
    });
}

// exclusão de produto
function excluir_produto(id){    
        $.ajax({
            type: 'GET',
            url: './home/excluir_produto/'+id,
            beforeSend: function(){
                $('#msg_produto2').html('<div class="alert alert-warning">Aguarde desativando produto...</div>');
            },
            success: function(e){
                $('#modal_del_prod').modal('hide');
                $('#msg_produto2').html(e).fadeOut(5000);                
                lista_produtos();
            },
            error: function(){
                $('#msg_produto2').html('<div class="alert alert-danger">Erro ao desativar produto, tente novamente.</div>');
            }
        });
    
}

// verifica duplicidade de nome de produtos
function valida_nome(){
    var nome = $('#nome').val();    
    if(nome == ""){
        $('#msg_valida_nome').html("<span class=\"text text-danger\">Campo nome de preenchimento obrigatório.</span>");
        $('#btnCadProduto').attr('disabled', 'disabled');
    }else{
        var tam = nome.length;
        if(tam < 3){
            $('#msg_valida_nome').html("<span class=\"text text-danger\">Campo nome deve ter no mínimo 3 caracteres.</span>");
            $('#btnCadProduto').attr('disabled', 'disabled');
        }else{
            //$('#msg_valida_nome').html(nome);
            $.ajax({
                type: 'POST',
                data: {'nome_produto':nome},
                url: './home/valida_nome',
                success:function(e){
                    if(e === 'error'){
                        $('#msg_valida_nome').html('<span class="text text-danger">Nome já cadastrado no banco de dados.</span>');
                        $('#btnCadProduto').attr('disabled', 'disabled');
                        $('#nome').focus();
                    }else{
                        $('#msg_valida_nome').html('');
                        $('#btnCadProduto').removeAttr('disabled', 'disabled');
                    }

                }
            });
        }
    }
}
// valida nome de produto para edição
function nome_produto_edit(){
    var nome = $('#nome').val();    
    if(nome == ""){
        $('#msg_valida_nome').html("<span class=\"text text-danger\">Campo nome de preenchimento obrigatório.</span>");
        $('#btnCadProduto').attr('disabled', 'disabled');
    }else{
        var tam = nome.length;
        if(tam < 3){
            $('#msg_valida_nome').html("<span class=\"text text-danger\">Campo nome deve ter no mínimo 3 caracteres.</span>");
            $('#btnCadProduto').attr('disabled', 'disabled');
        }else{
            $('#msg_valida_nome').html("");
            $('#btnCadProduto').removeAttr('disabled', 'disabled');
        }
    }
}
/*******************************************************************************
 * GRUPOS DE CATEGORIAS
 ******************************************************************************/
function lista_categorias(){
    $.ajax({
        type: 'GET',
        url: './home/categorias',
        success: function(info){
            $('#lista_categorias').html( info );
        }
    });
}
// monta combo dinamico de select para o cadastro
function select_grupo(){        
    $.ajax({
        type: 'GET',
        url: './home/select_categoria',
        success: function(info){
            $('.select-grupo-add').html( info );
        }
    });    
}
// monta combo box para edição e visualização
// id => identificador do grupo
// ativacao => 0 - Combo inativo, 1 - Combo ativo
function select_grupo_edit(id, ativacao){   
    
    $.ajax({
        type: 'GET',
        url: './home/select_categoria/'+id+'/'+ativacao,
        success: function(info){
            $('.select-grupo').html( info );
        }
    });    
}
// add nova categoria
function add_categoria(){
    var dados = $('#frmCategoria').serialize();
    var grupo = $('#nome_grupo').val();
    if(grupo == ""){
        $('#msg_grupo').html('<div class="alert alert-danger">Campo <b>Grupo</b>, obrigatório.</div>').fadeOut(5000);
        $('#nome_grupo').focus();
    }else{    
        $.ajax({
            type: 'POST',
            data: dados,
            url: './home/add_categoria',
            beforeSend: function(){
                $('#msg_grupo').html('<div class="alert alert-warning">Aguarde, cadastrando...</div>');
            },
            success: function(e){
                
                if(e == 'ok'){
                    $('#msg_grupo').html(e).fadeOut(5000);
                    lista_categorias();
                    select_grupo();
                    $('#nome_grupo').val("");
                }else{
                    $('#msg_grupo').html(e).fadeOut(5000);
                    $('#nome_grupo').val('').focus();
                    lista_categorias();
                    select_grupo();
                }
            },
            error: function(){
                $('#msg_grupo').html('<div class="alert alert-danger">Erro ao adicionar registro, tente novamente!</div>').fadeOut(5000);
            }

        });
    }
}

// carrega form para edição da categoria
function editar_categoria(id){
    
    var nome_cat = $('#update-'+id).attr('data-cat');
    $('#update-'+id).html('<form action="" id="frmUpCat-'+id+'" method="post" class="form-inline"><div class="form-group"><input type="text" class="form-control" id="nome_cat_'+id+'" name="nome_cat" value="'+nome_cat+'"> <button class="btn btn-default" onclick="update_categoria('+id+')" type="button">Salvar</button><input type="hidden" name="cat" value="'+id+'" /></form>');
}
// executa ação de update
function update_categoria(id){
    var dados = $('#frmUpCat-'+id).serialize();
    var cor = $('#nome_cat_'+id).val();    
    
    if(cor == ""){
        $('#msg_grupo2').html('<div class="alert alert-warning">Este campo não pode ser vazio.</div>').fadeOut(5000);
        $('#nome_cat_'+id).focus();
    }else{
    
        $.ajax({
            type: 'POST',
            data: dados,
            url: './home/editar_categoria',
            beforeSend: function(){
                $('#msg_grupo2').html('<div class="alert alert-warning">Aguarde, salvando registro...</div>');
            },
            success: function(e){
                $('#msg_grupo2').html(e).fadeOut(5000);
                lista_categorias();
            },
            error: function(){
                $('#msg_grupo2').html('<div class="alert alert-danger">Erro ao salvar registro, tente novamente!</div>').fadeOut(5000);
            }
        });
    }
}
// carrega form de exclusão de grupo
function confirm_del_grupo(id){
    $.ajax({
        type: 'GET',
        url: './home/modal_exclusao_grupo/'+id,
        beforeSend:function(){
            $('#msg_grupo2').html('<div class="alert alert-warning">Aguarde, carregando registro...</div>');
        },
        success: function(e){
            $('#msg_grupo2').html('');
            $('#retorno_modal').html(e);
        },
        error: function(){
            $('#msg_grupo2').html('<div class="alert alert-danger">Erro ao carregar registro, tente novamente.</div>');
        }
    });
}
// exclui categoria
function excluir_categoria(id){
    $.ajax({
        type: 'GET',
        url: './home/excluir_categoria/' + id,
        beforeSend: function(){
             $('#msg_grupo2').html('<div class="alert alert-warning">Aguarde, desativando registro...</div>');
         },
         success: function(e){                
             $('#msg_grupo2').html(e).fadeOut(5000);
             lista_categorias();                                    
         },
         error: function(){
             $('#msg_grupo2').html('<div class="alert alert-danger">Erro ao excluir registro, tente novamente!</div>').fadeOut(5000);
         }
    });    
}
/*******************************************************************************
 * CORES
 ******************************************************************************/
function lista_cores(){
       
    // tabela de cores
    var tab_cores = $('#dataTables-cores').DataTable();    
    tab_cores.ajax.url( './home/cores' ).load();
}

function add_cor(){
    
    var dados = $('#frmCor').serialize();
    var cor = $('#nome_cor').val();
    if(cor == ""){
        $('#msg_cor').html('<div class="alert alert-danger">Campo <b>Cor</b>, obrigatório.</div>');
        $('#nome_cor').focus();
    }else{    
        $.ajax({
            type: 'POST',
            data: dados,
            url: './home/add_cor',
            beforeSend: function(){
                $('#msg_cor').html('<div class="alert alert-warning">Aguarde, cadastrando...</div>');
            },
            success: function(e){
                
                if(e == 'ok'){
                    $('#msg_cor').html(e).fadeOut(5000);                    
                    $('#nome_cor').val("");
                    
                   lista_cores();
                    
                }else{
                    $('#msg_cor').html(e).fadeOut(5000);
                    $('#nome_cor').val('').focus();
                    lista_cores();
                }
                
                
                
            },
            error: function(){
                $('#msg_cor').html('<div class="alert alert-danger">Erro ao adicionar registro, tente novamente!</div>');
            }


        });
    }
}
// carrega form para edição da cor
function editar_cor(id){   
    var nome_cor = $('#updatecor-'+id).attr('data-cor');
    
    $('#updatecor-'+id).html('<form action="" id="frmUpCor-'+id+'" method="post"><div class="input-group"><input type="text" class="form-control" id="nome_cor_'+id+'" name="nome_cor" value="'+nome_cor+'"><span class="input-group-btn"><button class="btn btn-default" onclick="update_cor('+id+')" type="button">Salvar</button></span></div><!-- /input-group --><input type="hidden" name="cor" value="'+id+'" /></form>');
}
// executa ação de update
function update_cor(id){
    var dados = $('#frmUpCor-'+id).serialize();
    var cor = $('#nome_cor_'+id).val();    
    
    if(cor == ""){
        $('#msg_cor2').html('<div class="alert alert-warning">Este campo não pode ser vazio.</div>').fadeOut(5000);
        $('#nome_cor_'+id).focus();
    }else{
    
        $.ajax({
            type: 'POST',
            data: dados,
            url: './home/editar_cor',
            beforeSend: function(){
                $('#msg_cor2').html('<div class="alert alert-warning">Aguarde, salvando registro...</div>');
            },
            success: function(e){
                $('#msg_cor2').html(e).fadeOut(5000);
                lista_cores();
            },
            error: function(){
                $('#msg_cor2').html('<div class="alert alert-danger">Erro ao salvar registro, tente novamente!</div>');
            }
        });
    }
}
// carrega form de exclusão de cor
function confirm_del_cor(id){
    $.ajax({
        type: 'GET',
        url: './home/modal_exclusao_cor/'+id,
        beforeSend:function(){
            $('#msg_cor2').html('<div class="alert alert-warning">Aguarde, carregando registro...</div>');
        },
        success: function(e){
            $('#msg_cor2').html('');
            $('#retorno_modal').html(e);
        },
        error: function(){
            $('#msg_cor2').html('<div class="alert alert-danger">Erro ao carregar registro, tente novamente.</div>');
        }
    });
}

// exclui cor
function excluir_cor(id){
    $.ajax({
        type: 'GET',
        url: './home/excluir_cor/' + id,
        beforeSend: function(){
             $('#msg_cor2').html('<div class="alert alert-warning">Aguarde, deletando...</div>');
         },
         success: function(e){                
             $('#msg_cor2').html(e).fadeOut(5000);      
             lista_cores();
         },
         error: function(){
             $('#msg_cor2').html('<div class="alert alert-danger">Erro ao excluir registro, tente novamente!</div>').fadeOut(5000);
         } 
    });   
}
