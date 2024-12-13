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
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Reffer Information</h3>
                    </div>
                    <div class="box-body">
                        <table class="table" id="reffer-list">
                            <thead>
                                <tr>
                                    <th>Owner Name</th>
                                    <th>Business Name</th>
                                    <th>Email</th>
                                    <th>Start Date</th>
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

            $('#reffer-list').DataTable({
                dom: 'lfrtip',
                processing: true,
                serverSide: true,
                ajax: '{{ action('\Modules\Superadmin\Http\Controllers\AffiliateController@getReffer',['id' => $promotter_id]) }}',
                columns: [
                    {
                    data: 'first_name',
                    name: 'first_name'
                   },
                    {
                    data: 'name',
                    name: 'name'
                   },
                    {
                    data: 'email',
                    name: 'email'
                   },
                    {
                    data: 'start_date',
                    name: 'start_date'
                   }
            
            ]
            });

            init_tinymce('message');
        });
    </script>
@endsection
