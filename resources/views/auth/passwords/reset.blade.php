@extends('layouts.app')

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
      <a href="#" class="text-gray-700" title="home">
        {{ __('avored.password_update') }}
      </a>
    </li>
   
  </ol>
</nav>
@endsection

@section('content')
    <div class="flex items-center justify-center bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-lg w-full bg-white rounded-md shadow-md p-6">
            <div>
                <a href="https://avored.com" target="_blank">
                    <img class="mx-auto h-12 w-auto" 
                        src="{{ asset('/images/logo.svg') }}" 
                        alt="AvoRed Ecommerce" />
                </a>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                    {{ __('avored.password_update') }}
                </h2>
            </div>
            <form class="mt-8" action="{{ route('password.update') }}" method="POST">
                @csrf()
                <input type="hidden" name="token" value="{{ $token }}" />
                
                <div class="rounded-md shadow-sm">
                    <div class="mt-3">
                        <avored-input
                            label-text="{{ __('avored.email') }}"
                            label-class="w-full block"
                            input-class="w-full block"
                            field-name="email"
                            input-type="email"
                            error-text="{{ $errors->first('email') }}"
                        ></avored-input>
                    </div>
                    <div class="mt-3">
                        <avored-input
                            label-text="{{ __('avored.password') }}"
                            label-class="w-full block"
                            input-class="w-full block"
                            field-name="password"
                            input-type="password"
                            error-text="{{ $errors->first('password') }}"
                        ></avored-input>
                    </div>
                    <div class="mt-3">
                        <avored-input
                            label-text="{{ __('avored.password_confirmation') }}"
                            label-class="w-full block"
                            input-class="w-full block"
                            field-name="password_confirmation"
                            input-type="password"
                            error-text="{{ $errors->first('password_confirmation') }}"
                        ></avored-input>
                    </div>
                </div>
                <div class="mt-6">
                    <button 
                        type="submit" 
                        class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-700"
                    >
                    <span class="absolute left-0 inset-y pl-3">
                        <svg 
                            class="h-5 w-5 text-red-500 group-hover:text-red-400" 
                            fill="currentColor" 
                            viewBox="0 0 20 20"
                        >
                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" 
                                clip-rule="evenodd"
                            />
                        </svg>
                    </span>
                        {{ __('avored.password_update') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
