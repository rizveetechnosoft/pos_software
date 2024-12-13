<div class="col-md-12">
   	<form action="{{action([\Modules\Superadmin\Http\Controllers\SubscriptionController::class, 'confirm'], [$package->id])}}" method="POST">
        {{ csrf_field() }}
        <input type="hidden" name="gateway" value="{{ $k }}">
		

        @php
            $price = 0;

            if (auth()->user()->sub_status == 0) {
                if ($package->id == 2) {
                    $price += 4990;
                } elseif ($package->id == 3) {
                    $price += 4999;
                }elseif ($package->id == 4) {
                    $price += 4999;
                }elseif ($package->id == 5) {
                    $price += 14990;
                } else {
                    $price = 0;
                }
            }
        @endphp

        <input type="hidden" id="calculated_package_price" value="{{ $price }}">

        <button type="submit" class="btn btn-success"> <i class="fas fa-handshake"></i> {{ $v }}</button>
        <a id="bkash_payment_button" href="#"
            target="_blank" class="btn btn-info">Pay with bkash</a>
    </form>
    <p class="help-block">@lang('superadmin::lang.offline_pay_helptext')</p>
    <p class="help-block">{!! nl2br($offline_payment_details) ?? '' !!}</p>
</div>

@push('js')
    
<script>


    function changeURL(){
        var package_name = "{{ $package->name }}";
        var package_id = "{{ $package->id }}";
        var user_name = "{{ $userName }}";
        var user_id = "{{ $userId }}";
        var price = $('#total_payable').val();
        var calculated_package_price = $('#calculated_package_price').val();
        price = +price + +calculated_package_price;


        $('#bkash_payment_button').attr('href', 'https://bkash.sumondutta.com/bkash/payment?packageId='+package_id+'&packageName='+package_name+'&price='+price+'&userName='+user_name+'&id='+user_id+'&from=pos');
    }
</script>

@endpush
