@extends('layouts.user')

@section('breadcrumb')
<a-breadcrumb style="margin: 16px 0">
    <a-breadcrumb-item>
      <a href="{{ route('home') }}" title="home">
        {{ __('Home') }}
      </a>
    </a-breadcrumb-item>
    <a-breadcrumb-item>
        {{ __('User Dashboard') }}
    </a-breadcrumb-item>
</a-breadcrumb>
@endsection

@section('content')
     <a-card title="User Dashboard Page">
      <a href="{{ route('account.edit') }}" slot="extra">
        <a-icon type="edit"></a-icon>
      </a>
      <p>Name: {{ $user->name }} </p>
      <p>Email: {{ $user->email }} </p>
    </a-card>
@endsection
