@extends('template')
@section('main_content')
  <section class="pos_section">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-6 col-6 mt-5 right_border">
          <h4>Product List</h4>
          <hr>
          <div>
            <input type="text" class="form-control" placeholder="search item">
          </div>
          <div class="row mt-4">
            <div class="col-4">
              <div class="card">
                <div class="card-img">
                  <div class="product_list">
                    <img src="{{ asset('template/images/businesswoman-using-tablet-analysis.jpg') }}" alt=""
                      class="img-fluid rounded-start">
                  </div>
                </div>
                <div class="card-title">
                  <h6 class="text-center">Item name</h6>
                </div>
              </div>
            </div>
            <div class="col-4">
              <div class="card">
                <div class="card-img">
                  <div class="product_list">
                    <img src="{{ asset('template/images/businesswoman-using-tablet-analysis.jpg') }}" alt=""
                      class="img-fluid rounded-start">
                  </div>
                </div>
                <div class="card-title">
                  <h6 class="text-center">Item name</h6>
                </div>
              </div>
            </div>
            <div class="col-4">
              <div class="card">
                <div class="card-img">
                  <div class="product_list">
                    <img src="{{ asset('template/images/businesswoman-using-tablet-analysis.jpg') }}" alt=""
                      class="img-fluid rounded-start">
                  </div>
                </div>
                <div class="card-title">
                  <h6 class="text-center">Item name</h6>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-6 mt-5">
          <h4>Shopping Cart List</h4>
          <hr>
          {{-- loop data --}}
          <div style="height: 70vh; overflow-y: scroll">
            <div class="row">
              <div class="col-12 mx-auto">
                <div class="card mb-3 shadow">
                  <div class="row g-0">
                    <div class="col-md-4">
                      <img src="{{ asset('template/images/businesswoman-using-tablet-analysis.jpg') }}" alt=""
                        class="img-fluid rounded-start">
                    </div>
                    <div class="col-md-8 my-0 py-0">
                      <div class="card-body my-0 py-0">
                        <div class="row mt-2">
                          <div class="col-5">
                            <h6 class="card-title d-inline-block">Item name</h6>
                          </div>
                          <div class="col-5">
                            <select name="" id="" class="form-control">
                              <option value="" selected>Log One</option>
                              <option value="">Log Two</option>
                            </select>
                          </div>
                          <div class="col-2">
                            <button class="btn btn-danger btn-sm float-end">
                              <i class="bi bi-bookmark-x-fill"></i>
                            </button>
                          </div>
                        </div>
                        <div class="row mt-2 mb-0 pb-0">
                          <div class="col-3 mt-0 mx-0">
                            <label for="">Qty</label>
                            <input type="text" class="form-control" value="3">
                          </div>
                          <div class="col-3 mt-0 mx-0">
                            <label for="">Price</label>
                            <input type="text" class="form-control" value="3">
                          </div>
                          <div class="col-4 mt-0 mx-0">
                            <label for="">Amount</label>
                            <input type="text" class="form-control" value="100" readonly disabled>
                          </div>

                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-12 mx-auto">
                <div class="card mb-3 shadow">
                  <div class="row g-0">
                    <div class="col-md-4">
                      <img src="{{ asset('template/images/businesswoman-using-tablet-analysis.jpg') }}" alt=""
                        class="img-fluid rounded-start">
                    </div>
                    <div class="col-md-8 my-0 py-0">
                      <div class="card-body my-0 py-0">
                        <div class="row mt-2">
                          <div class="col-5">
                            <h6 class="card-title d-inline-block">Item name</h6>
                          </div>
                          <div class="col-5">
                            <select name="" id="" class="form-control">
                              <option value="" selected>Log One</option>
                              <option value="">Log Two</option>
                            </select>
                          </div>
                          <div class="col-2">
                            <button class="btn btn-danger btn-sm float-end">
                              <i class="bi bi-bookmark-x-fill"></i>
                            </button>
                          </div>
                        </div>
                        <div class="row mt-2 mb-0 pb-0">
                          <div class="col-3 mt-0 mx-0">
                            <label for="">Qty</label>
                            <input type="text" class="form-control" value="3">
                          </div>
                          <div class="col-3 mt-0 mx-0">
                            <label for="">Price</label>
                            <input type="text" class="form-control" value="3">
                          </div>
                          <div class="col-4 mt-0 mx-0">
                            <label for="">Amount</label>
                            <input type="text" class="form-control" value="100" readonly disabled>
                          </div>

                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-12 mx-auto">
                <div class="card mb-3 shadow">
                  <div class="row g-0">
                    <div class="col-md-4">
                      <img src="{{ asset('template/images/businesswoman-using-tablet-analysis.jpg') }}" alt=""
                        class="img-fluid rounded-start">
                    </div>
                    <div class="col-md-8 my-0 py-0">
                      <div class="card-body my-0 py-0">
                        <div class="row mt-2">
                          <div class="col-5">
                            <h6 class="card-title d-inline-block">Item name</h6>
                          </div>
                          <div class="col-5">
                            <select name="" id="" class="form-control">
                              <option value="" selected>Log One</option>
                              <option value="">Log Two</option>
                            </select>
                          </div>
                          <div class="col-2">
                            <button class="btn btn-danger btn-sm float-end">
                              <i class="bi bi-bookmark-x-fill"></i>
                            </button>
                          </div>
                        </div>
                        <div class="row mt-2 mb-0 pb-0">
                          <div class="col-3 mt-0 mx-0">
                            <label for="">Qty</label>
                            <input type="text" class="form-control" value="3">
                          </div>
                          <div class="col-3 mt-0 mx-0">
                            <label for="">Price</label>
                            <input type="text" class="form-control" value="3">
                          </div>
                          <div class="col-4 mt-0 mx-0">
                            <label for="">Amount</label>
                            <input type="text" class="form-control" value="100" readonly disabled>
                          </div>

                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          {{-- submit btn --}}
          <div class="row">
            <div class="col-12 d-block">
              <div class="d-grid gap-2">
                <button class="btn btn-success">Check Out</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
  </section>
@endsection
