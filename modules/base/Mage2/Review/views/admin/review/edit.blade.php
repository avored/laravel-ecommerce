@extends('layouts.admin')

@section('content')
        <div class="row">
            <div class="col m8 offset-m2 s12">
                <div class="main-title-wrapper">
                    <h1>
                        Edit Review
                        <!--<small>Sub title</small> -->
                    </h1>

                </div>
                {!! Form::model($review, ['method' => 'PUT', 'route' => ['admin.review.update', $review->id]]) !!}

                        <div class="input-field">
                            <label>User Full Name</label>
                            <input type="text" name="user_full_name" disabled value="{{ $review->user->full_name }}" />
                        </div>
                        <div class="input-field">
                            <label>Product Title</label>
                            <input type="text" name="product_title" disabled value="{{ $review->product->title }}" />
                        </div>
                        <div class="input-field">
                            <label>Star</label>
                            <input type="text" name="star" disabled value="{{ $review->star }}" />
                        </div>
                        @include('template.select',['key' => 'status','label' => 'Status','options' => ['ENABLED' => "Enabled",'DISABLED' => 'Disabled']])


                        @include('template.hidden',['key' => 'id'])
                        @include('template.submit',['label' => 'Update Review'])
                    
                {!! Form::close() !!}
            </div>
        </div>
@endsection