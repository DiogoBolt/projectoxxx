var arrayOperacoes = [];
var arrayCampos = [];
var arrayValores = [];
var filterIndex = 0;

function getOperacoes() {
    arrayOperacoes = [];
    $.each($('input[name="operacao[]"]'), function (key, value) {
        arrayOperacoes.push($(this).val());
    });

    return arrayOperacoes;
}

function getCampos() {
    arrayCampos = [];
    $.each($('input[name="campo[]"]'), function (key, value) {
        arrayCampos.push($(this).val());
    });

    return arrayCampos;
}

function getValores() {
    arrayValores = [];
    $.each($('input[name="valor[]"]'), function (key, value) {
        arrayValores.push($(this).val());
    });

    return arrayValores;
}

$(function () {
    //Faz blur ao select para funcionamento correcto com o validate
    $('.selectpicker').on('changed.bs.select', function (e) {
        $(this).blur();
    });


    var table = $('#dt_bonus_list').DataTable({
        processing: true,
        serverSide: true,
        order: [[0, "desc"]],
        ajax: {
            url: baseURL + '/bonus/list',
            type: "POST",
            data: function (d) {
                d.operacoes = getOperacoes();
                d.campos = getCampos();
                d.valores = getValores();
            }
        },
        columns: [
            {data: 'id', name: 'bonus.id'},
            {data: 'bonus_type_id'},
            {data: 'title'},
            {data: 'min_deposit'},
            {data: 'available_until'},
            {data: 'actions', orderable: false, searchable: false},
            {data: 'delete', orderable: false, searchable: false}
        ]
    });

    var table2 = $('#dt_bonus_history').DataTable({
        processing: true,
        serverSide: true,
        order: [[0, "desc"]],
        ajax: {
            url: baseURL + '/bonus/history',
            type: "POST",
            data: function (d) {
                d.operacoes = getOperacoes();
                d.campos = getCampos();
                d.valores = getValores();
            }
        },
        columns: [
            {data: 'id', name: 'bonus.id'},
            {data: 'bonus_type_id'},
            {data: 'title'},
            {data: 'min_deposit'},
            {data: 'available_until'},
            {data: 'actions', orderable: false, searchable: false},
            {data: 'delete', orderable: false, searchable: false}
        ]
    });

    $(document).on('click', '.removeFiltro', removeFilter);

    function removeFilter() {
        var obj = $(this);
        var index = obj.attr('data-index');
        $('.filtro-' + index).remove();

        //recarrega a datatables
        table.ajax.reload();
        table.draw();

        obj.closest('div').remove();

        //$('#filtro select, input').not(':hidden').attr('disabled', true);
        //$('#filtro').submit();
        return false;
    }

    $('#filtro').validate({
        ignore: ':hidden',
        rules: {
            'operacao': {required: true},
            'campo': {required: true},
            'valor': {required: true}
        },
        messages: {
            'operacao': "Operation Required",
            'campo': "Field Required",
            'valor': "Value Required"
        },
        errorLabelContainer: '#errors ul',
        wrapper: 'li',
        submitHandler: function (form) {

            var operacao = $(form).find('select[name="operacao"]').val();
            var campo = $(form).find('select[name="campo"]').val();
            var valor = $(form).find('input[name="valor"]').val();

            var operacaoLabel = $('select[name="operacao"] option:selected').text();
            var campoLabel = $('select[name="campo"] option:selected').text();

            //inclui os elementos de pesquisa no form
            $(form).append(
                '<input class="filtro-' + filterIndex + '" type="hidden" name="operacao[]" value="' + operacao + '">' +
                '<input class="filtro-' + filterIndex + '" type="hidden" name="campo[]" value="' + campo + '">' +
                '<input class="filtro-' + filterIndex + '" type="hidden" name="valor[]" value="' + valor + '">'
            );

            //inclui os filtros no container dos filtros
            $('.container-filtros').append(
                '<div style="float: left; margin-right: 10px; padding: 0 10px; background-color: #f4f4f4; color: #444;">' +
                campoLabel + ' ' + operacaoLabel + ' ' + _.escape(valor) + ' ' +
                '<a data-index="' + filterIndex + '" class="removeFiltro" title="Remove" href="#">' +
                '<i style="color:#F00" class="fa fa-times"></i>' +
                '</a>' +
                '</div>'
            );
            filterIndex++;

            //Limpa o form
            $(form)[0].reset();
            $('.selectpicker').selectpicker('refresh');

            //recarrega a datatables
            table.ajax.reload();
            table.draw();
            return false;
        }
    });

});
