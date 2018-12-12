$(function () {

    //Exportable table
    $('.js-basic-example').DataTable({
        dom: 'Bfrtip',
        responsive: true,
        language: {
                "url": "/plugins/jquery-datatable/lang/pt/Portuguese-Brasil.json"
            },
        buttons: [
            //{ extend: 'copy', text: 'Copy to clipboard', className: 'btn bg-teal waves-effect' },
        ]
    });
});
