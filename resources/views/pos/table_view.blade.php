@extends('template')
@section('style')
<style>

</style>
@endsection
@section('main_content')
  <section class="pos_section">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 col-6 mt-5 right_border">
          
          
          <div>
            <input type="text" class="form-control searchItem" placeholder="search item">
          </div>
          <div class="row mt-4" style="max-height:100vh; overflow:hidden; overflow-y:scroll;" >
            <table class="table "  >
              <thead class="">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Name</th>
                  <th scope="col">Price in MMK</th>
                  <th scope="col">Qty</th>
                  <th scope="col">Total in MMK</th>
                  <th scope="col">Action</th>
                </tr> 
              </thead>
             <tbody>

             </tbody>
            </table>
          </div>
        </div>

        <div class="col-lg-6 col-6 mt-5 p-3 checkout-div  " >
          <div class="mb-3 row">
            <label for="staticEmail" class="col-sm-6 col-form-label">Total Qty</label>
            <div class="col-sm-6">
              <input type="text" readonly class="form-control-plaintext summary_total_qty" id="staticEmail" placeholder="0">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="inputPassword" class="col-sm-6 col-form-label">Total Amount in MMK</label>
            <div class="col-sm-6">
              <input type="text" class="form-control-plaintext summary_total_amt" placeholder="0">
            </div>
          </div>

          <div class="mb-3 row">
            <label for="inputPassword" class="col-sm-6 col-form-label">Payment in MMK</label>
            <div class="col-sm-6">
              <input type="text" class="form-control pay_input" placeholder="0">
            </div>
          </div>

          <div class="mb-3 row">
            <label for="inputPassword" class="col-sm-6 col-form-label">Change in MMK</label>
            <div class="col-sm-6">
              <input type="text" class="form-control change_input" placeholder="0 ">
            </div>
          </div>

          <div class="d-flex gap-2">
          <button class="btn btn-secondary form-control ">Cancel Checkout</button>
          <button class="btn btn-success form-control checkout">Checkout</button>
        </div>
          
        </div>

        
        
      </div>
    </div>
    
  </section>
@endsection

@section('script')
<script>
  $(document).ready(function(){
    $('.searchItem').change(function(){
     let kw = $(this).val();
     
     $.ajax({
      type: 'post',
      url: "{{route('pos.barcode.search')}}",
      data: {'keyword':kw},
      success: function (data) {
        const res = data.result;
        console.log(res);
        var cart = localStorage.getItem('cart');
        if(!cart)
        {
          var mycart = new Array();
        }else{
          var mycart = JSON.parse(cart);
        }
        var item = {
          id:res.id,
          item_name:res.item.name,
          barcode:res.barcode,
          sell_price:res.sell_price,
          qty:1,
          stg:res.qty
          };

          mycart.push(item);
			
        
          localStorage.setItem('cart',JSON.stringify(mycart));
          showcart();
         
        
      },
      error: function (data) {
          console.log('An error occurred.');
          console.log(data);
      },
     });
    })
    showcart();
    $('tbody').on('change','input',function(){
      let id = $(this).data('id');
      let qty = $(this).val();
      let mycart = localStorage.getItem('cart');
      let cart_arr = JSON.parse(mycart);
      if(cart_arr[id]){
        cart_arr[id].qty = qty;
        localStorage.setItem('cart',JSON.stringify(cart_arr));
      }

      showcart();

    })

    

    $('.pay_input').change(function(){
      let data = $(this).val();
      let amt = $('.summary_total_amt').val();
      let change = parseInt(data) - parseInt(amt);
      $('.change_input').val(change);
    })

    $('.checkout').click(function(){
      let cart = localStorage.getItem('cart');
      let formData = new FormData();
      formData.append('list', cart);
      formData.append('pay', $('.pay_input').val());
      formData.append('change', $('.change_input').val());
      formData.append('total_qty', $('.summary_total_qty').val());
      formData.append('total', $('.summary_total_amt').val());


      $.ajax({
        type: 'POST',
        url: "{{route('pos.checkout')}}",
        data: formData,
        processData: false,
        contentType: false,
        success: function (data) {
         console.log('hie');
         localStorage.clear();
         showcart();

         $('.checkout-div input').val(0);
        
        },
        error: function (data) {
            console.log('An error occurred.');
            console.log(data);
        },
    });

    })

    
  })

  $('tbody').on('click','.item-remove', function(){
    let id = $(this).data('id');
    let mycart = localStorage.getItem('cart');
    if(mycart){
      let cart = JSON.parse(mycart);
      let newcart = cart.filter(item => item.id != id);
      localStorage.setItem('cart',JSON.stringify(newcart));
    }
    showcart();
  })


  function showcart()
    {
      var mycart = localStorage.getItem('cart');
     
        if(mycart)
        {
          var mycartobj = JSON.parse(mycart);
          var html = '';
          var j = 1;
          var total=0;
          var amount=0;
          $.each(mycartobj, function(i,v){
            amount = v.qty * v.sell_price;
            total+=amount;
            
            html+=`<tr>
              <td scope="row">${i+1}</td>
              <td class="" style="">${v.item_name}(${v.barcode})</td>
              <td>${v.sell_price} </td>
              <td><input type="text" style="" data-id=${i} value="${v.qty}" ></td>
              <td>${v.qty * v.sell_price} </td>
              <td><button class="btn btn-danger item-remove" data-id=${v.id}>x</button></td>
            </tr>`
            
          })
          $('tbody').html(html);
        }else{
          $('tbody').html('');
        }
        summary();
    }


    function summary()
    {
      let mycart = localStorage.getItem('cart');
      if(mycart){
        let arr = JSON.parse(mycart);
        let total = 0;
        let qty = 0;
        $.each(arr, function(i,v){
          qty +=parseInt(v.qty);
          total += parseInt(v.qty) * v.sell_price;
        })
        $('.summary_total_qty').val(qty);
        $('.summary_total_amt').val(total);
      }
    }
</script>
@endsection
