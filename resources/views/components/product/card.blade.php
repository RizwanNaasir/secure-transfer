@props([
    /** @var \mixed */
    'product'
])

<li {{ $attributes }}>
    <div class="relative group/item">
        <a href="{{url('market_details/'.$product->id)}}">
            <div class="space-y-4">
                <div class="object-cover w-auto">
                    <img class="rounded-lg shadow-lg max-h-[210px]" width="280" src="{{$product->full_image}}" alt="">
                </div>

                <div class="space-y-2">
                    <div class="space-y-1 text-lg font-medium leading-6">
                        <h3>{{$product->name}}</h3>
                        <price class="font-normal">{{$product->price}}$</price>
                    </div>
                </div>
            </div>
        </a>
        @if($product->authUserIsOwner())
            <form id="delete-{{$product->id}}" action="{{route('user.product.delete',$product->id)}}" method="POST">
                @csrf
                @method('DELETE')
            </form>

            <a href="#" onclick="if (confirm('{{ __('lang.confirmation') }}')) {
                                           event.preventDefault();
                                           document.getElementById('delete-{{$product->id}}').submit();
                                         }else{
                                           event.preventDefault();
                                         }">
                <button class="absolute top-0 bg-transparent text-white p-2 right-1 flex  rounded hover:bg-black-800 py-0 px-0">
                    <span><svg class="w-6 h-6 invisible group-hover/item:visible fill-gray-800 stroke-black" fill="none"
                               stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path></svg></span></button>
            </a>
            {{--                                    <button onclick="window.location.href='{{route('user.product.delete',$product->id)}}'" class="absolute top-0 bg-transparent text-white p-2 right-1 flex  rounded hover:bg-black-800 py-0 px-0"><span><svg class="w-6 h-6 invisible group-hover/item:visible fill-gray-800 stroke-black" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></span></button>--}}
            <button onclick="window.location.href='{{route('user.product.edit',$product->id)}}'"
                    class="absolute bottom-20 bg-transparent text-white p-2 right-1 flex  rounded hover:bg-black-800 py-0 px-0">
                <span><svg class="w-8 h-8 invisible group-hover/item:visible  fill-gray-600" fill="none"
                           stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg></span>
            </button>
        @endif
    </div>
</li>