@extends('layouts.polymer-app')

@section('content')


            <h1>Products</h1>
            <div class="right">
                <a href="/admin/product/create/" class="btn btn-primary">Create</a>

            </div>

            <table class="table-bordered">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>

                    </th>
                </tr>
                </thead>

                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->title }}</td>
                        <td>{{ $product->price }}</td>
                        <td>
                            <a href="/admin/product/{{ $product->id }}/edit">Edit</a>
                            <form action="/admin/product/{{$product->id}}" method="post">
                                {!! csrf_field() !!}
                                <input type="hidden" name="_method" value="DELETE" >
                                <button type="submit">Delete</button>

                            </form>


                        </td>
                    </tr>
                    @endforeach

                </tbody>

            </table>
            {!! $products->render() !!}

@endsection
