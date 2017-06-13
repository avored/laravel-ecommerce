@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col s12">
            <div class="main-title-wrapper">
                <h1>
                    TaxRule List
                    <!--<small>Sub title</small> -->
                </h1>
                <div class="right">
                    <a href="{{ route('admin.tax-rule.create') }}"
                       class="btn btn-primary"> Create Taxrule</a>
                </div>
            </div>

            <div class="clearfix"></div>
            <br/>
            @if(count($taxRules) <= 0)

                <p>Sorry No Tax Rule Found</p>

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
                    @foreach($taxRules as $taxRule)
                        <tr>
                            <td>{{ $taxRule->id }}</td>
                            <td>{{ $taxRule->title }}</td>
                            <td>{{ $taxRule->percentage }}</td>
                            <td>{{ $taxRule->country_id }}</td>
                            <td>{{ $taxRule->state_code }}</td>
                            <td>
                                <a href="{{ route('admin.tax-rule.edit',$taxRule->id )}}">Edit</a>
                            </td>
                            <td>
                                {!! Form::open(['method' => 'DELETE', 'action' => route('admin.tax-rule.destroy',$taxRule->id)]) !!}
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

