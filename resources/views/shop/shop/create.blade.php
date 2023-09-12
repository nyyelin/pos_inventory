@extends('template')
@section('main_content')
  <section>
    <div class="main-body hero-section p-0">
      @include('sidebars/shop_side_bar')
      <main class=" mt-3 ms-3 bg-light">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb ms-3 mt-2">
            <li class="breadcrumb-item"><a href="#">Shop</a></li>
            <li class="breadcrumb-item"><a href="#">New Shop</a></li>
          </ol>
        </nav>

        <div class="container my-5 showAddDiv">
          <div class="card shadow" style="background: rgba(0, 155, 158, 0.1)">
            <div class="card-title">
              <h5 class="ps-4 pt-3">Add New Shop</h5>
            </div>
            <form action="{{ route('shop.shop.store') }}" method="post" class="d-inline-block">
              @csrf
              <div class="card-body">
                <div class="row">
                  <div class="col-lg-6 col-6">
                    <label for="name" class="form-control-label">User Name</label>
                    <input type="text" name="name" class="form-control mb-2" id="name" {{ old('name') }}>
                    @error('name')
                      <span class="text-danger pt-4 mt-5" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="col-lg-6 col-6">
                    <label for="shop_name" class="form-control-label">Shop Name</label>
                    <input type="text" name="shop_name" class="form-control mb-2" id="shop_name"
                      value="{{ old('shop_name') }}">
                    @error('shop_name')
                      <span class="text-danger pt-4 mt-5" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
{{-- 
                  <div class="col-lg-6 col-6">
                    <label for="shop_phone" class="form-control-label">Shop Phone</label>
                    <input type="text" name="shop_phone" class="form-control mb-2" id="shop_phone"
                      value="{{ old('shop_phone') }}">
                    @error('shop_phone')
                      <span class="text-danger pt-4 mt-5" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div> --}}
                </div>

                <div class="row my-2">
                  <div class="col-lg-6 col-6">
                    <label for="email" class="form-control-label">User Email</label>
                    <input type="email" name="email" class="form-control mb-2" id="email" {{ old('email') }}>
                    @error('email')
                      <span class="text-danger pt-4 mt-5" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="col-lg-6 col-6">
                    <label for="shop_phone" class="form-control-label">Shop Phone</label>
                    <input type="number" name="shop_phone" class="form-control mb-2" id="shop_phone"
                      {{ old('shop_phone') }}>
                    @error('shop_phone')
                      <span class="text-danger pt-4 mt-5" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>

                </div>

                <div class="row my-2">
                  <div class="col-lg-6 col-6">
                    <label for="user_phone" class="form-control-label">User Phone</label>
                    <input type="number" name="user_phone" class="form-control mb-2" maxlength="8" id="user_phone">
                    @error('user_phone')
                      <span class="text-danger pt-4 mt-5" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="col-lg-6 col-4">
                    <label for="tax" class="form-control-label">Tax</label>
                    <input type="text" name="tax" class="form-control mb-2" id="tax"
                      value="{{ old('tax') }}">
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6 col-6">
                    <label for="password" class="form-control-label">Password</label>
                    <input type="password" name="password" class="form-control mb-2" id="password">
                    @error('password')
                      <span class="text-danger pt-4 mt-5" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="col-lg-6 col-6">
                    <label for="shop_address" class="form-control-label">Shop Address</label>
                    <textarea name="shop_address" id="shop_address" class="form-control mb-2">
                        {{ old('shop_address') }}
                    </textarea>
                    @error('shop_address')
                      <span class="text-danger pt-4 mt-5" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-4 col-4 mx-auto">
                    <div class="d-grid gap-2">
                      <button type="submit" class="btn btn-primary mt-4 py-2" style="max-width: 100%"> <i class="bi bi-plus-circle pe-2"></i>Add</button>
                    </div>
                  </div>
                </div>

              </div>
            </form>
          </div>
        </div>
      </main>

    </div>
  </section>
@endsection


@section('script')
  <script>
    $('document').ready(function() {
      var table = $('.data-table').DataTable()
    })
  </script>
@endsection
