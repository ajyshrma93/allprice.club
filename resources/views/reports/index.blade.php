@extends('layouts.app')

@section('content')
<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-5">
                    <h3>Reports</h3>
                </div>
                <div class="col-7">
                    <div class="create-new-items justify-content-end">

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
                <div class="card">
                    <div class="card-body">
                        <div class="row justify-content-lg-start justify-content-center mb-3">
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                <label>Month :</label>
                                <div class="input-group">
                                    <select name="month" class="form-control" onchange="draw()">
                                        <option value="">Select Month</option>
                                        @for ($i=1;$i<=12;$i++) <option value="{{$i}}">{{date('F',strtotime('2020-'.$i.'-01'))}}</option>
                                            @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                <label>Year :</label>
                                <div class="input-group">
                                    <select name="year" class="form-control" onchange="draw()">
                                        @for ($i=2021;$i<=date('Y');$i++) <option value="{{$i}}" @if($i==date('Y')) selected @endif>{{$i}}</option>
                                            @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div id="Chart" class="row">
                            @include('reports.partials.list')
                        </div>
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
        let month = $('[name="month"]').val();
        let year = $('[name="year"]').val();
        $.ajax({
            url: '{{route("reports.filter")}}',
            data: {
                month: month,
                year: year
            },
            method: 'POST',
            success: function(response) {
                if (response.success == true) {
                    $('#Chart').html(response.html);
                }
            }
        })
    }
</script>
@endpush
