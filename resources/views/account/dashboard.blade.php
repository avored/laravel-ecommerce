@extends('layouts.user')

@section('breadcrumb')
<nav class="text-black bg-gray-400 rounded mb-5 py-2 px-5" aria-label="Breadcrumb">
  <ol class="list-none p-0 inline-flex">
    <li class="flex items-center">
      <a href="{{ route('home') }}" class="text-gray-700" title="home">
        {{ __('avored.home') }}
      </a>
      <svg class="fill-current w-3 h-3 mx-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/></svg>
    </li>
    <li class="flex items-center">
      <a href="{{ route('account.dashboard') }}" class="text-gray-700" title="home">
        {{ __('avored.account_dashboard') }}
      </a>
      <svg class="fill-current w-3 h-3 mx-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/></svg>
    </li>
    <li class="flex items-center">
      <a href="#" class="text-gray-700" title="home">
        {{ __('avored.account') }}
      </a>
    </li>
   
  </ol>
</nav>
@endsection

@section('content')
    
<div class="bg-white shadow overflow-hidden sm:rounded-lg">
  <div class="px-4 py-5 sm:px-6">
    <div class="flex w-full">
        <h3 class="text-lg leading-6 font-medium text-gray-900">
          {{ __('avored.user_personal_info') }}
        </h3>
        <div class="ml-auto">
          <a href="{{ route('account.edit') }}">
            {{ __('avored.edit') }}
          </a>
        </div>
    </div>
  </div>
  <div class="border-t border-gray-200">
    <dl>
      <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
        <dt class="text-sm font-medium text-gray-500">
          {{ __('avored.first_name') }}
        </dt>
        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
          {{ $user->first_name }}
        </dd>
      </div>
      <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
        <dt class="text-sm font-medium text-gray-500">
          {{ __('avored.last_name') }}
        </dt>
        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
          {{ $user->last_name }}
        </dd>
      </div>
      <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
        <dt class="text-sm font-medium text-gray-500">
          {{ __('avored.email') }}
        </dt>
        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
          {{ $user->email }}
        </dd>
      </div>
    </dl>
  </div>
</div>
      
@endsection
