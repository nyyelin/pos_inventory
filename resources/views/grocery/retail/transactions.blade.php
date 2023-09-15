@extends('template')
@section('main_content')
<section>
    
    <div class="main-body hero-section p-0">
    @include('sidebars/stock_side_bar')
        <main class=" mt-3 mx-3">
        
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Stock</a></li>
                    <li class="breadcrumb-item"><a href="#">Stock Transactions</a></li>
                </ol>
            </nav>

       

            <div class="container">
                <div class="d-flex mb-5 justify-content-between align-items-center">
                    <h5 class="">Stock Transactions Report</h5>
                    <!-- <button class="btn custom-btn ms-5 active ">Add New Product</button> -->
                </div>

                <table class="table data-table" id="dataTable">
                    <thead>
                        <tr>
                        
                        <th scope="col">Date</th>
                        <th scope="col">Name</th>
                        <th scope="col">Code</th>
                        <th scope="col">Category</th>
                        <th scope="col">Stock Qty</th>
                        <th scope="col">Expired_date</th>
                        <th scope="col">Actions</th>
                        </tr>
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
                'dt_detail': "{{route('grocery.item.show',':id')}}"
            },

            columns:[
                
                {data:'created_at',render:function(str_date){
                    let date_obj =  new Date(str_date);
                    return `${date_obj.getDate()}-${date_obj.getMonth()+1}-${date_obj.getFullYear()}`;
                }},
                {data:'item.name'},
                {data:'item.bar_code'},
                {data:'category_name'},
                
                {data:'qty', render: function(sum){
                    return `<span class="badge bg-white text-dark rounded-pill ms-auto fs-6">${sum}</span>`
                }},
                {data:'expired_date',render:function(str_date){
                    
                    if(str_date != null){
                        let date_obj =  new Date(str_date);
                    return `${date_obj.getDate()}-${date_obj.getMonth()+1}-${date_obj.getFullYear()}`;
                    }
                    return '-'
                   
                }},
                 
            ]

        })
    })

</script>
@endsection

