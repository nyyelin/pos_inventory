@extends('template')
@section('main_content')
<section>
    
    <div class="main-body hero-section p-0">
    @include('sidebars/stock_side_bar')
        <main class=" mt-3 ms-3">
        
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Stock</a></li>
                <li class="breadcrumb-item"><a href="#">New Item</a></li>
            </ol>
        </nav>

        
        </main>
    </div>
    


</section>
@endsection
