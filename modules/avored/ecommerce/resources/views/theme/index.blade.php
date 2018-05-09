@extends('avored-ecommerce::layouts.app')

@section('content')
    <div class="row mb-3">

        <div class="col-11">
            <div class="h1 float-left">
                {{  __('avored-ecommerce::theme.theme-list') }}
            </div>
        </div>
        <div class="col-1">
            <div class="float-right">
                <a href="{{ route('admin.theme.create') }}"
                   class="btn btn-primary">
                    {{  __('avored-ecommerce::theme.theme-upload') }}
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        @if(count($themes) <= 0)
            <p>Sorry No Theme Found</p>
        @else
            @foreach($themes as $theme)
                <div class="col-4">
                    <div class="card">
                        <img class="card-img-top" src="http://placehold.it/250x250" alt="Card image cap">

                        <div class="card-body">
                            <div class="h1">{{ $theme['name'] }}</div>
                        </div>
                        <div class="card-footer text-right">

                            @if($theme['identifier'] != 'avored-default' && $activeTheme == $theme['identifier'])
                                <form action="{{ route('admin.theme.deactivated', $theme['identifier']) }}" method="post">
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-primary">{{ __('avored-ecommerce::theme.deactivate') }}</button>

                                </form>
                            @elseif($theme['identifier'] == $activeTheme || $theme['identifier'] == 'avored-default')
                                <button disabled class="btn ">{{ __('avored-ecommerce::theme.activate') }}</button>
                            @else
                                <form action="{{ route('admin.theme.activated', $theme['identifier']) }}" method="post">
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('avored-ecommerce::theme.activate') }}
                                        </button>

                                </form>
                            @endif

                        </div>
                    </div>
                </div>
            @endforeach

        @endif

    </div>

@endsection

