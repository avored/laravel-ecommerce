@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col s12">
        <div class="main-title-wrapper">
            <h1>
                Review List
                <!--<small>Sub title</small> -->
            </h1>

        </div>

        <div class="clearfix"></div>
        <br/>
        @if(count($reviews) <= 0)

        <p>Sorry No Review Found</p>

        @else
        
        <table class="table table-bordered table-responsive">
            <thead>
            <th>ID</th>
            <th>User Name</th>
            <th>Product Name</th>
            <th>Star</th>
            <th>Status</th>
            <th>EDIT</th>
            <th>DELETE</th>
            </thead>
            <tbody>
                @foreach($reviews as $review)
                <tr>
                    <td>{{ $review->id }}</td>
                    <td>{{ $review->user->fullName }}</td>
                    <td>{{ $review->product->title }}</td>
                    <td>{{ $review->star }}</td>
                    <td>{{ $review->status }}</td>
                    <td>
                        <a href="{{ route('admin.review.edit',$review->id )}}">Edit</a>
                    </td>
                    <td>
                        {!! Form::open(['method' => 'DELETE', 'route' => ['admin.review.destroy',$review->id]]) !!}
                        <a href="#" onclick="jQuery(this).parents('form:first').submit()">Delete</a>
                        {!! Form::close() !!}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif

    </div>
</div>
@endsection

