@extends($layout)

@section('title', __('superadmin::lang.subscription'))

@section('content')

    <!-- Main content -->
    <section class="content">

        @include('superadmin::layouts.partials.currency')

        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title">@lang('superadmin::lang.pay_and_subscribe')</h3>
            </div>
            <div class="box-body">
                <div class="col-md-8">
                    <h3>
                        {{ $package->name }}
                        @php
                            $userName = Auth::user()->username;
                            $userId = Auth::user()->id;
                            // $userMobile = \App\BusinessLocation::where('name',$userName)->first();
                            // $mobile = $userMobile->mobile;
                        @endphp

                        (<span class="display_currency" data-currency_symbol="true">{{ $package->price }}</span>

                        <small>
                            / {{ $package->interval_count }} {{ ucfirst($package->interval) }}
                        </small>)
                    </h3>
                    <ul>
                        <li>
                            @if ($package->location_count == 0)
                                @lang('superadmin::lang.unlimited')
                            @else
                                {{ $package->location_count }}
                            @endif

                            @lang('business.business_locations')
                        </li>

                        <li>
                            @if ($package->user_count == 0)
                                @lang('superadmin::lang.unlimited')
                            @else
                                {{ $package->user_count }}
                            @endif

                            @lang('superadmin::lang.users')
                        </li>

                        <li>
                            @if ($package->product_count == 0)
                                @lang('superadmin::lang.unlimited')
                            @else
                                {{ $package->product_count }}
                            @endif

                            @lang('superadmin::lang.products')
                        </li>

                        <li>
                            @if ($package->invoice_count == 0)
                                @lang('superadmin::lang.unlimited')
                            @else
                                {{ $package->invoice_count }}
                            @endif

                            @lang('superadmin::lang.invoices')
                        </li>

                        @if ($package->trial_days != 0)
                            <li>
                                {{ $package->trial_days }} @lang('superadmin::lang.trial_days')
                            </li>
                        @endif


                    </ul>

                    <input type="hidden" id="package_price" value=" {{ $package->price }} ">

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Select Month</label>
                                <select name="month_count" id="month_count" class="form-control">
                                    <option value="1" selected>1 Month</option>
                                    <option value="2">2 Months</option>
                                    <option value="3">3 Months</option>
                                    <option value="4">4 Months</option>
                                    <option value="5">5 Months</option>
                                    <option value="6">6 Months</option>
                                    <option value="7">7 Months</option>
                                    <option value="8">8 Months</option>
                                    <option value="9">9 Months</option>
                                    <option value="10">10 Months</option>
                                    <option value="11">11 Months</option>
                                    <option value="12">12 Months</option>
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="payable">Total Payable</label>
                                <input type="number" id="total_payable" readonly value="{{ $package->price }}"
                                    class="form-control">
                            </div>
                        </div>

                    </div>

                    <ul class="list-group">
                        @foreach ($gateways as $k => $v)
                            <div class="list-group-item">
                                <b>@lang('superadmin::lang.pay_via', ['method' => $v])</b>

                                <div class="row" id="paymentdiv_{{ $k }}">
                                    @php
                                        $view = 'superadmin::subscription.partials.pay_' . $k;
                                    @endphp
                                    @includeIf($view)
                                </div>
                            </div>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>


@endsection

@push('js')
    <script>

		$(document).ready(function(){
			calculate_total_payable();
			changeURL();
		})

        function calculate_total_payable() {
            var month = $('#month_count').val();
            var package_price = $('#package_price').val();
            var total_payable = month * package_price;
            $('#total_payable').val(total_payable);


        }
        $(document).on('change', '#month_count', function() {
            calculate_total_payable();
			changeURL();
        })
    </script>
@endpush
