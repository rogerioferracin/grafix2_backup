/** *******************************************************************************************************************
 * Function for to use on app and Plugins from thirdparty
 */


/**
 * Troca senha de usuário
 */
function MakeTrocaSenhaModal(userId, token_id)
{
    $.getScript('/plugins/bootbox/bootbox.min.js').done(function(script){
        var fieldData = '';
        bootbox.setDefaults({
            locale  : 'br',
            size : 'small',
            buttons: {
                success : {
                    label : 'Cancela',
                    className : 'btn-default'
                },
                primary : {
                    label : 'OK',
                    className: 'btn-primary',
                    callback : function() {
                        var senha_atual = $('input[name="senha-atual"]').val();
                        var nova_senha = $('input[name="nova-senha"]').val();
                        var confirma_senha = $('input[name="confirma-nova-senha"]').val();

                        if(senha_atual === '' || nova_senha === '' || confirma_senha === '') {
                            alert('Todos os campos devem ser preenchidos!');
                            return false;
                        }

                        if(senha_atual === nova_senha) {
                            alert('A senha atual e nova senha não podem ser mesma!');
                            return false;
                        }

                        if(nova_senha != confirma_senha) {
                            alert('Nova senha e confirma nova senha devem ser identicas!');
                            return false;
                        }

                        var formData = {
                            'senha_atual' : senha_atual,
                            'nova_senha' : nova_senha
                        }

                        $.ajaxSetup({
                            headers : {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax('/usuarios/altera-senha/' + userId, {
                            method : 'put',
                            data : formData
                        }).done(function(result) {
                            if(result.success) {
                                alert(result.mensagem);
                                window.location.assign('/auth/logout');
                            }
                            if(result.fail) {
                                alert(result.mensagem);
                            }
                        })

                    }
                }
            }
        });

        var modal = bootbox.dialog({
            title : 'Troca senha',
            message :
            '<div class="row">  ' +
                '<div class="col-md-12"> ' +
                    '<form class="form-horizontal" id="form-troca-senha"> ' +
                        '<div class="form-group"> ' +
                            '<div class="col-md-12"> ' +
                                '<input name="senha-atual" type="text" placeholder="Senha atual" class="form-control" required> ' +
                            '</div> ' +
                        '</div> ' +
                        '<div class="form-group"> ' +
                            '<div class="col-md-12"> ' +
                                '<input name="nova-senha" type="text" placeholder="Nova senha" class="form-control" required> ' +
                            '</div> ' +
                        '</div> ' +
                        '<div class="form-group"> ' +
                            '<div class="col-md-12"> ' +
                                '<input name="confirma-nova-senha" type="text" placeholder="Confirma nova senha" class="form-control" required> ' +
                            '</div> ' +
                        '</div> ' +
                    '</form> ' +
                '</div>' +
            '</div> '
        });
    });
}

/**
 * Busca endereco
 */
function MakeSearchAddressModal() {

    $.getScript('/plugins/bootbox/bootbox.min.js').done(function(script){
        var fieldData = '';
        bootbox.setDefaults({
            locale  : 'br',
            size    : 'large'
        });

        var modal = bootbox.dialog({
            title : 'Busca endereço',
            message : '<div class="row">  ' +
            '<div class="col-md-12"> ' +
                '<form class="form-horizontal"> ' +
                    '<div class="form-group"> ' +
                        '<div class="col-md-12"> ' +
                            '<div class="input-group"> ' +
                                '<input id="endereco-pesquisa" name="endereco" type="text" placeholder="Digite o logradouro ou o cep" class="form-control"> ' +
                                '<div class="input-group-btn"> ' +
                                    '<button type="button" id="btn-pesquisar" class="btn btn-default btn-pesquisar" ><i class="fa fa-search-plus"></i> Pesquisar</button> ' +
                                '</div> ' +
                            '</div> ' +
                        '</div> ' +
                    '</div> ' +
                '</form> ' +
            '</div>  </div> ' +
            '<div class="row">' +
                '<div class="col-md-12" id="resultados">' +
                    '<table class="table table-striped hover" id="tabela-pesquisa-endereco"> ' +
                    '<thead><tr><th>Logradouro</th><th>Bairro</th><th>Cep</th><th>Cidade</th></tr></thead> ' +
                    '</table> ' +
                ' </div> ' +
            '</div> '
        });

        var oTable = MakeDataTable('#tabela-pesquisa-endereco', {
            aoColumns : [
                {'mData' : 'logradouro'},
                {'mData' : 'bairro'},
                {'mData' : 'cep'},
                {'mData' : 'cidade'},
            ]
        });

        $('input[name="endereco"]').focus();

        $('.btn-pesquisar').click(function(e){
            var pesquisa =  $('#endereco-pesquisa').val();
            if(pesquisa === '' || pesquisa === null) {
                bootbox.alert({
                    size    : 'small',
                    message : 'O campo de pesquisa não pode estar em branco',
                    callback : function(){
                        $('input[name="endereco"]').focus();
                    }
                });
                return;
            }
            var pesquisando = $.get('/enderecos/pesquisa-endereco/'+pesquisa);
            pesquisando.done(function(result){
                if(result.fail) {
                    bootbox.alert({
                        size    : 'small',
                        message : result.message
                    });
                } else if(result.success) {
                    $('#tabela-pesquisa-endereco').dataTable().fnDestroy();
                    var oTable = MakeDataTable('#tabela-pesquisa-endereco', {
                        data      : result.data,
                        aoColumns : [
                            {'mData' : 'logradouro'},
                            {'mData' : 'bairro'},
                            {'mData' : 'cep'},
                            {'mData' : 'cidade'},
                        ],
                        fnInitComplete : function() {
                            $(this).delegate('tbody tr', 'click', function(){
                                var table = $('#tabela-pesquisa-endereco').dataTable();
                                fieldData = table.fnGetData(this);

                                bootbox.dialog({
                                    size    : 'small',
                                    title   : 'Confirma escolha',
                                    message : 'Deseja selecionar este endereço?',
                                    buttons : {
                                        default : {
                                            label : 'Cancela'
                                        },
                                        primary : {
                                            label : 'Ok',
                                            callback : function() {
                                                $('input[name="logradouro"]').val(fieldData.logradouro);
                                                $('input[name="bairro"]').val(fieldData.bairro);
                                                $('input[name="cidade"]').val(fieldData.cidade);
                                                $('input[name="uf"]').val(fieldData.uf);
                                                $('input[name="cep"]').val(fieldData.cep);

                                                modal.modal('hide');
                                                $('input[name="numero"]').focus();
                                            }
                                        }
                                    }
                                })
                            })
                        }
                    });
                    $('#endereco-pesquisa').val('');
                }
            });

        });
    });


}

/**
 * Load Datatables
 */
function MakeDataTable(tableId, options)
{
    if(!$.fn.dataTable) {
        LoadDatatablePlugin();
    } else {
        createDataTable();
    }

    //Load dynamic datatable plugin
    function LoadDatatablePlugin() {
        $.getScript('/plugins/datatables/jquery.dataTables.min.js', function(){
            $.getScript('/plugins/datatables/dataTables.bootstrap.min.js', function(){
                $.getScript('/plugins/datatables/dataTables.tableTools.min.js', createDataTable())
            })
        })
    }

    //create datatable
    function createDataTable() {
        //default options
        $.extend($.fn.dataTable.defaults, {
            language : {
                url : '/plugins/datatables/pt-br.json'
            },
            dom :   "<'dom-content'<'col-sm-6'l><'col-sm-6'f><'clearfix'>>rt<'dom-content'<'col-sm-6 small'i><'col-sm-6 small'p>>"
        })

        //load datatable
        var oTable = $(tableId).dataTable(options);

        return oTable;
    }
}

/**
 * Make breadcumbs for the page
 */
function MakeBreadCrumbs(){
    var local = window.location.pathname.split('/');
    $(local).each(function(key, value){
        if(value)
            $('#breadcrumb ol').append('<li><a href="#">' + value +'</a></li>')
    })
}

/**
 * Insere badges com qtde de erros nos panels do form
 * @constructor
 */
function MakeErrorBadgeOnPanel()
{
    var panels = $('.panel-group').find('.panel-body');
    $(panels).each(function(){
        var errors = $(this).find('.text-danger');
        if(errors.length > 0) {
            $(errors).closest('.panel-body').parent().siblings().append('<span class="badge">' + errors.length + '</div>');
        }
    });
}

/**
 * Mascara campo com CNPJ ou CPF
 * @param field
 * @constructor
 */
function MakeMaskedCnpjCpf(field)
{
    var text = $(field).val().replace(/[^0-9]/gi, '');

    switch (text.length) {
        case 11 :
            var value = text.substring(0,3) + '.' + text.substring(3,6) + '.' + text.substring(6,9) + '.' + text.substring(9);
            $(field).val(value);
            break;
        case 14 :
            var value = text.substring(0,2)
                + '.' + text.substring(2,5)
                + '.' + text.substring(5,8)
                + '/' + text.substring(8,12)
                + '-' + text.substring(12);
            $(field).val(value);
            break;
    }

}

function MakeDateTimePicker(field, type)
{
    $.getScript('/plugins/moment/moment-with-locales.min.js', function(){
        $.getScript('/plugins/bsdatetimepicker/bootstrap-datetimepicker.min.js', function(){
            if(type === 'date') {
                type = 'DD/MM/YYYY';
            } else {
                type = 'DD/MM/YYYY HH:MM'
            }

            $(field).datetimepicker({
                locale : 'pt-BR',
                format : type
            });
        })
    })
}

/** *******************************************************************************************************************
 * Document ready load
 */
$(document).ready(function(){
    //breadcrumb ----------------------------------------
    MakeBreadCrumbs();

    //error badges ----------------------------------------
    MakeErrorBadgeOnPanel();

    //date picker ----------------------------------------
    //$('.date').datetimepicker();


    //tooltip ----------------------------------------
    $('#btn-busca-endereco').click(function(){
        MakeSearchAddressModal();
    });

    //tooltip ----------------------------------------
    $('[data-toggle="tooltip"]').tooltip();

    //confirm submit -----------------------------------
    $('.submit-confirm').click(function(e){
        e.preventDefault();
        var form = $(this).closest('form');

        $.getScript('/plugins/bootbox/bootbox.min.js').done(function(script){
            bootbox.setDefaults({
                locale : 'br',
                size : 'small'
            });

            bootbox.dialog({
                title   : 'Confirma envio?',
                message : 'Confirma envio de formulário',
                buttons : {
                    default : {
                        label : 'Cancela'
                    },
                    primary : {
                        label : 'Ok',
                        callback : function() {
                            form.submit();
                        }
                    }
                }
            });
        });
    })
})