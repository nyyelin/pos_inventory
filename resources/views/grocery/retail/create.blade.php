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

        <form method="post" action="{{route('grocery.retail.store')}}" class="mt-2 col-10 ">
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

                <div class="row">
                    <div class="mb-3 col ">
                        <label for="total_qty" class="form-label">Total Qty</label>
                        <input type="number" class="form-control  " id="total_qty" name="total_qty"  placeholder=""> 
                    </div>
                    <div class="mb-3 col ">
                        <label for="inventory" class="form-label">Inventory Qty</label>
                        <input type="number" class="form-control  " id="inventory" name="inventory" value="0"  > 
                    </div>
    
                    <div class="mb-3 col ">
                        <label for="storage_qty" class="form-label">Storage Qty</label>
                        <input type="number" class="form-control  " id="storage_qty" name="storage_qty" value=0 placeholder="eg: 34"> 
                    </div>
                </div>



                <div class="mb-3 ">
                    <label for="buy_price" class="form-label">Retail Price per one (MMK)</label>
                    <input type="number" class="form-control  " id="buy_price" name="buy_price"  placeholder=""> 
                </div>

                <div class="mb-3 ">
                    <label for="sell_price" class="form-label">Inventory Price per one (MMK)</label>
                    <input type="number" class="form-control  " id="sell_price" name="sell_price"  placeholder=""> 
                </div>


            </div>
            <div class="">
            
                <div class="mb-3 ">
                    <label for="expired_date" class="form-label">Expired_date <span class="text-white">*</span></label>
                    <input type="date" class="form-control  " id="expired_date" name="expired_date" placeholder=""> 
                </div>



                <div class="mb-3 ">
                    <button class="btn btn-warning rounded form-control ">Save</button>
                </div>
                <div class="mb-3 ">
                    <button class="btn  btn-secondary rounded form-control ">Cancel</button>
                </div>


            </div>

            
        </form>

        {{-- table start  --}}

    
        </main>
    </div>
    


</section>
@endsection
@section('script')
<script>
    $('document').ready(function(){

        //fetch the qty
        {{-- $('select').change(function(){
           
           let id = $(this).val();

           $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: $(this).serialize(),
            success: function (data) {
                console.log('Submission was successful.');
                console.log(data);
            },
            error: function (data) {
                console.log('An error occurred.');
                console.log(data);
            },
        });
          
          }) --}}


    })
</script>
@endsection