@extends('template')
@section('main_content')
  <section class="justify-content-center align-items-center" id="section_1"
    style="height: 100vh;">

    <div class="container mt-5" style="padding-top: 180px !important">

      <div class="row">

        <div class="col-lg-5 col-12 text-center mx-auto mt-3">
          <div class="custom-block shadow-lg">
            <h6>REPORT</h6>
          </div>
        </div>
        <div class="col-lg-5 col-12 text-center mx-auto mt-3">
          <div class="custom-block shadow-lg">
            <a class="fs-4 fw-bold" href="{{ route('grocery.index') }}">Stock</a>
          </div>
        </div>

      </div>
      <div class="row mt-3">
        <div class="col-lg-5 col-12 text-center mx-auto">
          <div class="custom-block shadow-lg">
            <a class="fs-4 fw-bold" href="#">POS</a>
          </div>
        </div>
        @role('admin')
          <div class="col-lg-5 col-12 text-center mx-auto">
            <div class="custom-block shadow-lg">
              <a class="fs-4 fw-bold" href="{{ route('shop.shop.index') }}">SHOP</a>
            </div>
          </div>
        @endrole
      </div>
    </div>
  </section>
@endsection
