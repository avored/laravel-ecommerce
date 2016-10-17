@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col s12">
        <div class="main-title-wrapper">
            <h1>
                TaxClass List
                <!--<small>Sub title</small> -->
            </h1>
            <div class="right">
                <a href="{{ route('admin.tax-class.create') }}"
                   class="btn btn-primary"> Create TaxClass</a>
            </div>
        </div>

        <div class="clearfix"></div>
        <br/>
        @if(count($taxClasses) <= 0)

        <p>Sorry No Tax Class Found</p>

        @else
        
        <table class="table table-bordered table-responsive">
            <thead>
            <th>ID</th>
            <th>Title</th>
            <th>Percentage</th>
            <th>Country</th>
            <th>State</th>
            <th>EDIT</th>
            <th>DELETE</th>
            </thead>
            <tbody>
                @foreach($taxClasses as $taxClass)
                <tr>
                    <td>{{ $taxClass->id }}</td>
                    <td>{{ $taxClass->title }}</td>
                    <td>{{ $taxClass->percentage }}</td>
                    <td>{{ $taxClass->country_code }}</td>
                    <td>{{ $taxClass->state_code }}</td>
                    <td>
                        <a href="{{ route('admin.tax-class.edit',$taxClass->id )}}">Edit</a>
                    </td>
                    <td>
                        {!! Form::open(['method' => 'DELETE', 'route' => ['admin.tax-class.destroy',$taxClass->id]]) !!}
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

