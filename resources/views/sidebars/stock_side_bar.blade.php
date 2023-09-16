<div class="sidebar">
  <input type="checkbox" role="button" aria-label="Display the menu" aria-expanded="false" aria-controls="menu">
  <h5 class="ps-4 mt-3 ">Stock Section</h5>
  <ul id="menu">
    <li class="{{ ((request()->is('grocery/category')) || (request()->is('grocery/category/*'))) ? 'active' : '' }}">
      <a href="{{ route('grocery.category.index') }}">  Category</a>
    </li>
    <li class="{{ ((request()->is('grocery/item')) || (request()->is('grocery/item/*'))) ? 'active' : '' }}">
      <a href="{{ route('grocery.item.index') }}">Product</a>
    </li>

    <li class="{{ ((request()->is('grocery/retail')) || (request()->is('grocery/retail/*'))) ? 'active' : '' }}">
      <a href="{{ route('grocery.retail.index') }}">Retail</a>
    </li>

    <li class="{{ ((request()->is('grocery/inventory')) || (request()->is('grocery/inventory/*'))) ? 'active' : '' }}">
      <a href="{{ route('grocery.inventory.index') }}">Inventory</a>
    </li>

    
    <li><a href="/">Main Page</a></li>


  </ul>
</div>
