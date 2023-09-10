@extends('template')
@section('main_content')
  <section>
    <div class="main-body hero-section p-0">
      @include('sidebars/shop_side_bar')
      <main class=" mt-3 ms-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Shop</a></li>
            <li class="breadcrumb-item"><a href="#">Shop List</a></li>
          </ol>
        </nav>
        <div class="container">
          <div class="d-inline-block mb-5">
            <h5 class="d-inline">Shop List</h5>
          </div>

          <table class="table data-table">
            <thead>
              <th>No.</th>
              <th>Shop Name</th>
              <th>User Name</th>
              <th>Phone</th>
              <th>Address</th>
              <th>Tax</th>
              <th>Action</th>
            </thead>
            <tbody>
              @foreach ($shops as $key => $shop)
                <tr class="text-white">
                  <td>{{ $key + 1 }}</td>
                  <td>{{ $shop->name }}</td>
                  <td>{{ $shop->user->name }}</td>
                  <td>{{ $shop->phone }}</td>
                  <td>{{ $shop->address }}</td>
                  <td>{{ $shop->tax }}</td>
                  <td>
                    <a href="{{ route('shop.shop.edit', $shop->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('shop.shop.destroy', $shop->id) }}" method="post" class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">Delete</button>
                    </form>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
      </main>

    </div>
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
