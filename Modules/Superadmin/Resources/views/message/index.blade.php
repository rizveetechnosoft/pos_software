@extends('layouts.app')
@section('title', __('superadmin::lang.superadmin') . ' | ' . __('superadmin::lang.communicator'))

@section('content')
    @include('superadmin::layouts.nav')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>SMS</h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="box box-solid">
                    <div class="box-header">
                        <h3 class="box-title">SMS Information</h3>
                    </div>

                    <div class="box-body">
            
                        <div class="col-md-4 col-sm-6 col-xs-12 col-custom">
                            <div class="info-box info-box-new-style" style="border: 1px solid #179d5080;">
                                <span class="info-box-icon bg-aqua"><i class="fa fas fa-money-check-alt"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Total Collection</span>
                                    <span class="info-box-number">{{ $totalAmount ?? 0 }}</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">SMS Buy History</h3>
                    </div>
                    <div class="box-body">
                        <table class="table" id="sms-user-list">
                            <thead>
                                <tr>
                                    <th>Business ID</th>
                                    <th>Business Name</th>
                                    <th>Mobile Number</th>
                                    <th>SMS Count</th>
                                    <th>Purches Date</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Created Date</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
@stop
@section('javascript')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#sms-user-list').DataTable({
                dom: 'lfrtip',
                processing: true,
                serverSide: true,
                ajax: '{{ action('\Modules\Superadmin\Http\Controllers\SuperadminNoticeController@getSMSInformation') }}',
                columns: [
                { data: 'business_id', name: 'business_id' },
                { data: 'name', name: 'name' },
                { data: 'mobile_number', name: 'mobile_number' },
                { data: 'sms_count', name: 'sms_count' },
                { data: 'purches__date', name: 'purches__date' },
                { data: 'amount', name: 'amount' },
                { data: 'status', name: 'status' },
                { data: 'created_at', name: 'created_at' },
            ]
            });
            init_tinymce('message');
        });
    </script>
@endsection
