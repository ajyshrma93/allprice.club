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
                                <label>Date :</label>
                                <div class="input-group">
                                    <select name="date" class="form-control" onchange="draw()">
                                        <option value="">Select Month</option>
                                        @for ($i=1;$i<=12;$i++) <option value="{{date('Y-').$i}}">{{date('F Y',strtotime(date('Y-').$i.'-01'))}}</option>
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
</script>
@endpush
