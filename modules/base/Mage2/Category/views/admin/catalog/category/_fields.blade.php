{!! Form::text('name','Category Name',['autofocus'=>true,'class' => 'form-control']) !!}
{!! Form::text('slug','Category Slug') !!}
{!! Form::select('parent_id','Parent Category',$categoryOptions) !!}

