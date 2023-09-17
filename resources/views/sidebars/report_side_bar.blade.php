<div class="sidebar">
  <input type="checkbox" role="button" aria-label="Display the menu" aria-expanded="false" aria-controls="menu">
  <h5 class="ps-4 mt-3 ">Stock Section</h5>
  <ul id="menu">
    <li class="{{ ((request()->is('report/income')) || (request()->is('report/income/*'))) ? 'active' : '' }}">
      <a href="{{ route('report.sales') }}">Sale</a>
    </li>

    <li class="{{ ((request()->is('report/retails')) || (request()->is('report/retails/*'))) ? 'active' : '' }}">
      <a href="{{ route('report.retails') }}">Retail Transaction</a>
    </li>


    
    <li><a href="/">Main Page</a></li>


  </ul>
</div>
