<div class="sidebar">
  <input type="checkbox" role="button" aria-label="Display the menu" aria-expanded="false" aria-controls="menu">
  <h5 class="ps-4 mt-3 ">Stock Section</h5>
  <ul id="menu">

    <li>
      <a href="{{ route('grocery.category.index') }}"> <i class="bi bi-list"></i> Category</a>
    </li>
    <li>
      <a href="{{ route('grocery.item.create') }}">New Product</a>
    </li>

    <li>
      <a href="{{ route('grocery.item.index') }}"> <i class="bi bi-list"></i>Product List</a>
    </li>

    <li><a href="/about">Add Stock</a></li>
    <li><a href="/shop">Stock Transactions</a></li>
    <li><a href="/contact">Main Page</a></li>
  </ul>
</div>
