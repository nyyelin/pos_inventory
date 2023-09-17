@extends('template')
@section('main_content')
  <section>
    <div class="main-body hero-section p-0">
      @include('sidebars/report_side_bar')
      <main class=" ms-3 bg-light px-2 py-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Report</a></li>
            <li class="breadcrumb-item"><a href="#">Retail List</a></li>
          </ol>
        </nav>


        
        <div class="container">
          <div class="d-flex mb-5 justify-content-between align-items-center">
            <h5 class="">Retail  Report</h5>
            
          </div>

          <table class="table data-table" id="dataTable">
            <thead>
              <th>No.</th>
              <th>Date</th>
              <th>Storage</th>
              <th>Item</th>
              <th>Price</th>              
              <th>Total Qty</th>                  
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
                'dt_url': "{{route('report.ajax.retails')}}",
                'dt_del': "{{route('grocery.item.destroy',':id')}}",
                'dt_ajax_edit': "{{route('grocery.item.edit',':id')}}",
                'dt_detail': "{{route('report.order.detail',':id')}} ",
            },

            columns:[
                {data:'id'},
                {data:'created_at', render:function(c_date){
                  let data = new Date(c_date);
                  return data.getDate()+'-'+(data.getMonth()+1)+'-'+data.getFullYear();
                }},
                {data:'storage',render:function(stg){
                  return stg.prefix+stg.serial;
                }},
                {data:'item.name'},
                {data:'buy_price'},
                {data:'qty'},
               
               
                
                
                 
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

