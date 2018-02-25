@extends('layouts.app')

@section('meta_title','Change Your Password')
@section('meta_description','Change Your Password')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Resend Activation Email</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('user.activation.resend.post') }}">
                            @csrf

                            @include('partials.forms.text',['name' => 'email' ,'label' => 'Email Address'])


                            <button type="submit" class="btn btn-primary">
                                Resend
                            </button>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

