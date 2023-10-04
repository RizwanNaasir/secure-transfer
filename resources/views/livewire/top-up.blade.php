@vite(['resources/css/app.css'])
<form action="{{route('stripe.top-up-wallet')}}" method="post">
    @csrf
    <input type="number" maxlength="10000" wire:model="title" class="rounded-lg">
    <button type="submit" class="w-24 px-2 py-2 text-white rounded-lg  bg-purple-700">Pay Now</button>
</form>
