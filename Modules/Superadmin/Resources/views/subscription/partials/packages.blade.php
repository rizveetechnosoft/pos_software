@foreach ($packages as $package)
    @if (
        $package->is_private == 1 &&
            !auth()->user()->can('superadmin'))
        @php
            continue;
        @endphp
    @endif

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap');

        .pricing_box {
            background: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            margin-top: 5rem;
            height: 100%;
            margin-bottom: 2rem;
            font-family: 'Poppins', sans-serif;
            transition: .3s;
            box-shadow: 2px 10px 18px 7px rgba(25, 25, 25, 0.12);
            -webkit-box-shadow: 2px 10px 18px 7px rgba(25, 25, 25, 0.12);
            -moz-box-shadow: 2px 10px 18px 7px rgba(25, 25, 25, 0.12);
        }

        .pricing_box:hover {
            transform: scale(1.03);
            -webkit-transform: scale(1.03);
            -moz-transform: scale(1.03);
            -ms-transform: scale(1.03);
            -o-transform: scale(1.03);
            background: #baf3ff
        }

        .pricing_box_header h2 {
            text-align: center;
            font-weight: 700;
            color: #fff;
            background-color: #3D2BFB;
            padding: 20px 0px;
            margin: 0;
        }

        .pricing_box_header h4 {
            background-color: #00aeef;
            color: black;
            padding: 10px 0px;
        }



        .feature_list {
            display: flex;
            flex-direction: column;
            row-gap: 1.5rem;


        }

        .feature_list .list_item {
            list-style: none;
            text-align: center;
            font-size: 1.5rem;
            font-weight: 500;

        }

        .pricing_box_price {
            color: #fdfdfd;
            text-align: center;
            font-size: 2.5rem;
            margin: 0 auto;
            font-family: 'Poppins', sans-serif;
            width: 140px;
            height: 140px;
            background-color: #ff6633;
            padding: 0px 10px;
            padding-top: 50px;
            border-radius: 50%;
        }

        .pricing_box_price span {
            font-weight: 700;
            color: #fff
        }
        .pricing_box_price small {
            
            color: #fff
        }

        .pricing_box_footer {
            text-align: center;
            padding: 4rem;
        }

        .pricing_btn {
            background: #22a383;
            color: #fff;
            transition: .3s;
            padding: 1.4rem 3rem;
            border-radius: 3rem;
        }

        .pricing_btn:hover {
            background: #156853;
            color: #fff;
        }
    </style>

