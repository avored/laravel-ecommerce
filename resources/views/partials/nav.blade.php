
<header class="text-gray-700 px-6 shadow-lg body-font">
  <div class="mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
    <a class="flex title-font font-medium items-center text-gray-900 mb-4 md:mb-0">
      <img class="w-10 h-10 text-white" 
        src="{{ asset('images/logo.svg') }}" /> 
      <span class="ml-3 text-xl">AvoRed</span>
    </a>
   
    <nav class="md:ml-auto flex flex-wrap items-center text-base justify-center">
        @foreach ($menus as $menu)
            <a href="{{ $menu->url }}" class="mr-5 hover:text-gray-900">
                {{ $menu->name }}
            </a>      
        @endforeach
    </nav>
  </div>
</header>

{{-- <div class="flex px-10 bg-white border-b border-gray-300 shadow items-center">
    <div class="py-3 flex items-center border-b border-gray-100">
        <a href="{{ route('home') }}" title="Avored a laravel Ecommerce">
            <img class="h-10 w-10 inline-block" src="{{ asset('images/logo.svg') }}" /> 
            <span class="text-2xl">AvoRed</span>
        </a>
    </div>
    <div class="ml-auto">
        <avored-nav :menus="{{ $menus }}"></avored-nav>
    </div>
</div> --}}
