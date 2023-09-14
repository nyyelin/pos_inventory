@extends('template')
@section('main_content')
<section>
    
    <div class="main-body hero-section p-0">
    @include('sidebars/stock_side_bar')
        <main class=" mt-3 mx-3">
        
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Stock</a></li>
                    <li class="breadcrumb-item"><a href="#">Product List</a></li>
                </ol>
            </nav>

       

            <div class="container">
                <div class="d-flex mb-5 justify-content-between align-items-center">
                    <h5 class="">Product List</h5>
                    <button class="btn custom-btn ms-5 active ">Add New Product</button>
                </div>

                <table class="table data-table" id="dataTable">
                    <thead>
                        <tr>
                        
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Category</th>
                        <th scope="col">Code</th>
                        <th scope="col">Stock Qty</th>
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
                'dt_url': "{{route('grocery.ajax.items')}}",
                'dt_del': "{{route('grocery.item.destroy',':id')}}",
                'dt_edit': "{{route('grocery.item.edit',':id')}}"
            },

            columns:[
                {data:'id'},
                {data:'name'},
                {data:'category.name'},
                {data:'bar_code'},
                {data:'stocks_sum_qty', render: function(sum){
                    return `<span class="badge bg-white text-dark rounded-pill ms-auto fs-6">${sum}</span>`
                }},
                 
            ]

        })
    })

</script>
@endsection

@section('scripts')
<script>
    $('document').ready(function(){
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax:"{{route('grocery.item.index')}}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name'},
                {data: 'category', name: 'category'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
        $('.data-table tbody').on('click','.remove', function(){
           let ans = confirm('Are you sure?');
           if(ans){

           }
        })
        
        })


</script>
@endsection 
