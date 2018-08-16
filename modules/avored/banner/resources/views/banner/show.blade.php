@extends('avored-framework::layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            Banner Details
        </div>

        <div class="card-body table-bordered">
            <table class="table">
                <tr>
                    <td>Name</td>
                    <td>{{ $banner->name }}</td>
                </tr>
                
                <tr>
                    <td>Image</td>
                    <td><img src="{{ asset($banner->image_path) }}" style="max-height:100px" /></td>
                </tr>

                <tr>
                    <td>Alt Text</td>
                    <td>{{ $banner->alt_text }}</td>
                </tr>
                
                <tr>
                    <td>Url</td>
                    <td>{{ $banner->url }}</td>
                </tr>
                
                <tr>
                   <td>Target</td>
                   <td>{{ $banner->target }}</td>
                </tr>
               
                <tr>
                   <td>Status</td>
                   <td>{{ $banner->status }}</td>
                </tr>
               
                <tr>
                   <td>Sort Order</td>
                   <td>{{ $banner->sort_order }}</td>
                </tr>
               
            </table>

            <div class="float-left">
            
                <form method="post" action="{{ route('admin.banner.destroy', $banner->id)  }}">
                    @csrf()
                    @method('delete')
                    <button
                        onClick="event.preventDefault(); 
                                    swal({
                                        dangerMode: true,
                                        title: 'Are you sure?',
                                        icon: 'warning',
                                        buttons: true,
                                        text: 'Once deleted, you will not be able to recover this Page!',
                                    }).then((willDelete) => {
                                        if (willDelete) {
                                            jQuery(this).parents('form:first').submit();
                                        }
                                    });"    
                        class="btn btn-danger" >
                        Destroy
                    </button>
                </form>
               
            </div>
            <a class="btn" href="{{ route('admin.banner.index') }}">Cancel</a>
        </div>
    </div>

@stop