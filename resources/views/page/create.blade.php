@extends('layouts.polymer-app')

@section('content')

<div class="row">
    <div class="col s12">
        <h1>Create Page</h1>
        <form method="post" id="pageCreate" action="/admin/page">
            {!! csrf_field() !!}
            <paper-input autofocus autocomplete="true"  required auto-validate error-message="Title is Required" 
                         name="title"label="Title"></paper-input>
            <paper-input autofocus   required auto-validate error-message="Slug is Required" 
                         name="slug" label="Slug"></paper-input>

            <div class="">

                <rich-textarea who='Purvesh'></rich-textarea>
            </div>

            <p></p>

            <paper-button onclick="document.getElementById('pageCreate').submit();" raised class="indigo">Create</paper-button>
        </form>
    </div>
</div>
@endsection
