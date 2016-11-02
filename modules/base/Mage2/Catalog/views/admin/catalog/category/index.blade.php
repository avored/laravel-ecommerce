@extends('layouts.admin-bootstrap')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="main-title-wrap">
        <span class="title"> Category List</span>
        <div class="pull-right" style="margin: 1rem 0px;">
            <a href="{{ route('admin.category.create') }}"
               class="btn btn-primary"> Create Category</a>
        </div>
        </div>
        <div class="clearfix"></div>
        <br/>
        @if(count($dataGrid->data) <= 0)

        <p>Sorry No Category Found</p>

        @else

                {!! $dataGrid->render() !!}
        <!--
        <table class="table table-grid bordered tablegrid">
            <thead>
            <th>ID</th>
            <th>Name</th>
            <th>Slug</th>
            <th>Parent Category</th>
            <th>Website</th>
            <th>EDIT</th>
            <th>DELETE</th>
            </thead>
            <tbody>
                foreach($categories as $category)
                <tr>

                    <td> $category->id }}</td>
                    <td> $category->name }}</td>
                    <td> $category->slug }}</td>
                    <td> $category->parent_name }}</td>
                    <td> $category->website->name }}</td>

                    <td>
                        <a href=" route('admin.category.edit',$category->id )}}">Edit</a>
                    </td>
                    <td>
                         Form::open(['method' => 'DELETE', 'route' => ['admin.category.destroy',$category->id]]) !!}
                        <a href="#" onclick="jQuery(this).parents('form:first').submit()">Delete</a>
                         Form::close() !!}
                    </td>

                </tr>
                endforeach
            </tbody>
        </table>

            <div class="clearfix"></div>
             $categories->links() !!}

        -->
        @endif
    </div>
</div>
@endsection

