@extends('layouts.app')

@section('meta_title')
    Contact US
@endsection

@section('content')
    <div class="row">

        <div class="col-md-12">

                <h1>Contact US</h1>
                <div class="">
                    <form action="{{ route('contact.send') }}" method="post">
                        @csrf

                        @include('partials.forms.text',['name' => 'name','label' => 'Name'])
                        @include('partials.forms.text',['name' => 'email','label' => 'Email'])
                        @include('partials.forms.text',['name' => 'phone','label' => 'Phone'])

                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea class="form-control{{ $errors->has('message') ? " is-invalid" : "" }}" name="message" id="messge"></textarea>

                            @if($errors->has('message'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('message') }}
                                </div>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary" >Send</button>
                    </form>

                </div>
        </div>

    </div>
@endsection
