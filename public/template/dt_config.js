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

                     if(data.canAjaxEdit === true){
                        let url = config.url.dt_ajax_edit.replace(":id", row.id);
                        buttons += `<a class="btn btn-warning btn-ajax-edit" click="return false;" data-url="${url}"
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

                    if (data?.canQtyInc === true) {
                        
                        buttons += `&nbsp;<a class="btn btn-primary btn-qtyupdate" data-mtype="inc" href="#" 
                        data-invqty=${row.qty} data-stgqty=${row.storage.qty} data-name=${row.name} data-barcode=${row.barcode}
                         data-id="${row.id}"
                           data-bs-toggle="tooltip" data-bs-placement="right" title=""><i class="fa fa-plus" aria-hidden="true"></i></a>`;
                    }

                    if (data?.canQtyDec === true) {
                       
                        buttons += `&nbsp;<a class="btn btn-warning btn-qtyupdate" data-mtype="decs" href="#" 
                        data-invqty=${row.qty} data-stgqty=${row.storage.qty} data-name=${row.name} data-barcode=${row.barcode}
                         data-id="${row.id}"
                           data-bs-toggle="tooltip" data-bs-placement="right" title=""><i class="fa fa-minus" aria-hidden="true"></i></a>`;
                    }

                     return buttons;
                 },
             },
         ],
         "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {                
            
                $(nRow).addClass('text-dark');
                      
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


    
    $(`${dtSelector} tbody`).on("click", '.btn-qtyupdate', function (e) {
        e.preventDefault();

        $('.showAddDiv').removeClass('d-none')
      
         let invqty = $(this).data('invqty')
         let stgqty = $(this).data('stgqty')
         let name = $(this).data('name')
         let barcode = $(this).data('barcode')
         let id = $(this).data('id')
         let mtype = $(this).data('mtype')
         

         
         $('input[name="storage_qty"]').val(stgqty)
         $('input[name="storage_qty"]').attr('readOnly',true)
         $('input[name="item_id"]').val(id)
         $('input[name="mtype"]').val(mtype)
         if(mtype == 'inc'){
            $('.card-title h5').text('Adding Inventroy Qty from storage -'+barcode);
         }else{
            $('.card-title h5').text('Adding Inventroy Qty to storage -'+barcode);
         }
       
         
     });
};



