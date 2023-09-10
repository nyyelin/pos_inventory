@extends('template')
@section('main_content')
  <section>
    <div class="main-body hero-section p-0">
      @include('sidebars/stock_side_bar')
      <main class=" mt-3 ms-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Stock</a></li>
            <li class="breadcrumb-item"><a href="#">Category List</a></li>
          </ol>
        </nav>


        {{-- add form --}}

        <div class="container my-5 showAddDiv">
          <div class="card shadow" style="background: rgba(0, 155, 158, 0.1)">
            <div class="card-title">
              <h5 class="ps-4 pt-3">Add Category</h5>
            </div>
            <form action="{{ route('grocery.category.store') }}" method="post" class="d-inline-block">
              @csrf
              <div class="card-body">
                <div class="row">
                  <div class="col-lg-4 col-4">
                    <label for="name" class="form-control-label">Name</label>
                    <input type="text" name="name" class="form-control" id="name" {{ old('name') }}>
                    @error('name')
                        <span class="text-danger pt-4 mt-5" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                  <div class="col-lg-4 col-4">
                    <label for="shop" class="form-control-label">Shop</label>
                    <select name="shop" id="shop" class="form-control">
                      <option value="">Select Shop</option>
                      @foreach ($shops as $shop)
                        <option value="{{ $shop->id }}">{{ $shop->name }}</option>
                      @endforeach
                    </select>
                    @error('shop')
                        <span class="text-danger pt-4 mt-5" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                  <div class="col-lg-4 col-4">
                    <button type="submit" class="btn btn-primary mt-4">Add</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>

        {{-- edit form --}}

        <div class="container my-5 showAddDiv showEditDiv">
          <div class="card shadow" style="background: rgba(0, 155, 158, 0.1)">
            <div class="card-title">
              <h5 class="ps-4 pt-3">Edit Category</h5>
            </div>
            <form action="" method="post" class="d-inline-block" id="editForm">
              @csrf
              @method('PATCH')
              <div class="card-body">
                <div class="row">
                  <input type="hidden" name="id" id="edit_id" value="{{ old('id') }}">
                  <input type="hidden" id="edit_old_shop" value="{{ old('edit_shop') }}">
                  <div class="col-lg-4 col-4">
                    <label for="edit_name" class="form-control-label">Name</label>
                    <input type="text" name="edit_name" class="form-control" id="edit_name" value="{{ old('edit_name') }}">
                    @error('edit_name')
                        <span class="text-danger pt-4 mt-5 edit_name_error" role="alert" data-message="{{ $message }}">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                  <div class="col-lg-4 col-4">
                    <label for="edit_shop" class="form-control-label">Shop</label>
                    <select name="edit_shop" id="edit_shop" class="form-control">
                      <option value="">Select Shop</option>
                      @foreach ($shops as $shop)
                        <option value="{{ $shop->id }}">{{ $shop->name }}</option>
                      @endforeach
                    </select>
                    @error('edit_shop')
                        <span class="text-danger pt-4 mt-5 edit_shop_error" role="alert" data-message="{{ $message }}">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                  <div class="col-lg-4 col-4">
                    <button type="submit" class="btn btn-primary mt-4">Update</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="container">
          <div class="d-inline-block mb-5">
            <h5 class="d-inline">Category List</h5>
            <button class="btn btn-primary ms-5 showBtn">Add Category</button>
          </div>

          <table class="table data-table">
            <thead>
              <th>No.</th>
              <th>Name</th>
              <th>Shop</th>
              <th>Action</th>
            </thead>
            <tbody>
              @foreach ($categories as $key => $category)
                <tr class="text-white">
                  <td>{{ $key + 1 }}</td>
                  <td>{{ $category->name }}</td>
                  <td>{{ $category->shop->name }}</td>
                  <td>
                    <button class="btn btn-warning editBtn" data-id="{{ $category->id }}"
                      data-name="{{ $category->name }}" data-shop="{{ $category->shop_id }}">Edit</button>
                    <form action="{{ route('grocery.category.destroy', $category->id) }}" method="post" class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">Delete</button>
                    </form>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </main>

    </div>
  </section>
@endsection


@section('script')
  <script>
    $('document').ready(function() {
      var table = $('.data-table').DataTable()
      
      var edit_name_error = $('.edit_name_error').data('message')
      var edit_shop_error = $('.edit_shop_error').data('message')

      var oldid = $('#edit_id').val()
      var oldname = $('#edit_name').val()
      var oldshop = $('#edit_old_shop').val()

      if(edit_name_error || edit_shop_error){
        $('.showAddDiv').hide();
        $('.showEditDiv').show();
        $('.showBtn').show();
        passEidtData(oldid, oldname, oldshop)

      } else {
        $('.showAddDiv').show();
        $('.showEditDiv').hide();
        $('.showBtn').hide();
      }

      $('.showBtn').click(function() {
        $('.showAddDiv').show(1000);
        $('.showEditDiv').hide(1000);
        $('.showBtn').hide(1000);
      })

      $('.editBtn').click(function() {
        $('.showAddDiv').hide(1000);
        $('.showEditDiv').show(1000);
        $('.showBtn').show(1000)

        var id = $(this).data('id');
        var name = $(this).data('name');
        var shop_id = $(this).data('shop');
        
        passEidtData(id, name, shop_id)
      })

      function passEidtData(id, name, shop_id){
        console.log(id, name, shop_id)
        var url = `{{ route('grocery.category.update', ':id') }}`
        url = url.replace(':id', id)

        $('#edit_id').val(id);
        $('#edit_name').val(name)
        $('#edit_shop').val(shop_id)
        console.log(url)
        $('#editForm').attr('action', url)
      }
    })
  </script>
@endsection
