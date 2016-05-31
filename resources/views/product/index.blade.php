@extends('layouts.admin.app')

@section('content')

    <div class="row">
        <div class="col s12">
            <h1>Products</h1>

            <table class="table-bordered">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Price</th>
                </tr>
                </thead>

                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->title }}</td>
                        <td>{{ $product->price }}</td>
                    </tr>
                    @endforeach

                </tbody>

            </table>
            {!! $products->render() !!}
        </div>
    </div>
@endsection
