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
              <h5 class="ps-4 pt-3">New Product</h5>
            </div>
            <form action="{{ route('grocery.item.store') }}" method="post" class="d-inline-block">

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
                    <label for="brand" class="form-control-label">Brand</label>
                    <input type="text" name="brand" class="form-control" id="name" {{ old('brand') }}>
                    @error('brand')
                        <span class="text-danger pt-4 mt-5" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                  
                  <div class="col-lg-4 col-4">
                    <label for="category_id" class="form-control-label">Category</label>
                    <select name="category_id" id="category_id" class="form-control">
                      <option value="">Select Category</option>
                      @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                      @endforeach
                    </select>
                    @error('category_id')
                        <span class="text-danger pt-4 mt-5" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                 
                </div>
                <div class="col-12 d-flex justify-content-end">
                  <button type="submit" class="btn btn-primary mt-4 float-right form-control">Add to List</button>
                </div>
              </div>
            </form>
          </div>
        </div>

        {{-- edit form --}}

        <div class="container my-5  showEditDiv">
          <div class="card shadow" style="background: rgba(0, 155, 158, 0.1)">
            <div class="card-title">
              <h5 class="ps-4 pt-3">Update Category <span class="update_obj"></span></h5>
            </div>
            <form action="" method="post" class="d-inline-block" id="editForm">
              @csrf
              @method('PATCH')
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
                    <label for="brand" class="form-control-label">Brand</label>
                    <input type="text" name="brand" class="form-control" id="name" {{ old('brand') }}>
                    @error('brand')
                        <span class="text-danger pt-4 mt-5" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                  <input type="hidden" name="id">
                  
                  <div class="col-lg-4 col-4">
                    <label for="category_id" class="form-control-label">Category</label>
                    <select name="category_id" id="category_id" class="form-control">
                      <option value="">Select Category</option>
                      @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                      @endforeach
                    </select>
                    @error('category_id')
                        <span class="text-danger pt-4 mt-5" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                 
                </div>
                <div class="col-12 d-flex justify-content-end">
                  <button type="submit" class="btn btn-primary mt-4 float-right form-control">Update list</button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="container">
          <div class="d-inline-block mb-5">
            <h5 class="d-inline">Category List</h5>
            <button class="btn btn-primary ms-5 d-none">Add Category</button>
          </div>

          <table class="table data-table" id="dataTable">
            <thead>
              <th>No.</th>
              <th>Name</th>
              <th>Category</th>
              <th>Action</th>
            </thead>
            <tbody>

            </tbody>
          </table>
        </div>
      </main>

    </div>
  </section>
@endsection

@section('script')
<script>
    $(document).ready(function(){

      $('.showEditDiv').addClass('d-none');

      $('.showAddDiv form').submit(function(e){
        e.preventDefault();
        let formData = $(this).serialize();
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
      })


      $('.showEditDiv form').submit(function(e){
        e.preventDefault();
        let formData = $(this).serialize();
        
         let id = $(`.showEditDiv input[name='id']`).val();
         url ="{{route('grocery.item.update',':id')}}";
         url = url.replace(':id', id);
         
       
         $.ajax({
          type: 'PUT',
          url: url,
          data: formData,
          success: function (data) {
            alert('success');
            window.location.reload();
          },
          error: function (data) {
              console.log('An error occurred.');
              console.log(data);
          },
      });
      })

      


        $.fn.dataTable.dtcalled({
            placeholder: "name",
            selector:'#dataTable',
            url:{
                'dt_url': "{{route('grocery.ajax.items')}}",
                'dt_del': "{{route('grocery.item.destroy',':id')}}",
                'dt_ajax_edit': "{{route('grocery.item.edit',':id')}}",
                'dt_edit': " ",
                'dt_qty_inc':"",
                'dt_qty_dec':"",
            },

            columns:[
                {data:'id'},
                {data:'name'},
                {data:'category.name'},
               
                
                
                 
            ]

        })

        $('#dataTable tbody').on('click','.btn-ajax-edit', function(e){
          e.preventDefault();
          let url = $(this).data('url');
          $('.showAddDiv').addClass('d-none');
          $('.showEditDiv').removeClass('d-none');
          $.ajax({
            type:'get' ,
            url:url,
       
            success: function (data) {
                $('.showEditDiv input[name="name"]').val(data.name)
                $('.update_obj').html(data.name)
                $('.showEditDiv input[name="brand"]').val(data.brand)
                $('.showEditDiv select[name="category_id"]').val(data.category_id)
                $('.showEditDiv input[name="id"]').val(data.id)
            },
            error: function (data) {
                console.log('An error occurred.');
                console.log(data);
            },
        });
          
        })
    })

</script>
@endsection

