<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    
    

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.tailwindcss.min.css">

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.tailwindcss.min.js"></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"></link> 
            
</head>
<body>
    <div id="app">
        

        <nav class="bg-gray-100 border-gray-200 dark:bg-gray-900 dark:border-gray-700">
            <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
              <a href="#" class="flex items-center">
                  <img src="https://flowbite.com/docs/images/logo.svg" class="h-8 mr-3" alt="Flowbite Logo" />
                  <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Flowbite</span>
              </a>
              <button data-collapse-toggle="navbar-dropdown" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-dropdown" aria-expanded="false">
                  <span class="sr-only">Open main menu</span>
                  <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                  </svg>
              </button>
              <div class="hidden w-full md:block md:w-auto" id="navbar-dropdown">
                <ul class="flex flex-col flex-col-reverse md:flex-row">
                 
                  <li class="py-2 pl-3 pr-4 mr-1">
                      <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar" class="flex items-center justify-between w-full py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto dark:text-white md:dark:hover:text-blue-500 dark:focus:text-white dark:border-gray-700 dark:hover:bg-gray-700 md:dark:hover:bg-transparent">Menu <svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                    </svg></button>
                      <!-- Dropdown menu -->
                      <div id="dropdownNavbar" class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                          <ul class="py-2 text-sm text-gray-700 dark:text-gray-400" aria-labelledby="dropdownLargeButton">
                            <li>
                              <a href="{{ route('grocery.category.index') }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Category</a>
                            </li>
                            <li>
                              <a href="{{ route('grocery.item.index') }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Proudct</a>
                            </li>
                            <li>
                              <a href="{{ route('grocery.retail.index') }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Reatil</a>
                            </li>
                          </ul>
                          {{-- <div class="py-1">
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-400 dark:hover:text-white">Sign out</a>
                          </div> --}}
                      </div>
                  </li>
                  <li class="py-2 pl-3 mr-2 pr-4">
                    <a href="#" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">{{(\Auth::check()) ? \Auth::user()->name : '-'}}</a>
                  </li>
                 
                  
                </ul>
              </div>
            </div>
          </nav>
          
  

        <main class="py-4">
            @yield('content')
        </main>
    </div> 
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>
    <script src="{{ asset('template/tw_dt_config.js') }}"></script>
@yield('script')
</body>
</html>
