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
            {{ __('avored.pages.account_dashboard.title') }}
          </span>
          <span class="ml-auto">
            <a href="{{ route('account.edit') }}" slot="extra">
              Edit
            </a>
          </span>
        </div>
      </div>
      <div class="p-5">
        <p>First Name: {{ $user->first_name }} </p>
        <p>Last Name: {{ $user->last_name }} </p>
        <p>Email: {{ $user->email }} </p>
      </div>
    </div>
@endsection