<div class="col-md-4">
    <div class="pricing_box">
        <div class="pricing_box_body">
            <div class="feature_list">

                @if ($package->id == 1)
                    <div class="pricing_box_header">
                        <h2>ফ্রি ১৪ দিন ট্রায়াল</h2>
                    </div>
                @endif

                @if ($package->id == 2)
                    <div class="pricing_box_header">
                        <h2>স্টার্টআপ</h2>
                        <h4 class="text-center">সেটআপ ফী ৳ ৪৯৯০</h4>
                    </div>
                @endif

                @if ($package->id == 3)
                    <div class="pricing_box_header">
                        <h2>বিজনেস</h2>
                        <h4 class="text-center">সেটআপ ফী ৳ ৪৯৯৯</h4>
                    </div>
                @endif

                @if ($package->id == 4)
                    <div class="pricing_box_header">
                        <h2>কর্পোরেট</h2>
                        <h4 class="text-center">সেটআপ ফী ৳ ৪৯৯৯</h4>
                    </div>
                @endif

                @if ($package->id == 5)
                    <div class="pricing_box_header">
                        <h2>স্ট্যান্ডার্ড</h2>
                        <h4 class="text-center">সেটআপ ফী ৳ ১৪৯৯০</h4>
                    </div>
                @endif

                @if ($package->id == 6)
                    <div class="pricing_box_header">
                        <h2 style="font-size: 25px">কাস্টমাইজড সফটওয়্যার</h2>
                        <h4 class="text-center">আলোচনা সাপেক্ষে </h4>
                    </div>
                @endif

                <h1 class="pricing_box_price">
                    @php
                        $interval_type = !empty($intervals[$package->interval]) ? $intervals[$package->interval] : __('lang_v1.' . $package->interval);
                    @endphp
                    @if ($package->price != 0)
                        @if ($package->id == 6)
                            <span style="font-size: 20px">আলোচনা সাপেক্ষে </span>
                        @else
                            <span>
                                ৳{{ (int) $package->price }}
                            </span>

                            <small>
                                / Monthly
                            </small>
                        @endif
                    @else
                        @lang('superadmin::lang.free_for_duration', ['duration' => $package->interval_count . ' ' . $interval_type])
                    @endif
                </h1>

                <!-- For 1 id code start -->
                @if ($package->id == 1)
                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            কোম্পানি -১
                        </span>
                    </div>

                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            প্রোডাক্ট এন্ট্রি -৫০০
                        </span>
                    </div>

                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            ইনভয়েস ৫০০ (মাসিক)
                        </span>
                    </div>

                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                           স্টাফ / ইউজার - ১
                        </span>
                    </div>

                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            কাস্টমার - ১০০
                        </span>
                    </div>

                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            সাপ্লাইয়ার - ১০০
                        </span>
                    </div>


                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            রিপোর্টস
                        </span>
                    </div>


                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            অ্যাকাউন্টস
                        </span>
                    </div>

                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            সেলস
                        </span>
                    </div>

                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            স্টক ম্যানেজমেন্ট
                        </span>
                    </div>
                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            খরচ
                        </span>
                    </div>

                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            এসএমএস
                        </span>
                    </div>

                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            ডাটাবেস ব্যাকআপ
                        </span>
                    </div>

                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            সেলস
                        </span>
                    </div>

                    <div class="list_item">
                        <i class="fas fa-times cross text-danger"></i>
                        <span>
                            অনলাইন ট্রেনিং
                        </span>
                    </div>
                    <div class="list_item" style="margin-bottom: 57px">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            কাস্টমার সাপোর্ট ২৪/৭
                        </span>
                    </div>
                @endif

                <!-- For 2 id code start -->
                @if ($package->id == 2)
                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            কোম্পানি -১
                        </span>
                    </div>

                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            প্রোডাক্ট এন্ট্রি -৫০০
                        </span>
                    </div>

                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            ইনভয়েস ৫০০ (মাসিক)
                        </span>
                    </div>

                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                           স্টাফ / ইউজার - ১
                        </span>
                    </div>

                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            কাস্টমার - ১০০
                        </span>
                    </div>

                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            সাপ্লাইয়ার - ১০০
                        </span>
                    </div>


                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            রিপোর্টস
                        </span>
                    </div>


                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            অ্যাকাউন্টস
                        </span>
                    </div>

                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            সেলস
                        </span>
                    </div>

                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            স্টক ম্যানেজমেন্ট
                        </span>
                    </div>
                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            খরচ
                        </span>
                    </div>

                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            এসএমএস
                        </span>
                    </div>

                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            ডাটাবেস ব্যাকআপ
                        </span>
                    </div>

                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            সেলস
                        </span>
                    </div>

                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            অনলাইন ট্রেনিং
                        </span>
                    </div>
                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            কাস্টমার সাপোর্ট ২৪/৭
                        </span>
                    </div>
                @endif

                <!-- For 3 id code start -->
                @if ($package->id == 3)
                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            কোম্পানি -১
                        </span>
                    </div>

                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            প্রোডাক্ট এন্ট্রি -১০০০
                        </span>
                    </div>

                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            ইনভয়েস ১০০০ (মাসিক)
                        </span>
                    </div>

                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                           স্টাফ / ইউজার - ১
                        </span>
                    </div>

                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            কাস্টমার - ৫০০
                        </span>
                    </div>

                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            সাপ্লাইয়ার - ৫০০
                        </span>
                    </div>



                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            রিপোর্টস
                        </span>
                    </div>


                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            অ্যাকাউন্টস
                        </span>
                    </div>

                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            সেলস
                        </span>
                    </div>

                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            স্টক ম্যানেজমেন্ট
                        </span>
                    </div>
                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            খরচ
                        </span>
                    </div>

                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            এসএমএস
                        </span>
                    </div>

                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            ডাটাবেস ব্যাকআপ
                        </span>
                    </div>

                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            সেলস
                        </span>
                    </div>

                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            অনলাইন ট্রেনিং
                        </span>
                    </div>
                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            কাস্টমার সাপোর্ট ২৪/৭
                        </span>
                    </div>
                @endif

                <!-- For 4 id code start -->
                @if ($package->id == 4)
                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            কোম্পানি -১
                        </span>
                    </div>

                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            প্রোডাক্ট এন্ট্রি -২০০০
                        </span>
                    </div>

                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            ইনভয়েস ২০০০ (মাসিক)
                        </span>
                    </div>

                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            স্টাফ / ইউজার - ২
                        </span>
                    </div>

                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            কাস্টমার - ১০০০
                        </span>
                    </div>

                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            সাপ্লাইয়ার - ১০০
                        </span>
                    </div>


                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            রিপোর্টস
                        </span>
                    </div>


                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            অ্যাকাউন্টস
                        </span>
                    </div>

                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            সেলস
                        </span>
                    </div>

                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            স্টক ম্যানেজমেন্ট
                        </span>
                    </div>
                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            খরচ
                        </span>
                    </div>

                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            এসএমএস
                        </span>
                    </div>

                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            ডাটাবেস ব্যাকআপ
                        </span>
                    </div>

                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            সেলস
                        </span>
                    </div>

                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            অনলাইন ট্রেনিং
                        </span>
                    </div>
                    <div class="list_item" style="margin-bottom: 138px">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            কাস্টমার সাপোর্ট ২৪/৭
                        </span>
                    </div>
                @endif

                <!-- For 5 id code start -->
                @if ($package->id == 5)
                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            কোম্পানি -২
                        </span>
                    </div>

                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            আনলিমিটেড প্রোডাক্ট এন্ট্রি
                        </span>
                    </div>

                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            আনলিমিটেড ইনভয়েস
                        </span>
                    </div>

                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            স্টাফ / ইউজার - ৩
                        </span>
                    </div>

                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            আনলিমিটেড কাস্টমার
                        </span>
                    </div>

                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            আনলিমিটেড সাপ্লাইয়ার
                        </span>
                    </div>
                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            ওয়ারেন্টি/ গ্যারেন্টি সিস্টেম
                        </span>
                    </div>


                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            রিপোর্টস
                        </span>
                    </div>


                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            অ্যাকাউন্টস
                        </span>
                    </div>

                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            সেলস
                        </span>
                    </div>

                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            স্টক ম্যানেজমেন্ট
                        </span>
                    </div>
                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            খরচ
                        </span>
                    </div>

                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            এসএমএস
                        </span>
                    </div>

                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            ডাটাবেস ব্যাকআপ
                        </span>
                    </div>

                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            সেলস
                        </span>
                    </div>

                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            অনলাইন ট্রেনিং
                        </span>
                    </div>
                    <div class="list_item" style="margin-bottom: 102px">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            কাস্টমার সাপোর্ট ২৪/৭
                        </span>
                    </div>
                @endif

                <!-- For 6 id code start -->
                @if ($package->id == 6)
                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            আনলিমিটেড কোম্পানি
                        </span>
                    </div>

                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            আনলিমিটেড প্রোডাক্ট এন্ট্রি
                        </span>
                    </div>

                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            আনলিমিটেড ইনভয়েস
                        </span>
                    </div>

                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            আনলিমিটেড স্টাফ / ইউজার
                        </span>
                    </div>

                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            আনলিমিটেড কাস্টমার
                        </span>
                    </div>

                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            আনলিমিটেড সাপ্লাইয়ার
                        </span>
                    </div>
                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            কাস্টম ডোমেইন
                        </span>
                    </div>

                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            ই-কমার্স ওয়েবসাইট
                        </span>
                    </div>

                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            অনলাইন অর্ডার
                        </span>
                    </div>

                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            ওয়ারেন্টি / গ্যারেন্টি সিস্টেম
                        </span>
                    </div>
                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            রিপোর্টস
                        </span>
                    </div>


                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            অ্যাকাউন্টস
                        </span>
                    </div>

                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            সেলস
                        </span>
                    </div>

                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            স্টক ম্যানেজমেন্ট
                        </span>
                    </div>
                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            খরচ
                        </span>
                    </div>

                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            এসএমএস
                        </span>
                    </div>

                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            ডাটাবেস ব্যাকআপ
                        </span>
                    </div>

                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            সেলস
                        </span>
                    </div>

                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            অনলাইন ট্রেনিং
                        </span>
                    </div>
                    <div class="list_item">
                        <i class="fa fa-check text-success"></i>
                        <span>
                            কাস্টমার সাপোর্ট ২৪/৭
                        </span>
                    </div>
                @endif

            </div>




        </div>

        <div class="pricing_box_footer">

            @if ($package->enable_custom_link == 1)
                <a href="{{ $package->custom_link }}" class="pricing_btn">
                    {{ $package->custom_link_text }}</a>
            @else
                @if (isset($action_type) && $action_type == 'register')
                    <a href="{{ route('business.getRegister') }}?package={{ $package->id }}"
                        class="pricing_btn">
                        @if ($package->price != 0)
                            @lang('superadmin::lang.register_subscribe')
                        @else
                            @lang('superadmin::lang.register_free')
                        @endif

                    </a>
                @else
                    <a href="{{ action('\Modules\Superadmin\Http\Controllers\SubscriptionController@pay', [$package->id]) }}"
                        class="pricing_btn">

                        Order Now
                    </a>
                @endif
            @endif

        </div>

    </div>
    <!-- /.box -->
</div>
@if ($loop->iteration % 3 == 0)
    <div class="clearfix"></div>
@endif
@endforeach
