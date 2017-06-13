@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="main-title-wrap">
                <span class="title">Product List</span>
                <div class="pull-right" style="margin: 1rem 0px;">
                    <a href="{{ route('admin.product.create') }}"
                       class="btn btn-primary"> Create Product</a>
                </div>
            </div>
            <div class="clearfix"></div>

            <br/>
            @if(count($products) <= 0)

                <p>Sorry No Product Found</p>

            @else
                <table class="table bordered tablegrid">
                    <thead>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>EDIT</th>
                    <th>DELETE</th>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->title }}</td>
                            <td>{{ number_format($product->price,2) }}</td>

                            <td>
                                <a href="{{ route('admin.product.edit',$product->id )}}">Edit</a>
                            </td>
                            <td>
                                {!! Form::open(['method' => 'DELETE', 'action' => route('admin.product.destroy',$product->id)]) !!}
                                <a href="#" onclick="jQuery(this).parents('form:first').submit()">Delete</a>
                                {!! Form::close() !!}
                            </td>

                        </tr>
                    @endforeach

                    </tbody>

                </table>
            @endif

        </div>

        <div class="center-block col s12">
            {!! $products->links() !!}
        </div>
    </div>
@endsection

