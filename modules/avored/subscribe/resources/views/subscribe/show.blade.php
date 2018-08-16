@extends('avored-framework::layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            Subscribe Details
        </div>

        <div class="card-body table-bordered">
            <table class="table">
                <tr>
                    <td>Name</td>
                    <td>{{ $subscribe->name }}</td>
                </tr>           
            
                <tr>
                    <td>Email</td>
                    <td>{{ $subscribe->email }}</td>
                </tr>
                
            </table>

            <div class="float-left">
            
                <form method="post" action="{{ route('admin.subscribe.destroy', $subscribe->id)  }}">
                    @csrf()
                    @method('delete')
                    <button
                        onClick="event.preventDefault(); 
                                    swal({
                                        dangerMode: true,
                                        title: 'Are you sure?',
                                        icon: 'warning',
                                        buttons: true,
                                        text: 'Once deleted, you will not be able to recover this Subscribe!',
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
            <a class="btn" href="{{ route('admin.subscribe.index') }}">Cancel</a>
        </div>
    </div>

@stop