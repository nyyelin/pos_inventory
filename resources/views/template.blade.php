<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>POS & INVENTORY</title>

        <!-- CSS FILES -->        
        <link rel="preconnect" href="https://fonts.googleapis.com">
        
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700&family=Open+Sans&display=swap" rel="stylesheet">
                        
        <link href="{{ asset('template/css/bootstrap.min.css') }}" rel="stylesheet">

        <link href="{{ asset('template/css/bootstrap-icons.css') }}" rel="stylesheet">

        <link href="{{ asset('template/css/templatemo-topic-listing.css') }}" rel="stylesheet">   
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css"/>
        <!-- datatable  -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <style>
            .main-body{
        display: grid;
        grid-template-columns : auto 1fr;
        
    }

    .hero-section {
        height: auto;
    }
    
    .sidebar {
        border-right: 1px solid #75c2bf;
    }

    .sidebar ul{
       
        background: transparent;
        min-height : 100vh;
        min-width : 230px;
        box-sizing: border-box;
        display: flex;
        flex-direction: column;
        list-style: none;
        padding: 18px 0;
        
    }

    .sidebar ul li a {
        display: block;
        background: transparent;
        color:#fff;
        font-size: 20px;
        font-weight: bold;
        font-family: sans-serif;
        padding: 10px 20px;

    }

    .sidebar ul li:hover{
         background: #fff;
    }

    .sidebar ul li.active{
         background: #fff;
    }

    .sidebar ul li:active a{
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
        </style>
        @yield('style')   
<!--

TemplateMo 590 topic listing

https://templatemo.com/tm-590-topic-listing

-->
    </head>
    
    <body id="top">
        <main>
            @yield('main_content')
        </main>



        <!-- JAVASCRIPT FILES -->
        <script src="{{ asset('template/js/jquery.min.js') }}"></script>
        <script src="{{ asset('template/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('template/js/jquery.sticky.js') }}"></script>
        <script src="{{ asset('template/js/click-scroll.js') }}"></script>
        
        <script src="{{ asset('template/js/custom.js') }}"></script>
        
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
        <script>
            
        </script>
        <script src="{{ asset('template/dt_config.js') }}"></script>
        
        @yield('script')

    </body>
</html>
