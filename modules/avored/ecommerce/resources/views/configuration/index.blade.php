@extends('avored-ecommerce::layouts.app')

@section('content')

    <div class="row">
        <div class="col-12">

            <div class="h1">Configuration</div>

            <form method="post" action="{{ route('admin.configuration.store') }}" enctype="multipart/form-data">
                @csrf

                <div id="configuration-list" class="mb-3" role="tablist">


                    @foreach(AdminConfiguration::all() as $configuration)
                    <div class="card mb-3">


                        <a data-toggle="collapse" href="#avored-{{ $configuration->key() }}">
                            <div class="card-header" role="tab" id="{{ $configuration->key() }}">
                                <h5 class="mb-0">
                                    {{ $configuration->label() }}
                                </h5>
                            </div>
                        </a>

                        <div id="avored-{{ $configuration->key() }}" class="collapse {{ $loop->index == 0 ? "show" : "" }}"
                             role="tabpanel"
                             data-parent="#configuration-list">
                            <div class="card-body">

                                @foreach($configuration->all() as $field)

                                    @if($field->type() == 'text')

                                        @include('avored-ecommerce::forms.text',['name' => $field->name(),
                                                                        'label' => $field->label()])

                                    @endif

                                    @if($field->type() == 'select')

                                        @include('avored-ecommerce::forms.select',['name' => $field->name(),
                                                                        'label' => $field->label(),
                                                                        'options' => call_user_func($field->options())])

                                    @endif

                                @endforeach


                            </div>
                        </div>
                    </div>

                    @endforeach

                </div>

                <div class="form-group">
                    <button class="btn btn-primary">Save</button>
                </div>

            </form>
        </div>

    </div>
@endsection