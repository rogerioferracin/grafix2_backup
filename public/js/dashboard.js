/** *******************************************************************************************************************
 * Function for to use on app and Plugins from thirdparty
 */

/**
 * Load Bootbox
 */
function MakeSubmitConfirm(form) {

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
        $(tableId).dataTable(options);
    }

}


/** *******************************************************************************************************************
 * Document ready load
 */
$(document).ready(function(){
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