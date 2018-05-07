@extends('avored-ecommerce::layouts.app')

@section('content')
    <div class="row">


        <div class="col-md-12">
            <div class="h1">Dashboard</div>

            <div class="row">
                <div class="col-4 widget-column" ondrop="drop(event)"
                     ondragover="allowDrop(event)">

                    <div class="widget-wrapper">
                        <div class="widget mt-3 mb-3" id="widget-{{ Widget::get('total-user')->identifier() }}"
                             draggable="true" ondragstart="drag(event)">
                            @include (Widget::get('total-user')->view(),Widget::get('total-user')->with())

                        </div>
                    </div>

                </div>
                <div class="col-4 widget-column" ondrop="drop(event)"
                     ondragover="allowDrop(event)">
                    <div class="widget-wrapper">
                        <div class="widget mt-3 mb-3" id="widget-{{ Widget::get('total-order')->identifier() }}"
                             draggable="true" ondragstart="drag(event)">
                            @include (Widget::get('total-order')->view(),Widget::get('total-order')->with())

                        </div>
                    </div>
                </div>

                <div class="col-4 widget-column" ondrop="drop(event)"
                     ondragover="allowDrop(event)">


                </div>

            </div>

        </div>
    </div>


@endsection

@push('scripts')
    <script>
        $(function () {


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