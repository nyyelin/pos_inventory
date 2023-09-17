<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="">
        <meta name="author" content="">

  {{-- <meta name="description" content="">
  <meta name="author" content=""> --}}

  <title>POS & INVENTORY</title>

  <!-- CSS FILES -->
  <link rel="preconnect" href="https://fonts.googleapis.com">

  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>


        <link href="{{ asset('template/css/templatemo-topic-listing.css') }}" rel="stylesheet">

        
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css"/>
        

        <!-- datatable  -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700&family=Open+Sans&display=swap"
    rel="stylesheet">

  <link href="{{ asset('template/css/bootstrap.min.css') }}" rel="stylesheet">

  <link href="{{ asset('template/css/bootstrap-icons.css') }}" rel="stylesheet">

  <link href="{{ asset('plugin/custom.css') }}" rel="stylesheet">


  <link href="{{ asset('template/css/templatemo-topic-listing.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" />
  <!-- datatable  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>

  <style>
    .main-body {
      display: grid;
      grid-template-columns: auto 1fr;

    }

    .hero-section {
      height: auto;
    }

    .sidebar {
      /* border-right: 1px solid #75c2bf; */
    }

    .sidebar ul {

      background: transparent;
      min-height: 100vh;
      min-width: 230px;
      box-sizing: border-box;
      display: flex;
      flex-direction: column;
      list-style: none;
      padding: 18px 0;

    }

    .sidebar ul li a {
      display: block;
      background: transparent;
      color: #fff;
      font-size: 17px;
      /* font-weight: bold; */
      font-family: sans-serif;
      padding: 10px 20px;

    }

    .sidebar ul li:hover {
      background: #fff;
    }

    .sidebar ul li.active {
      background: white;
    }
    .sidebar ul li.active a{
      color: black !important;
      font-size: 18px;
      font-weight: bold
    }

    .sidebar ul li:active a {
      color: #333;
    }

    .sidebar ul li a:hover {
      color: #333;


    }

    .place-line {
      width: 80%;
      display: block;
      text-align: center;
    }



    .sidebar input {
      display: none;
    }

    .dataTables_filter input {
      border: 1px solid black !important;
    }
  </style>
  @yield('style')
  <!--

TemplateMo 590 topic listing

https://templatemo.com/tm-590-topic-listing

-->
</head>

<body id="top flex flex-column h-100">
  

    <main class="hero-section" style="padding-top: 10px !important">
      <div class="container mb-2">
        @if (Auth()->user())
          <div class="d-flex justify-content-between align-items-center ">
            <a href="/" class="text-decoration-none">
              <h5  class="text-white">MIN POS</h5>
            </a>
            <div class=" dropdown-center">
              <button class="btn btn-light text-dark dropdown-toggle float-end px-3 py-2 bi-person" type="button"
                data-bs-toggle="dropdown" aria-expanded="false">
                {{ Auth::user()->name }}
              </button>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" style="font-size: 15px"> <i class="bi bi-envelope pe-2"></i>
                    {{ Auth::user()->email }}</a></li>
                <li><a class="dropdown-item" style="font-size: 15px"><i
                      class="bi bi-telephone pe-2"></i>{{ Auth::user()->phone }}</a></li>
                <li>
                  <a class="dropdown-item" style="font-size: 15px; cursor:pointer" data-bs-toggle="modal"
                    data-bs-target="#exampleModal">
                    <i class="bi bi-key pe-2"></i> change password
                  </a>
                </li>
                <li>
                  <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();"
                    style="font-size: 15px">
                    <i class="bi bi-arrow-return-left pe-2"></i>
  
                    {{ __('Logout') }}
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                  </form>
                </li>
              </ul>
            </div>
          </div>
  
          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <form method="post" action="{{ route('shop.change_password') }}">
                  @csrf
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Change Password</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <input type="password" class="form-control" placeholder="new password" name="password" minlength="8" required>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        @endif
      </div>
      <div class="">
        @yield('main_content')
      </div>
    </main>
  
    <footer class="footer mt-auto py-3 bg-light">
      <div class="container text-center">
        <span class="text-muted text-center">Thank you so much for your choice!</span>
      </div>
    </footer>

  
  


  <!-- JAVASCRIPT FILES -->
  <script src="{{ asset('template/js/jquery.min.js') }}"></script>
  <script src="{{ asset('template/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('template/js/jquery.sticky.js') }}"></script>
  {{-- <script src="{{ asset('plugin/js/localstorage.js') }}" rel="stylesheet"></script> --}}

  {{-- <script src="{{ asset('template/js/click-scroll.js') }}"></script> --}}
  <script src="{{ asset('template/js/custom.js') }}"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
  <script src="{{ asset('template/dt_config.js') }}"></script>

  @yield('script')

</body>

</html>
