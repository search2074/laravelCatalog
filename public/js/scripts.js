jQuery(function($){
    console.log('%cstarted app', 'color:green');

    $('body').on('click', '.products-list .check-column', function(){
        var field = $(this).data('column'),
            select_field = $('input[name=select_fields]'),
            fields = select_field.val().split(','),
            i = fields.indexOf(field);

        if(i !== -1){
            //удалим
            fields.splice(i, 1);
        } else {
            //иначе добавим
            fields.push(field);
        }

		var table = $(this).parents('table'),
            rows = table.find('tbody tr'),
        //номер столбца
            cell_index = this.cellIndex,
            field = $(this).data('column');
        rows.each(function(){
            var td = $(this).find('td').eq(cell_index);
            td.toggleClass('checked-cell');
        });

        select_field.val(fields.join(','));
    });

    $('body').on('click', '.products-list tbody tr td:gt(0)', function(){
        var checkbox = $(this).parents('tr').find('.check-row');
        
        checkbox.prop("checked", function(i, val){
            return !val;
        });
    });
});