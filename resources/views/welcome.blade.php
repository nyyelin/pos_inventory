@extends('template')
@section('main_content')

<section class="hero-section d-flex justify-content-center align-items-center" id="section_1" style="height: 100vh">
    <div class="container">
        <div class="row">

            <div class="col-lg-5 col-12 text-center mx-auto">
                <div class="custom-block shadow-lg">
                    <h6>REPORT</h6>
                </div>
            </div>
            <div class="col-lg-5 col-12 text-center mx-auto">
                <div class="custom-block shadow-lg">
                    <a class="fs-4 fw-bold" href="{{route('grocery.index')}}">Stock</a>
                </div>
            </div>

            </div>
            <div class="row mt-4">
            <div class="col-lg-5 col-12 text-center mx-auto">
                <div class="custom-block shadow-lg">
                    <h6>POS</h6>
                </div>
            </div>
            <div class="col-lg-5 col-12 text-center mx-auto">
                <div class="custom-block shadow-lg">
                    <a class="fs-4 fw-bold" href="{{route('shop.shop.index')}}">SHOP</a>
                </div>
            </div>
        </div>
    </div>
</section>




@endsection