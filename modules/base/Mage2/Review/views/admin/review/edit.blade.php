@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="main-title-wrap">
            <span class="title">
                Edit Review
            </span>

            </div>
            {!! Form::bind($review, ['method' => 'PUT', 'action' => route('admin.review.update', $review->id)]) !!}

            {!! Form::text('user_full_name', 'User Full Name',['disabled' => true]) !!}
            {!! Form::text('product_title', 'Product Title',['disabled' => true]) !!}
            {!! Form::text('star', 'Star',['disabled' => true]) !!}
            {!! Form::select('status', 'Status', ['ENABLED' => "Enabled",'DISABLED' => 'Disabled']) !!}



            {!! Form::submit('Update Review') !!}
            {!! Form::button('Cancel',['class' => 'btn', 'onclick' => 'location="'.route('admin.review.index').'"']) !!}

            {!! Form::close() !!}
        </div>
    </div>
@endsection