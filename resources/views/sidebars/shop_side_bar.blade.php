<div class="sidebar">
  <input type="checkbox" role="button" aria-label="Display the menu" aria-expanded="false" aria-controls="menu">
  <h5 class="ps-4 mt-3 ">Shop Section</h5>
  <ul id="menu">

    <li class="{{ ((request()->is('shop/shop')) || (!request()->is('shop/shop/create'))) ? 'active' : '' }}">
      <a href="{{ route('shop.shop.index') }}"> <i class="bi bi-list"></i> Shop List</a>
    </li>
    <li class="{{ ((request()->is('shop/shop/create'))) ? 'active' : '' }}">
      <a href="{{ route('shop.shop.create') }}"> <i class="bi bi-plus-circle"></i>  New Shop</a>
    </li>
    <li><a href="/"> <i class="bi bi-house"></i> Main Page</a></li>
  </ul>
</div>
