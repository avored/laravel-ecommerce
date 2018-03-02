@extends('mage2-ecommerce::admin.layouts.app')

@section('content')
    <div class="row">


        <div class="col-md-12">
            <div class="h1">Dashboard</div>

            <div class="row">
                <div class="col-4 widget-column" ondrop="drop(event)"
                     ondragover="allowDrop(event)">

                    <div class="widget-wrapper">
                        <div class="widget mt-3 mb-3" id="widget-total-user-1"
                             draggable="true" ondragstart="drag(event)"
                        >
                            <div class="widget">
                        <span class="bg-dark   d-block" style="cursor: move">
                            <i class="ml-2 text-white pt-2 fas fa-bars"></i>
                        </span>
                                <div class="card  ">
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
                        </div>
                    </div>

                </div>
                <div class="col-4 widget-column" ondrop="drop(event)"
                     ondragover="allowDrop(event)">
                    <div class="widget-wrapper">
                        <div class="widget mt-3 mb-3" id="widget-total-order"
                             draggable="true" ondragstart="drag(event)"
                        >
                         <span class="bg-dark   d-block" style="cursor: move">
                            <i class="ml-2 text-white pt-2 fas fa-bars"></i>
                        </span>
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
                </div>

                <div class="col-4 widget-column" ondrop="drop(event)"
                     ondragover="allowDrop(event)">


                </div>

            </div>
            <div class="row">
                <div class="col-4">

                    <canvas id="myChart" height="200px"></canvas>

                </div>
            </div>

        </div>
    </div>


@endsection

@push('scripts')
    <script>
        $(function () {
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


        });

        function allowDrop(ev) {

            ev.preventDefault();
        }

        function drag(ev) {

            var draggableElementId = jQuery(ev.target).prop('id');
            ev.dataTransfer.setData("elementId", draggableElementId);
        }

        function drop(ev) {
            ev.preventDefault();

            var widgetId = ev.dataTransfer.getData("elementId");
            var widgetContent = jQuery("#" + widgetId).parent().html();

            if (jQuery(ev.target).hasClass('empty-widget')) {
                jQuery(ev.target).parents('.widget-column:first').html("");
            }

            if (jQuery(ev.target).hasClass('widget-column')) {

                jQuery("#" + widgetId).parent().remove();
                jQuery(ev.target).append("<div class='widget-wrapper'>" + widgetContent + "</div>");


            } else {
                jQuery("#" + widgetId).parent().remove();
                jQuery(ev.target).parents('.widget-column:first').append("<div class='widget-wrapper'>" + widgetContent + "</div>");
            }

        }


    </script>
@endpush