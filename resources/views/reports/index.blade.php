@extends('layouts.custom')
@push('css')
<style>
    .switch {
        position: relative;
        display: inline-block;
        width: 60px !important;
        height: 25px !important;
    }

    /* Hide default HTML checkbox */
    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    /* The slider */
    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 18px;
        width: 20px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked+.slider {
        background-color: #2196F3;
    }

    input:focus+.slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked+.slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }
</style>

@endpush
@section('header')
<div class="page-header">
    <div class="header-wrapper row m-0">
        <div class="header-logo-wrapper col-auto p-0">
            <div class="logo-wrapper">
                <a href="{{url('/home')}}">
                    <img class="img-fluid" src="{{asset('assets/images/logo/logo.png')}}" alt="">
                </a>
            </div>
            <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="align-center"></i></div>
        </div>
        <div class="left-header col-auto horizontal-wrapper ps-0">

        </div>
        <div class="nav-right col-auto pull-right right-header p-0 ms-auto">
            <ul class="nav-menus me-0">
                <li> Share Purchase Publicly</li>
                <li>
                    <!-- Rounded switch -->
                    <label class="switch m-0">
                        <input type="checkbox" name="show_public" @if(auth()->user()->is_public) checked @endif>
                        <span class="slider round"></span>
                    </label>
                </li>
            </ul>
        </div>

    </div>
</div>

@endsection
@section('content')
<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-7">
                    <h3>Purchase History</h3>
                </div>
                <div class="col-5">
                    <div class="create-new-items justify-content-end">
                        <div class="input-group">
                            <select name="date" class="form-control" onchange="draw()">
                                @for ($i=date('m');$i>=1;$i--)
                                <option value="{{date('Y-').$i}}">{{date('F Y',strtotime(date('Y-').$i.'-01'))}}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <!-- API-3 start -->
            <div class="col-12">
                <div class="product-wrapper-grid">
                    <div id="Chart" class="row">
                        @include('reports.partials.list')
                    </div>
                </div>
            </div>
            <!-- API-3 end -->
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>
@endsection
@push('css')
<style>
    .day {
        padding: 8px;
    }
</style>
@endpush


@push('scripts')
<script>
    function draw() {
        let date = $('[name="date"]').val();
        $.ajax({
            url: '{{route("reports.filter")}}',
            data: {
                date: date,
            },
            method: 'POST',
            success: function(response) {
                if (response.success == true) {
                    $('#Chart').html(response.html);
                }
            }
        })
    }

    $('[name="show_public"]').change(function() {
        $.ajax({
            url: '{{route("users.update.status")}}',
            method: 'POST',
            success: function(response) {
                swal({
                    icon: "success",
                    title: response.message,
                })
            }
        })
    });
</script>
@endpush
