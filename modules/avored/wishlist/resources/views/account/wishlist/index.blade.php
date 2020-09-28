@extends('layouts.user')

@section('breadcrumb')
<div class="flex items-center text-xs text-gray-700 mb-3">
    <div>
      <a href="{{ route('home') }}" title="home">
        {{ __('Home') }} >>
      </a>
    </div>
    <div class="ml-1">
        {{ __('User Dashboard') }}
    </div>
</div>
@endsection

@section('content')
     <div class="border rounded mb-5">
      <div class="p-5 border-b">
        <div class="flex">
          <span>
            {{ __('avored.customer_wishlists') }}
          </span>
        </div>
      </div>
      <div class="p-5">
             <table class="min-w-full divide-y divide-gray-200">
          <thead>
            <tr>
              <th class="px-6 py-3 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                Image
              </th>
              <th class="px-6 py-3 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                Name
              </th>
              <th class="px-6 py-3 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                Price
              </th>
              <th class="px-6 py-3 bg-gray-100"></th>
            </tr>
          </thead>
          <tbody>
            <!-- Odd row -->
            @foreach ($wishlists as $wishlist)
                <tr class="bg-white">
                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-900">
                        <img
                            class="h-12 w-12 rounded" 
                            src="{{ $wishlist->product->main_image_url }}" 
                            alt="{{ $wishlist->product->name }}" />
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
                        {{ $wishlist->product->name }}
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
                        {{ $wishlist->product->price }}
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium">
                        <form method="post" action="{{ route('wishlist.destroy') }}">
                          @csrf
                          <button type="submit">
                              Remove
                          </button>
                          <input type="hidden" name="slug" value="{{ $wishlist->product->slug }}" />
                      </form>
                    </td>
                </tr>
            @endforeach

          </tbody>
        </table>
      </div>
    </div>
@endsection
