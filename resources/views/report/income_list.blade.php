@extends('template')
@section('main_content')
  <section>
    <div class="main-body hero-section p-0">
      @include('sidebars/report_side_bar')
      <main class=" ms-3 bg-light px-2 py-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Report</a></li>
            <li class="breadcrumb-item"><a href="#">Order List</a></li>
          </ol>
        </nav>


        
        <div class="container">
          <div class="d-flex mb-5 justify-content-between align-items-center">
            <h5 class="">Order  Report</h5>
            <a href="{{route('pos.index')}}" class="d-block btn btn-primary ms-5">POS Section</a>
          </div>

          <table class="table data-table" id="dataTable">
            <thead>
              <th>No.</th>
              <th>Date</th>
              <th>OrderNo</th>
              <th>Qty</th>
              <th>Total Price</th>
              
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

