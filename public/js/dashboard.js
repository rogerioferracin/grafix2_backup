/** *******************************************************************************************************************
 * Function for to use on app and Plugins from thirdparty
 */

/**
 * Load Bootbox
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
            $.getScript('/plugins/datatables/dataTables.tableTools.min.js', function(){
                $.getScript('/plugins/datatables/dataTables.bootstrap.min.js', createDataTable())
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
            dom :   "<'dom-content'<'col-sm-6'l><'col-sm-6'f><'clearfix'>>rt<'dom-content'<'col-sm-6'i><'col-sm-6'p>>"
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

/** *******************************************************************************************************************
 * Document ready load
 */
$(document).ready(function(){
    //breadcrumb ----------------------------------------
    MakeBreadCrumbs();

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