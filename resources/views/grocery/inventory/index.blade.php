@extends('template')
@section('main_content')
  <section>
    <div class="main-body hero-section p-0">
      @include('sidebars/stock_side_bar')
      <main class="ms-3 bg-light px-2 py-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Stock</a></li>
            <li class="breadcrumb-item"><a href="#">Inventory List</a></li>
          </ol>
        </nav>

        <div class="container my-5 showAddDiv">
            <div class="card shadow" style="background: rgba(0, 155, 158, 0.1)">
              <div class="card-title">
                <h5 class="ps-4 pt-3">Add Inventories</h5>
              </div>
              <form action="{{ route('grocery.inventory.qty_update') }}" method="post" class="d-inline-block">
  
                @csrf
                <div class="card-body">
                  <div class="row">
                    
                    <input type="hidden" name="mtype">
                    <input type="hidden" name="item_id">
                    <div class="col-lg-4 col-4">
                      <label for="inventory_qty" class="form-control-label">Enter Qty Number</label>
                      <input type="text" name="inventory_qty" class="form-control" id="name" {{ old('inventory_qty') }}>
                      @error('inventory_qty')
                          <span class="text-danger pt-4 mt-5" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>

                    <div class="col-lg-4 col-4">
                        <label for="storage_qty" class="form-control-label">Storage Qty</label>
                        <input type="text" name="storage_qty" class="form-control" id="name" {{ old('storage_qty') }}>
                        @error('storage_qty')
                            <span class="text-danger pt-4 mt-5" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-4 d-flex justify-content-start">
                        <button type="submit" class="btn btn-primary mt-4 float-right form-control">Submit</button>
                      </div>

                  </div>

                </div>
              </form>
            </div>
          </div>


        
        <div class="container">
          <div class="d-inline-block mb-5">
            <h5 class="d-inline">Inventories</h5>
            <a href="{{route('grocery.retail.create')}}" class="btn btn-primary ms-5 d-none">Inventory Stock</a>
          </div>




          <table class="table data-table" id="dataTable">
            <thead>
              <th>No.</th>
              <th>Barcode</th>
              <th>Item</th>
              <th>Inventory Qty</th>
              <th>Storage Qty</th>
              <th>Item Price</th>
              <th>Action</th>
            </thead>
            <tbody>

            </tbody>
          </table>
        </div>
      </main>

    </div>
  </section>
@endsection

@section('script')
<script>
    $(document).ready(function(){

        $('.showAddDiv').addClass('d-none')
        $.fn.dataTable.dtcalled({
            placeholder: "barcode",
            selector:'#dataTable',
            url:{
                'dt_url': "{{route('grocery.ajax.inventories')}}",
                'dt_del': "{{route('grocery.item.destroy',':id')}}",
                'dt_ajax_edit': "{{route('grocery.item.edit',':id')}}",
                'dt_edit': " ",
            },

            columns:[
                {data:'id'},
                {data:'barcode'},
                {data:'item.name'},
                {data:'qty'},
                {data:'storage.qty'},
                {data:'sell_price',render:function(price){
                    return price+' MMK';
                }},
        
            ]

        })

       $('.showAddDiv form').submit(function(e){

            e.preventDefault();
            let formData = $(this).serialize();
             
             $.ajax({
                type: $(this).attr('method'),
                url: $(this).attr('action'),
                data: formData,
                success: function (data) {
                    console.log(data);
                    dtObj.ajax.reload();
                    $('.showAddDiv').addClass('d-none')

                //   alert('success');
                //   window.location.reload();
                },
                error: function (data) {
                    console.log('An error occurred.');
                    console.log(data);
                },
            });
             
         });
    

        $('#dataTable tbody').on('click','.btn-ajax-edit', function(e){
          e.preventDefault();
          let url = $(this).data('url');
          $('.showAddDiv').addClass('d-none');
          $('.showEditDiv').removeClass('d-none');
          $.ajax({
            type:'get' ,
            url:url,
       
            success: function (data) {
                $('.showEditDiv input[name="name"]').val(data.name)
                $('.update_obj').html(data.name)
                $('.showEditDiv input[name="brand"]').val(data.brand)
                $('.showEditDiv select[name="category_id"]').val(data.category_id)
                $('.showEditDiv input[name="id"]').val(data.id)
            },
            error: function (data) {
                console.log('An error occurred.');
                console.log(data);
            },
        });
          
        })
    })

</script>
@endsection

