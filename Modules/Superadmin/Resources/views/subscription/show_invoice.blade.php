@extends('layouts.app')
@section('title', 'Pay Bill')

@section('content')
    <style>
        .invoice_wrapper {
            background: #fff;
            margin: 0px 100px;
            padding: 50px;
            border-radius: 5px;
        }

        .invoiceNumber {
            padding-top: 10px;
            font-size: 14px;
            text-transform: uppercase;
            font-weight: 600;
        }

        .inNo {
            font-size: 18px;
            font-weight: 200;
        }

        .txt_color1 {
            color: #00aeef;
            font-size: 30px;
            font-weight: bold;
        }

        .txt_color2 {
            color: red;
            font-size: 30px;
            font-weight: bold;
        }

        .common_txt {
            color: #434343;
            font-size: 22px;
            font-weight: 500;
        }

        .common_sub_txt {
            font-size: initial;
            font-weight: inherit;
            font-size: 14px !important;
        }

        .payment_method_wrapper {
            display: flex;
            justify-content: center;
            background: #a0bfad1a;
            background-color: rgba(160, 191, 173, 0.1);
            background-position-x: 0%;
            background-position-y: 0%;
            background-repeat: repeat;
            background-attachment: scroll;
            background-image: none;
            background-size: auto;
            background-origin: padding-box;
            background-clip: border-box;
            border-radius: 10px;
            padding: 15px 30px;
            margin-bottom: 20px;
            color: #e2136e;
            border: 1px solid #d9cdcd;
        }

        .payment_method {
            margin: 0 auto;
            display: flex;
            align-items: center;
            column-gap: 10px;
            border-radius: 10px;
        }

        .thead tr th {
            background-color: #f9f9f9 !important;
            color: white;
        }

        hr {
            border-top: 2px solid #f2ebeb;
            border-top-color: rgb(242, 235, 235);
            border-top-style: solid;
            border-top-width: 2px;
        }

        .table>thead>tr>th {
            border-bottom: 2px solid #f2ebeb;
            font-weight: unset;
        }

        b,
        strong {
            font-weight: 500;
        }

        table,
        th,
        td {
            border: 1px solid #ced4e4;
        }
    </style>

    <!-- Main content -->
    <section class="content">
        <div class="invoice_wrapper">
            @if (!$subscription->payment_transaction_id)
                <div class="row">
                    <div class="col-md-12">
                        <div class="payment_method_wrapper">
                            <div class="payment_method">
                                <label style="color:#867878" for="">Payment Method : </label>
                                <select name="" id="" style="border-radius: 5px; padding:7px; width:200px">
                                    <option value="bkash">Bkash</option>
                                </select>


                                <form method="POST" action="{{ route('subscription/pay-bkash') }}">
                                    @csrf
                                    <!-- Add form fields -->
                                    <input type="hidden" name="packageId" value="{{ $subscription->package_id }}">
                                    <input type="hidden" name="packageName" value="{{ $subscription['package_details']['name'] }}">
                                    <input type="hidden" name="price" value="{{ $subscription['package_price'] }}">
                                    <input type="hidden" name="userName" value="{{ $subscription->business_name }}">
                                    <input type="hidden" name="id" value="{{ $subscription->id }}">
                                    <!-- Add more fields as needed -->
                                    <button class="btn btn-success" type="submit" style="background-color: #e2136e; border:1px solid #fff;">Pay with Bkash</button>
                                </form>
                                

                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="row">
                {{-- {{ $subscription }} --}}
                <div class="col-md-8">
                    <img style="margin-bottom: 10px;" src="{{ asset('uploads/logo.png') }}" height="50" width="200"
                        alt="sure2shop" width="100%"><br>
                    <span class="invoiceNumber">Invoice <span class="inNo">#137279</span></span><br>
                      <strong style="font-weight:bold; font-size:12px">Invoice Date :
                    </strong> <span style="font-size:12px">{{ Carbon::parse($subscription['created_at'])->format('Y-m-d') }}</span>
                </div>
                <div class="col-md-4">
                    @if ($subscription->payment_transaction_id)
                        <h3 class=" txt_color1">Paid</h3>
                    @else
                        <h3 class="txt_color2">Unpaid</h3>
                    @endif

                </div>
            </div>
            <hr>

            {{-- {{ $subscription }} --}}

            <div class="row">
                <div class="col-md-6">
                    <h3 class="common_txt">Invoice To</h3>
                    <p class="common_sub_txt">{{ $subscription->business_name }}<br>{{ $subscription->business_address }}
                    </p>



                </div>
             
            </div>
            {{-- <div class="row">
                <div class="col-md-12">
                   <strong style="font-weight:bold; font-size:12px">Invoice Date :
                        </strong> <span style="font-size:12px">{{ Carbon::parse($subscription['created_at'])->format('Y-m-d') }}</span>
                </div>
            </div> --}}

            <div class="row" style="margin-top:0px">
                <div class="col-md-12">
                    <h3 class="common_txt">Invoice Items</h3>
                </div>
                <div class="col-md-12">
                    <table class="table" style="width: 100%; border-bottom: 1px solid #ced4e4;">
                        <thead>
                            <tr
                                style="width: 100%; background-color:#00aeef; border-top: 1px solid  #ced4e4;
                            border-bottom: 1px solid #ced4e4; color:#fff; font-size:14px;">
                                <th>SL</th>
                                <th>Description</th>
                                <th>Unit cost</th>
                                <th>Qty</th>
                                <th class="text-right">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!empty($subscription['package_details']))
                                <tr style="font-size:14px;"">
                                    <td>1</td>
                                    <td>{{ $subscription['package_details']['name'] }}
                                        ({{ Carbon::parse($subscription['start_date'])->format('Y-m-d') }} -
                                        {{ Carbon::parse($subscription['end_date'])->format('Y-m-d') }})</td>
                                    <td></td>
                                    <td>1</td>
                                    <td class="text-right">TK {{ number_format($subscription['package_price'], 0) }} BDT
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-right" style="font-size:14px;"">
                    <div><strong>Total Amount : </strong> TK {{ number_format($subscription['package_price'], 0) }} BDT
                    </div>
                    <div><strong>Discount : </strong> TK 0.00 BDT</div>
                    <div><strong>Received Amount : </strong> TK {{ number_format($subscription['package_price'], 0) }} BDT
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 text-right" style="font-size:14px;"">
                    <h3
                        style="border-top:1px solid rgb(205, 205, 205);border-bottom:1px solid rgb(205, 205, 205); font-size:18px; padding:10px 0px">
                        <strong>Due Amount : </strong> TK 0.00 BDT
                    </h3>
                </div>
            </div>

            <div class="row" style="margin-top:0px">
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                            <tr
                                style="width: 100%; background-color:#00aeef; border-top: 1px solid  #ced4e4;
                            border-bottom: 1px solid #ced4e4; color:#fff; font-size:14px;"">
                                <td>Transaction Date</td>
                                <td>Gateway</td>
                                <td>Transaction ID</td>
                                <td>Amount</td>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!empty($subscription['payment_transaction_id']))
                                <tr style="font-size:14px;"">
                                    <td>{{ Carbon::parse($subscription['created_at'])->format('Y-m-d') }}</td>
                                    <td>{{ $subscription['paid_via'] }}</td>
                                    <td>{{ $subscription['payment_transaction_id'] }}</td>
                                    <td>TK {{ number_format($subscription['package_price'], 0) }} BDT</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row" style="margin-top:0px">
                <div class="col-md-12">
                    <div class="col-md-6 text-left" style="padding: 0px">
                        <h3 style="border-bottom:2px solid #00aeef;  padding:0px 0px"><strong style="font-size:13px;">
                                <img style="margin-bottom: 10px;visibility: hidden;" src="{{ asset('uploads/sign.png') }}"
                                    height="90" width="90" alt="sure2shop" width="100%"><br>
                                Customer's Signature </strong></h3>
                    </div>

                    <div class="col-md-6 text-right" style="padding: 0px">
                        <h3 style="border-bottom:2px solid #00aeef;  padding:0px 0px"><strong style="font-size:13px;">
                                <img style="margin-bottom: 10px;" src="{{ asset('uploads/sign.png') }}" height="90"
                                    width="100" alt="sure2shop" width="100%"><br>
                                Authority's Signature </strong></h3>
                    </div>

                </div>
           
            </div>

<button onclick="printPage()">Print</button>
            <strong style="font-weight:bold; font-size:12px">Print Date :
            </strong> <span style="font-size:12px">{{ date('Y-m-d') }}</span>

        </div>
    </section>
@endsection


<script>
    function printPage() {
        window.print();
    }
</script>
