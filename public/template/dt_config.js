var configs = null;
var dtSelector = null;
var dtObj = null;

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


$.fn.dataTable.Api.register("clearPipeline()", function () {
    return this.iterator("table", function (settings) {
        settings.clearCache = true;
    });
});

$.fn.dataTable.dtcalled = function (config) {
    dtSelector = config.selector;


    console.log(config.columns);

     dtObj = $(dtSelector).DataTable({
         bSort: false,
         ordering: false,
         processing: true,
         serverSide: true,
         deferRender: true,
         targets: "no-sort",
         destroy: true,
         responsive: false,
         language: {
             searchPlaceholder: config.hasOwnProperty("placeholder")
                 ? config.placeholder
                 : "",
         },
         ajax: {
             type: "post",
             url: config.url.dt_url,
         },
         columns: [
             ...config.columns,
             {
                 data: "action",
                 render: function (data, type, row) {
                     let buttons = "";

                     if (data.canEdit === true) {
                         let url = config.url.dt_edit.replace(":id", row.id);
                         buttons += `<a class="btn btn-warning" href="${url}"
                            data-bs-toggle="tooltip" data-bs-placement="left" title="">
                            <i class="fa fa-edit" aria-hidden="true"></i></a>`;
                     }

                     if (data.canDelete === true) {
                         let url = config.url.dt_del.replace(":id", row.id);
                         buttons += `&nbsp;<a class="btn btn-danger btn-delete" href="#" 
                         data_url="${config.url.dt_del}"
                          data-id="${row.id}"
                            data-bs-toggle="tooltip" data-bs-placement="right" title=""><i class="fa fa-trash" aria-hidden="true"></i></a>`;
                     }

                     if (data.canDetail === true) {
                        let url = config.url.dt_detail.replace(":id", row.id);
                        buttons += `&nbsp;<a class="btn btn-primary btn-detail" href="#" 
                        data_url="${config.url.dt_detail}"
                         data-id="${row.id}"
                           data-bs-toggle="tooltip" data-bs-placement="right" title=""><i class="fa fa-info" aria-hidden="true"></i></a>`;
                    }

                     return buttons;
                 },
             },
         ],
         "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {                
            
                $(nRow).addClass('text-white');
                      
        },
     });

     $(`${dtSelector} tbody`).on("click", '.btn-delete', function () {
        let id = $(this).data('id');
        
         swal.fire({
             title: "Delete?",
             icon: "question",
             text: "Please ensure and then confirm!",
             type: "warning",
             showCancelButton: !0,
             confirmButtonText: "Yes, delete it!",
             cancelButtonText: "No, cancel!",
             reverseButtons: !0,
         }).then(function (e) {
             if (e.value == true) {
                 $.ajax({
                     url: config.url.dt_del.replace(":id", id),
                     type: "DELETE",
                     success: function (results) {
                         swal.fire("Done!");
                         dtObj.clearPipeline().draw();
                     },
                     error: function (error) {
                         swal.fire("Error!");
                     },
                 });
             }
         });
     });
};



