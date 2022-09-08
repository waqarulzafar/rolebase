"use strict";
var KTDatatablesDataSourceAjaxServer = function() {

    var initTable1 = function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var tableEditor= new $.fn.dataTable.Editor({
            ajax: HOST_URL+ "/admin/file/store-file",
            table: "#kt_datatable",
            display: "bootstrap",
            idSrc:'id',
            keys:true,
            fields: [
                {label: "Department:",
                type:'select',
                options:deparments,
                    name: "department_id"
                },
                {label: "Name:", name: "name"},
                {label: "Description:", name: "desc"},
                {
                    label: "File:",
                    name: "file",
                    type: "upload",
                    display: function ( file_id ) {
                        console.log(file_id);
                        return '<img src="'+HOST_URL+"/storage/"+file_id+'" />';
                    },
                    // clearText: "Clear",
                    // noImageText: 'No image'
                },
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
                url: HOST_URL + '/admin/file/fetch-files',
                type: 'GET',
            },
            "select": {
                'style': 'multi'
            },
            columns: [
                {data: 'id'},
                {data: 'name'},
                {data: 'department_id','field':'department_id'},
                {data: 'desc'},
                {
                    data: "file",
                    render: function ( file_id ) {
                        return file_id ?
                            '<img style="height: 90pcx;width: 90px;" src="'+HOST_URL+"/storage/"+file_id+'"/>' :
                            null;
                    },
                    defaultContent: "No image",
                    title: "File"
                },
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
