$(document).ready(function(e){
    var table = $('#mytable').DataTable({

        dom: '<""flB>tip',
        buttons: [
            {
                extend: 'excel',
                text: '<i class="fa fa-file-excel-o"></i> Export all to excel'
            },
            {
                extend: 'csv',
                text: '<i class="fa fa-file-o"></i> Export all to csv'
            },
            {
                extend: 'pdf',
                text: '<i class="fa fa-file-pdf-o"></i> Export all to pdf'
            },
            {
                extend: 'print',
                text: '<i class="fa fa-print"></i> Print all'
            },
            {
                extend: 'colvis',
                text: '<i class="fa fa-eye"></i> Column visibility'
            },

        ]
    });

    $('.search-panel .dropdown-menu').find('a').click(function(e) {
        e.preventDefault();
        var param = $(this).attr("href").replace("#","");
        var concept = $(this).text();
        $('.search-panel span#search_concept').text(concept);
        $('.input-group #search_param').val(param);
    });


});