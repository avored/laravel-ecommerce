@extends('layouts.app')

@section('meta_title','Edit My Account E commerce')
@section('meta_description','Edit My Account E commerce')


@section('content')

        <div class="row profile">

            <div class="col-3">
                @include('user.my-account.sidebar')
            </div>
            <div class="col-9">
                <div class="card">
                    <div class="card-header">
                        Profile Edit
                    </div>
                    <div class="card-body">
                        <div class="profile-content">

                            <form method="post" action="{{ route('my-account.store') }}">

                                @csrf

                                @include('partials.forms.text',['name' => 'first_name','label' => 'First Name','model' => $user])
                                @include('partials.forms.text',['name' => 'last_name','label' => 'Last Name','model' => $user])
                                @include('partials.forms.text',['name' => 'email','label' => 'Email','model' => $user,
                                                        'attributes' => ['disabled' => true,'class' => 'form-control']])


                                @include('partials.forms.text',['name' => 'phone','label' => 'Phone','model' => $user])
                                
                                @include('partials.forms.text',['name' => 'company_name','label' => 'Company Name','model' => $user])
                                @include('partials.forms.text',['name' => 'tax_no','label' => 'Tax No','model' => $user])




                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary"> Update Profile</button>

                                </div>


                            </form>
                        </div>
                    </div>
                </div>


            </div>
        </div>

@endsection
