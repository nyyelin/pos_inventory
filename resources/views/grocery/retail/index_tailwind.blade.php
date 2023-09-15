@extends('layouts.app')
@section('content')
<section>
    
    <div class="main-body hero-section p-0">
   
        

        <main class="mx-2 my-3" style="overflow:hidden;">

            <x-category-component :categories="$categories"></x-category-component>

            <div class="grid grid-cols-3 gap-2">
                <div class="col-span-2 pt-3 px-2 h-full">
                    
                    <div class="relative  overflow-x-auto  p-2 ">
                        <table class="w-full  text-sm text-left text-gray-500 dark:text-gray-400" id="dataTable">
                            <thead class="text-xs text-gray-700 uppercase dark:text-gray-400" >
                                <tr>
                                    <th scope="col" class=" bg-gray-50 dark:bg-gray-800">
                                        Product name
                                    </th>
                                    <th scope="col" class="">
                                        Color
                                    </th>
                                    <th scope="col" class=" bg-gray-50 dark:bg-gray-800">
                                        Category
                                    </th>
                                    <th scope="col" class="">
                                        Price
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>


                </div>
                <class="col-span-1 h-full pt-3 p-2" >
                 
                        <span class="text-gray-500 text-2xl mb-2 block">Adding New Stock</span>
                    
                    <form>
                        <div class="mb-6">
                            <label for="item_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Item Name</label>
                            <select id="item_id" name="item_id"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected disabled> Please select Item</option>
                                <option>Canada</option>
                                
                            </select>
                        </div>


                        <div class="mb-6">
                            <label for="qty" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Qty</label>
                            <input type="number" id="qty" name="qty" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        </div>

                        <div class="mb-6">
                            <label for="buy_price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
                            <input type="number"  id="buy_price" name="buy_price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        </div>

                        <div class="mb-6">
                            <label for="total_amount" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Total Amount</label>
                            <input type="number"  id="total_amount" name="total_amount" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        </div>

                        <div class="mb-6">
                            <label for="expired_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Expired_date(optional)</label>
                            <input type="date" id="expired_at" name="expired_at" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        </div>

                       
                        <div class="flex justify-end gap-1">
                            <button type="submit" class=" btn-danger">Reset</button>
                            <button type="submit" class=" btn-success">Submit</button>
                           
                        </div>
                    </form>
                </div>
            </div>

        </main>
    </div>
    


</section>
@endsection
@section('script')
<script>
    $('document').ready(function(){
        {{-- table intit --}}
        $.fn.dataTable.dtcalled({
            placeholder: "name",
            selector:'#dataTable',
            url:{
                'dt_url': "{{route('grocery.ajax.items')}}",
                'dt_del': "{{route('grocery.item.destroy',':id')}}",
                'dt_ajax_edit': "{{route('grocery.item.edit',':id')}}",
                'dt_edit': " "
            },

            columns:[
                {data:'id'},
                {data:'name'},
                {data:'category.name'},
            ]

        })
    })
</script>
@endsection