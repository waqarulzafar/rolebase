"use strict";
var KTDatatablesDataSourceAjaxServer = function() {

    var initTable1 = function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var tableEditor= new $.fn.dataTable.Editor({
            ajax: HOST_URL+ "/admin/user/store-role",
            table: "#kt_datatable",
            display: "bootstrap",
            idSrc:'id',
            keys:true,
            fields: [
                {label: "Name:", name: "name"},
                {label: "Description:", name: "desc"},
            ]
        });
        $('#kt_datatable').on('click', 'tbody td:not(:first-child)', function (e) {
            tableEditor.inline( this ,{
                onBlur: 'submit',
                scope:'cell'
            });
        });
        var table = $('#kt_datatable');

        // begin first table
        var newtable = table.DataTable({
            dom: "Bfrtip",
            responsive: true,
            searchDelay: 500,
            processing: true,
            serverSide: true,
            ajax: {
                url: HOST_URL + '/admin/user/fetch-role',
                type: 'GET',
            },
            columnDefs: [
                {
                    targets: -1,
                    title: 'Actions',
                    orderable: false,
                    render: function(data, type, full, meta) {
                        return '\<a href="'+HOST_URL+'/admin/file/file-assign/'+full.id+'" class="btn btn-md btn-clean " title="File Assign">\
								File Assign\
							</a>\
						';
                    },
                },
            ],
            "select": {
                'style': 'multi'
            },
            columns: [
                {data: 'id'},
                {data: 'name'},
                {data: 'desc'},
                {data: 'status'},
                {data: 'status'},

            ],
            buttons: [
                { extend: "create", editor: tableEditor ,className:'btn btn-outline-success font-weight-bold'},
                { extend: "edit",   editor: tableEditor ,className:'btn btn-outline-warning font-weight-bold'},
                { extend: "remove", editor: tableEditor ,className:'btn btn-outline-danger font-weight-bold'},
                // {extend: 'print', className: 'btn btn-info font-weight-bold'},
                // {extend: 'copy', className: 'btn btn-muted font-weight-bold'},
                // {extend: 'excel', className: 'btn btn-blue font-weight-bold'},
                // {extend: 'pdf', className: 'btn btn-red font-weight-bold'},
                // {extend: 'csv', className: 'btn btn-green font-weight-bold'}
                {
                    extend: 'collection',
                    text: 'Export',
                    className:'btn btn-dark font-weight-bold dropdown-toggle',
                    buttons: [
                        'copy',
                        'excel',
                        'csv',
                        'pdf',
                        'print'
                    ]
                }

            ],

        });
        newtable.buttons( 0, null ).containers().appendTo( '#dtButtons' );

    };

    return {

        //main function to initiate the module
        init: function() {
            initTable1();
        },

    };

}();

jQuery(document).ready(function() {
    KTDatatablesDataSourceAjaxServer.init();
});
