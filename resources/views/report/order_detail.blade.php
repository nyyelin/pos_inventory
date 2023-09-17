@extends('template')
@section('main_content')
  <section>
    <div class="main-body hero-section p-0">
      @include('sidebars/report_side_bar')
      <main class=" ms-3 bg-light px-2 py-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Report</a></li>
            <li class="breadcrumb-item"><a href="#">Order-{{$order->code}}</a></li>
            <li class="breadcrumb-item"><a href="#">Order-Detail</a></li>
          </ol>
        </nav>


        
        <div class="container">
          <div class="d-flex justify-content-between align-items-center mb-5">
            <h5 class="">Order Detail For Code-{{$order->code}}</h5>
            <p>Shopping Date: {{$order->shopping_date}}</p>
            <a href="{{route('report.sales')}}" class="d-block btn btn-primary ms-5">Back to List</a>
          </div>

          <table class="table data-table" id="">
            <thead>
              <th>#</th>
              <th>Item</th>
              <th>BarCode</th>
              <th>Storage</th>
              <th>Qty</th>
              <th>Price</th>
              <th>total Amount</th>
              
            </thead>
            <tbody>
                @foreach($items as $k => $item)
                
                <tr>
                    <td>{{$k + 1}}</td>
                    <td>{{$item->item->name}}</td>
                    <td>{{$item->inventory()->barcode}}</td>
                    <td>{{$item->stg_prefix}}{{$item->stg_serial}}</td>
                    <td>{{$item->qty}}</td>
                    <td>{{$item->sell_price}} MMK</td>
                    <td>{{$item->qty * $item->sell_price}} MMK</td>
                </tr>
                @endforeach

                <tr>
                    
                    <td colspan="6" align="right">Total Payment</td>
                    <td>{{$item->qty * $item->sell_price}}  MMK</td>
                </tr>
               

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
                'dt_url': "{{route('report.ajax.order')}}",
                'dt_del': "{{route('grocery.item.destroy',':id')}}",
                'dt_ajax_edit': "{{route('grocery.item.edit',':id')}}",
                'dt_detail': "{{route('report.order.detail',':id')}} ",
            },

            columns:[
                {data:'id'},
                {data:'shopping_date'},
                {data:'code'},
                {data:'total_qty'},
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

