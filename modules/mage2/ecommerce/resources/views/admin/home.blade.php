@extends('mage2-ecommerce::admin.layouts.app')

@section('content')
    <div class="row mb-4">
        <div class="col-3">
            <div class="card widget ">
                <div class="card-body">
                    <div class="row">
                    <div class="col-4 text-center bg-primary-dark pv-lg">
                        <em class="oi oi-people" style="font-size: 50px"></em>
                    </div>
                    <div class="col-8 pv-lg">
                        <div class="h2 mt0">{{ $totalRegisteredUser }}</div>
                        <div class="text-uppercase">{{ __('mage2-ecommerce::lang.admin-dashboard-total-user-title') }}</div>
                    </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                    <div class="col-4 text-center">
                        <em class="oi oi-dollar" style="font-size: 50px"></em>
                    </div>
                    <div class="col-8 pv-lg">
                        <div class="h2 mt0">{{ $totalOrder }}</div>
                        <div class="text-uppercase">{{ __('mage2-ecommerce::lang.admin-dashboard-total-order-title') }}</div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-8">
            <canvas id="myChart" height="100px"></canvas>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    var ctx = document.getElementById("myChart");
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [ {!! $visitorLabelCollection !!} ],
            datasets: [{
                label: '# of Visits',
                data: [{{ $visitorValueCollection }}],
                borderWidth: 1
            }]
        },
    });
</script>
@endpush