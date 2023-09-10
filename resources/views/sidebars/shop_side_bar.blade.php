<div class="sidebar">
  <input type="checkbox" role="button" aria-label="Display the menu" aria-expanded="false" aria-controls="menu">
  <h5 class="ps-4 mt-3 ">Shop Section</h5>
  <ul id="menu">

    <li>
      <a href="{{ route('shop.shop.index') }}">Shop List</a>
    </li>
    <li>
      <a href="{{ route('shop.shop.create') }}">New Shop</a>
    </li>
    <li><a href="/">Main Page</a></li>
  </ul>
</div>
