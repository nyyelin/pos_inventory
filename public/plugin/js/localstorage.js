// file name = public/frontend/js/localstorage_custom.js


// id / name /photo 
$(document).ready(function(){

	// to use ajax post method we need ajaxsetup and meta tag

	$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
	});


	showcart();
	cartnoti();
	$('.btn_add_to_cart').click(function(){
		// alert('hi');
		var id = $(this).data('id');
		var item_name = $(this).data('item_name');
		var image = $(this).data('image');
		var sell_price = $(this).data('sell_price');
		console.log(id);
		console.log(item_name);
		console.log(image);
		console.log(sell_price);

		var cart = localStorage.getItem('cart');
		if(!cart)
		{
			var mycart = new Array();
		}else{
			var mycart = JSON.parse(cart);
		}
			var item = {
				id:id,
				item_name:item_name,
				image:image,
				sell_price:sell_price,
				qty:1
			};

			var hasid = false;
			$.each(mycart,function(i,v){
				if(v.id == id)
				{
					hasid = true;
					v.qty++;
				}
			})
			if(!hasid){
				mycart.push(item);
			}
			localStorage.setItem('cart',JSON.stringify(mycart));
			// cartnoti()
            showcart()
		// id / name / photo / qty

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
				html+=`
                <div class="col-12 mx-auto">
                <div class="card mb-3 shadow">
                  <div class="row g-0">
                    <div class="col-md-4">
                      <img src="${v.image}" alt=""
                        class="img-fluid rounded-start">
                    </div>
                    <div class="col-md-8 my-0 py-0">
                      <div class="card-body my-0 py-0">
                        <div class="row mt-2">
                          <div class="col-5">
                            <h6 class="card-title d-inline-block">${v.item_name}</h6>
                          </div>
                          <div class="col-5">
                            <select name="" id="" class="form-control">
                              <option value="" selected>Log One</option>
                              <option value="">Log Two</option>
                            </select>
                          </div>
                          <div class="col-2">
                            <button class="btn btn-danger btn-sm float-end remove"  data-id="${i}">
                              <i class="bi bi-bookmark-x-fill"></i>
                            </button>
                          </div>
                        </div>
                        <div class="row mt-2 mb-0 pb-0">
                          <div class="col-3 mt-0 mx-0">
                            <label>Qty</label>
                            <input type="text" class="form-control qty_change" value="${v.qty}" data-id="${i}">
                          </div>
                          <div class="col-3 mt-0 mx-0">
                            <label>Price</label>
                            <input type="text" class="form-control" value="${v.sell_price}" readonly disabled>
                          </div>
                          <div class="col-4 mt-0 mx-0">
                            <label>Amount</label>
                            <input type="text" class="form-control" value="${amount}" readonly disabled>
                          </div>

                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>`;
			})
			$('.show_cart').html(html);
			// var cart_view='';
			// cart_view = `There are your choice items to buy`;
			// $('.cart_view').html(cart_view);

		}else{
			$('.show_cart').html('');
			$('.cart_view').html('There are no items in your cart!')

		}
	}

	// increase qty

	$('.show_cart').on('keyup','.qty_change',function(){
		var id = $(this).data('id');
		var qty = $(this).val()

		var mycart = localStorage.getItem('cart');
		if(mycart)
		{
			var mycartobj = JSON.parse(mycart);
			$.each(mycartobj,function(i,v){
				if(i == id){
					v.qty = qty;
				}
			})
			localStorage.setItem('cart', JSON.stringify(mycartobj));
			showcart();
		}
	})

	$('.show_cart').on('click','.remove',function(){
		var id = $(this).data('id');
		var mycart = localStorage.getItem('cart');
		if(mycart)
		{
			var mycartobj = JSON.parse(mycart);
			$.each(mycartobj,function(i,v){
				if(i == id)
				{
					var ans = confirm("Are you suer remove this item?");
					if(ans)
					{
						mycartobj.splice(id,1);
					}
				}
			})
			localStorage.setItem('cart', JSON.stringify(mycartobj));
			showcart();
			cartnoti()

		}

	})


	function cartnoti()
	{
		var mycart = localStorage.getItem('cart');
		if(mycart){
			var mycartobj = JSON.parse(mycart);
			var cart = 0;
			var total=0;
			$.each(mycartobj,function(i,v){
				cart += v.qty;
				var price = parseInt(v.price);
				total+=price;
			});
			var totalprice = total+' ks';
			$('.cartNoti').html(cart);
			$('.price').html(totalprice);
		}else{
			var totalprice = 0 + " ks"
			$('.cartNoti').html(0);
			$('.price').html(totalprice);
		}

	}

	$('.buy_now').click(function(){
		var note = $('.note').val();
		var mycart = localStorage.getItem('cart');
		if(mycart){
			$.post('/orders',{mycart:mycart,note:note},function(res){
				alert(res);
				localStorage.clear();
				showcart();
				window.location.href='/';
			})
		}
	})


	$('.btn_logout').click(function(){
		localStorage.clear();
		cartnoti();
	});

})