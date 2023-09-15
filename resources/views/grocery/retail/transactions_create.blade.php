@extends('template')
@section('main_content')
<section>
    
    <div class="main-body hero-section p-0">
    @include('sidebars/stock_side_bar')
        

        <main class="ms-5 my-3" style="overflow:hidden;">
    
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Stock</a></li>
                <li class="breadcrumb-item"><a href="#">New Item</a></li>
            
            </ol>
        </nav>

        <!-- Card section  -->
        <!-- <div class="card border-0 shadow ">
            <h5 class="card-header bg-white py-3 px-4 fs-4 border-0"> New Item Page</h5>
            
            <div class="card-body px-4">
                <h5 class="card-title">Fill this Information</h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div> -->

        <h5 class="text-white">Adding New Product </h5>
        <span>Please Fill the following information</span>

        <form method="post" action="{{route('grocery.stock-transactions.store')}}" class="mt-2 col-10 ">
            @csrf
            <div class="">
                
                <div class="mb-3 ">
                    <label for="item_id" class="form-label">Item Name <span class="text-white">*</span></label>
                    <select name="item_id" class="form-control" id="item_id">
                        <option selected disabled>Choose Options</option>
                        @foreach($items as $item)
                        <option value="{{$item->id}}" data-sum="{{$item->stocks_sum_qty}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>


                <div class="mb-3 ">
                    <label for="current_qty" class="form-label">Remaining Qty</label>
                    <input type="number" class="form-control  " id="current_qty" name="current_qty" value="0" readOnly > 
                </div>

                <div class="mb-3 ">
                    <label for="new_qty" class="form-label">New Qty</label>
                    <input type="number" class="form-control  " id="new_qty" name="new_qty" value=0 placeholder="eg: 34"> 
                </div>

                <div class="mb-3 ">
                    <label for="total_qty" class="form-label">Total Qty</label>
                    <input type="number" class="form-control  " id="total_qty" name="total_qty"  placeholder="remain + new = total"> 
                </div>
            </div>
            <div class="">
            
                <div class="mb-3 ">
                    <label for="expired_date" class="form-label">Expired_date <span class="text-white">*</span></label>
                    <input type="date" class="form-control  " id="expired_date" name="expired_date" placeholder=""> 
                </div>

                <div class="mb-3 ">
                    <label for="price" class="form-label">Original Price in MMK  <span class="text-white">*</span></label>
                    <input type="text" class="form-control  " id="price" name="price" placeholder="eg: 2000"> 
                </div>

                <div class="mb-3 ">
                    <label for="sell_price" class="form-label">Sell Price in MMK  <span class="text-white">*</span></label>
                    <input type="text" class="form-control  " id="sell_price" name="sell_price" placeholder="eg: 2000"> 
                </div>

                <div class="mb-3 ">
                    <button class="btn custom-btn form-control ">Save</button>
                </div>


            </div>

            
        </form>



        
        </main>
    </div>
    


</section>
@endsection
@section('script')
<script>
    $('document').ready(function(){
        $('select[name="item_id"]').change(function(){
            let remain = $('select[name="item_id"] option:selected').data('sum');
            $('input[name="current_qty"]').attr('readOnly', false);
            $('input[name="current_qty"]').val(remain);
            $('input[name="current_qty"]').attr('readOnly', true);
        })
        $('input[name="total_qty"]').click(function(){
            let remain = parseInt($('input[name="current_qty"]').val());
            let new_qty = parseInt($('input[name="new_qty"]').val());
            
            $(this).val(remain + new_qty);
        })
    })
</script>
@endsection