@extends('template')
@section('main_content')
<section>
    
    <div class="main-body hero-section p-0">
    @include('sidebars/stock_side_bar')
        

        <main class="m-3">
    
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

        <h5 class="text-white">Adding New Item </h5>
        <span>Please Fill the following information</span>

        <form action="" class="mt-5 col-12 offest-2 row">
            <div class="col-6">

                <div class="mb-3 ">
                    <label for="exampleFormControlTextarea1" class="form-label">Expired Date</label>
                    <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com"> 
                </div>

            </div>
            <div class="col-6">
                <div class="mb-3 ">
                    <label for="exampleFormControlTextarea1" class="form-label">Expired Date</label>
                    <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com"> 
                </div>
            </div>

            
        </form>



        
        </main>
    </div>
    


</section>
@endsection
