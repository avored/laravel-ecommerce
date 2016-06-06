@extends('layouts.polymer-app')

@section('content')

<div class="row">
    <div class="col s12">
        <h1>Create Category</h1>
        <form method="post" id="categoryCreate" action="/admin/category">
            {!! csrf_field() !!}
            <paper-input autofocus autocomplete="true"  required auto-validate error-message="Title is Required" 
                         name="title"label="Title"></paper-input>
            <p></p>

            <paper-button onclick="document.getElementById('categoryCreate').submit();" raised class="indigo">Create</paper-button>
        </form>
    </div>
</div>
@endsection
