<div class="flex flex-row overflow-x-auto gap-2 scrollbar-none items-center justify-center mb-5">
    @foreach($categories as $cat)

    <div class="max-w-sm p-6 bg-white border border-red-200 rounded-lg hover:bg-gray-200  shadow">
        <a href="#">
            <h5 class="mb-2 text-xl font-bold tracking-tight text-black">
                {{$cat->name}}
            </h5>
        </a>
        
    </div>

    @endforeach

    
</div>