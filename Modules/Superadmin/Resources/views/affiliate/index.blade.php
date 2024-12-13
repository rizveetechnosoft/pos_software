@extends('layouts.app')
@section('title', __('superadmin::lang.superadmin') . ' | ' . __('superadmin::lang.communicator'))

@section('content')
    @include('superadmin::layouts.nav')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Affiliate</h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="box box-solid">
                    <div class="box-header">
                        <h3 class="box-title">Affiliate Information</h3>
                    </div>

                    <div class="box-body">
                        <!-- /.col -->
                        <div class="col-md-3 col-sm-6 col-xs-12 col-custom" >
                            <div class="info-box info-box-new-style" style="border: 1px solid #179d5080;">
                                <span class="info-box-icon bg-aqua"><i class="fa fas fa-users"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Total Promotter</span>
                                    <span class="info-box-number">{{ $promoterCount ?? 0 }}</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12 col-custom">
                            <div class="info-box info-box-new-style" style="border: 1px solid #179d5080;">
                                <span class="info-box-icon bg-aqua"><i class="fa fas fa-money-check-alt"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Monthly Collection</span>
                                    <span class="info-box-number">{{ $monthly_collection ?? 0 }}</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12 col-custom">
                            <div class="info-box info-box-new-style" style="border: 1px solid #179d5080;">
                                <span class="info-box-icon bg-aqua"><i class="fa fas fa-money-check-alt"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Payable Amount</span>
                                    <span class="info-box-number">{{ $payable_amount ?? 0 }}</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12 col-custom">
                            <div class="info-box info-box-new-style" style="border: 1px solid #179d5080;">
                                <span class="info-box-icon bg-aqua"><i class="fa fas fa-money-check-alt"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Total Amount</span>
                                    <span class="info-box-number">{{ $total_affiliate_amount ?? 0 }}</span>
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
                        <h3 class="box-title">Promotter Information</h3>
                    </div>
                    <div class="box-body">
                        <table class="table" id="promotter-list">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Username</th>
                                    <th>Password</th>
                                    <th>Mobile</th>
                                    <th>Total Click</th>
                                    <th>Total refer</th>
                                    <th>Action</th>
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
            $('#promotter-list').DataTable({
                dom: 'lfrtip',
                processing: true,
                serverSide: true,
                ajax: '{{ action('\Modules\Superadmin\Http\Controllers\AffiliateController@getPromotter') }}',
                columns: [
                { data: 'first_name', name: 'first_name' },
                { data: 'user_type', name: 'user_type' },
                { data: 'username', name: 'username' },
                { data: 'pass_show', name: 'pass_show' },
                { data: 'contact_number', name: 'contact_number' },
                { data: 'click_count', name: 'click_count' },
                { data: 'referrals_count', name: 'referrals_count' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ]
            });
            init_tinymce('message');
        });
    </script>
@endsection
