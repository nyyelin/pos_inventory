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

        <form method="post" action="{{route('grocery.item.store')}}" class="mt-2 col-10 ">
            @csrf
            <div class="">
                

                <div class="mb-3 ">
                    <label for="name" class="form-label">Name <span class="text-white">*</span></label>
                    <input type="text" class="form-control " id="name" name="name" placeholder="eg: name"> 
                </div>

                <div class="mb-3 ">
                    <label for="category_id" class="form-label">Category <span class="text-white">*</span></label>
                    <select name="category_id" class="form-control" id="category_id">
                        <option selected disabled>Choose Options</option>
                        @foreach($categories as $cat)
                        <option value="{{$cat->id}}">{{$cat->name}}</option>
                        @endforeach
                    </select>
                </div>


                <div class="mb-3 ">
                    <label for="brand" class="form-label">Brand Name (Optional)</label>
                    <input type="text" class="form-control  " id="brand" name="brand" placeholder="eg: CoCa Colar"> 
                </div>

                <div class="mb-3 ">
                    <label for="expired_date" class="form-label">Expired_date (Optional)</label>
                    <input type="date" class="form-control  " id="expired_date" name="expried_date" placeholder=""> 
                </div>
            </div>
            <div class="">
                <div class="mb-3 ">
                    <label for="qty" class="form-label">Quantity/Qty  <span class="text-white">*</span></label>
                    <input type="text" class="form-control  " id="qty" name="qty" placeholder="eg: 234"> 
                </div>

                <!-- <div class="mb-3 ">
                    <label for="sell_price" class="form-label">Stock Package Unit  <span class="text-white">*</span></label>
                    <input type="text" class="form-control  " id="sell_price" placeholder=""> 
                </div> -->


                <div class="mb-3 ">
                    <label for="org_price" class="form-label">Original Price in MMK  <span class="text-white">*</span></label>
                    <input type="text" class="form-control  " id="org_price" name="price" placeholder="eg: 1800"> 
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