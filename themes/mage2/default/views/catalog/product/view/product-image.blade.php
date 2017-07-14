<?php

$image = $product->image;

?>
@if(NULL !== $image)
    <img alt="{{ $product->title }}"
         style="height: 250px"
         class="img-responsive img-thumbnail"
         src="{{ $image->smallUrl }}"/>
@endif


<style>

    .inside {
        margin-top: 20px;
        margin-bottom: 20px;
        background: #ededed;
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #f4f4f4), color-stop(100%, #ededed));
        background: -moz-linear-gradient(top, #f4f4f4 0%, #ededed 100%);
        background: -ms-linear-gradient(top, #f4f4f4 0%, #ededed 100%);
    }

    .inside-full-height {
        /*
        // if you want to give content full height give him height: 100%;
        // with content full height you can't apply margins to the content
        // content full height does not work in ie http://stackoverflow.com/questions/27384433/ie-display-table-cell-child-ignores-height-100
        */
        height: 100%;
        margin-top: 0;
        margin-bottom: 0;
    }

    /* columns of same height styles */

    .row-height {
        display: table;
        table-layout: fixed;
        height: 100%;
        width: 100%;
    }

    .col-height {
        display: table-cell;
        float: none;
        height: 100%;
    }

    .col-top {
        vertical-align: top;
    }

    .col-middle {
        vertical-align: middle;
    }

    .col-bottom {
        vertical-align: bottom;
    }

    @media (min-width: 480px) {
        .row-xs-height {
            display: table;
            table-layout: fixed;
            height: 100%;
            width: 100%;
        }

        .col-xs-height {
            display: table-cell;
            float: none;
            height: 100%;
        }

        .col-xs-top {
            vertical-align: top;
        }

        .col-xs-middle {
            vertical-align: middle;
        }

        .col-xs-bottom {
            vertical-align: bottom;
        }
    }

    @media (min-width: 768px) {
        .row-sm-height {
            display: table;
            table-layout: fixed;
            height: 100%;
            width: 100%;
        }

        .col-sm-height {
            display: table-cell;
            float: none;
            height: 100%;
        }

        .col-sm-top {
            vertical-align: top;
        }

        .col-sm-middle {
            vertical-align: middle;
        }

        .col-sm-bottom {
            vertical-align: bottom;
        }
    }

    @media (min-width: 992px) {
        .row-md-height {
            display: table;
            table-layout: fixed;
            height: 100%;
            width: 100%;
        }

        .col-md-height {
            display: table-cell;
            float: none;
            height: 100%;
        }

        .col-md-top {
            vertical-align: top;
        }

        .col-md-middle {
            vertical-align: middle;
        }

        .col-md-bottom {
            vertical-align: bottom;
        }
    }

    @media (min-width: 1200px) {
        .row-lg-height {
            display: table;
            table-layout: fixed;
            height: 100%;
            width: 100%;
        }

        .col-lg-height {
            display: table-cell;
            float: none;
            height: 100%;
        }

        .col-lg-top {
            vertical-align: top;
        }

        .col-lg-middle {
            vertical-align: middle;
        }

        .col-lg-bottom {
            vertical-align: bottom;
        }
    }
</style>