@extends('template')
@section('main_content')
  <section>
    <div class="main-body hero-section p-0">
      @include('sidebars/stock_side_bar')
      <main class=" ms-3 bg-light px-2 py-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Stock</a></li>
            <li class="breadcrumb-item"><a href="#">Retail List</a></li>
          </ol>
        </nav>


        
        <div class="container">
          <div class="d-inline-block mb-5">
            <h5 class="d-inline">Retail Transaction List</h5>
            <a href="{{route('grocery.retail.create')}}" class="btn btn-primary ms-5">Refilling Stock</a>
          </div>

          <table class="table data-table" id="dataTable">
            <thead>
              <th>No.</th>
              <th>Restock Date</th>
              <th>Item</th>
              <th>Qty</th>
              <th>Price</th>
              <th>Total</th>
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



     
      


        $.fn.dataTable.dtcalled({
            placeholder: "name",
            selector:'#dataTable',
            url:{
                'dt_url': "{{route('grocery.ajax.stock.trans')}}",
                'dt_del': "{{route('grocery.item.destroy',':id')}}",
                'dt_ajax_edit': "{{route('grocery.item.edit',':id')}}",
                'dt_edit': " ",
            },

            columns:[
                {data:'id'},
                {data:'created_at'},
                {data:'item.name'},
                {data:'qty'},
                {data:'buy_price'},
                {data:'total_amount'},
               
                
                
                 
            ]

        })

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

