@php
    $courier_service = isset($courier_settings['courier_service']) ? $courier_settings['courier_service'] : 'steadfast';
@endphp

<div class="modal-dialog no-print" role="document">
    {!! Form::open(['url' => action([\App\Http\Controllers\SellController::class, 'postCourierOrder'], [$sell->id]), 'method' => 'post', 'id' => 'post_courier_order']) !!}
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close no-print" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="modalTitle">
                @lang('lang_v1.create_courier_order') (<b>
                    @if ($sell->type == 'sales_order')
                        @lang('restaurant.order_no')
                    @else
                        @lang('sale.invoice_no')
                    @endif :
                </b> {{ $sell->invoice_no }})
            </h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        {!! Form::label('courier', __('lang_v1.select_courier') . ':') !!}
                        {!! Form::select('courier', config('constants.couriers'), $courier_service, ['class' => 'form-control', 'placeholder' => __('messages.please_select'), 'required']) !!}
                    </div>
                </div>
            </div>
            <div class="row courier_details @if ($courier_service != 'e_courier') hide @endif" data-service="e_courier">
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('e_courier_payment_method', __('lang_v1.payment_method') . ':') !!}
                        {!! Form::select('e_courier_payment_method', config('constants.payment_method.e_courier'), null, ['class' => 'form-control', 'placeholder' => __('lang_v1.payment_method')]) !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('e_courier_thana', __('lang_v1.enter_thana') . ':') !!}
                        {!! Form::text('e_courier_thana', null, ['class' => 'form-control', 'placeholder' => __('lang_v1.enter_thana')]) !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('e_courier_area', __('lang_v1.enter_area') . ':') !!}
                        {!! Form::text('e_courier_area', null, ['class' => 'form-control', 'placeholder' => __('lang_v1.enter_area')]) !!}
                    </div>
                </div>
            </div>
            <div class="row courier_details @if ($courier_service != 'pathao') hide @endif" data-service="pathao">
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('pathao_store', __('lang_v1.store') . ':') !!}
                        {!! Form::select('pathao_store', $pathaoStores, null, ['class' => 'form-control', 'placeholder' => __('lang_v1.store')]) !!}
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('pathao_recipient_city', __('lang_v1.recipient_city') . ':') !!}
                        {!! Form::select('pathao_recipient_city', $pathaoCities, null, ['class' => 'form-control', 'placeholder' => __('lang_v1.recipient_city')]) !!}
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('pathao_recipient_zone', __('lang_v1.recipient_zone') . ':') !!}
                        {!! Form::select('pathao_recipient_zone', [], null, ['class' => 'form-control', 'placeholder' => __('lang_v1.recipient_zone')]) !!}
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('pathao_delivery_type', __('lang_v1.delivery_type') . ':') !!}
                        {!! Form::select('pathao_delivery_type', config('constants.delivery_type.pathao'), array_keys(config('constants.delivery_type.pathao'))[0], ['class' => 'form-control', 'placeholder' => __('lang_v1.delivery_type')]) !!}
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('pathao_item_type', __('lang_v1.item_type') . ':') !!}
                        {!! Form::select('pathao_item_type', config('constants.item_type.pathao'), array_keys(config('constants.item_type.pathao'))[1], ['class' => 'form-control', 'placeholder' => __('lang_v1.item_type')]) !!}
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('pathao_item_quantity', __('lang_v1.item_quantity') . ':') !!}
                        {!! Form::text('pathao_item_quantity', null, ['class' => 'form-control input_number', 'placeholder' => __('lang_v1.item_quantity')]) !!}
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('pathao_item_weight', __('lang_v1.item_weight_in_kg') . ':') !!}
                        {!! Form::text('pathao_item_weight', null, ['class' => 'form-control input_number', 'placeholder' => __('lang_v1.item_weight_in_kg')]) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">@lang('lang_v1.send')</button>
            <button type="button" class="btn btn-default no-print" data-dismiss="modal">@lang('messages.close')</button>
        </div>
    </div>
    {!! Form::close() !!}
</div>

<script>
    // Set the localizer value for recipient_zone
    var recipientZonePlaceholder = "{{ __('lang_v1.recipient_zone') }}";

    // On page load, ensure the default selected courier service fields are required
    $(document).ready(function() {
        var default_courier_service = $('#courier').val();
        toggleCourierFields(default_courier_service);
    });

    // Handle the change of the courier service dropdown
    $(document).on('change', '#courier', function(e) {
        var courier_service = $(this).val();
        toggleCourierFields(courier_service);
    });

    // Function to handle showing/hiding fields and setting 'required'
    function toggleCourierFields(courier_service) {
        $('div.courier_details').each(function() {
            if (courier_service == $(this).data('service')) {
                // Show the corresponding courier service form
                $(this).removeClass('hide');

                // Add 'required' attribute to all visible input/select fields
                $(this).find('input, select').each(function() {
                    $(this).attr('required', true);
                });
            } else {
                // Hide other courier service forms
                $(this).addClass('hide');

                // Remove 'required' attribute from hidden input/select fields
                $(this).find('input, select').each(function() {
                    $(this).removeAttr('required');
                });
            }
        });
    }

    // Get pathao zones on change the pathao_recipient_city
    $(document).on('change', '#pathao_recipient_city', function(e) {
        // Get the selected city ID
        var cityId = $(this).val();

        // Check if cityId is valid (not null or empty)
        if (cityId) {
            // Make an AJAX call to get the zones based on the city ID
            console.log(cityId)
            $.ajax({
                url: '/pathao_courier/cities/' + cityId + '/zone-list',
                method: 'GET',
                success: function(response) {
                    // Clear the current options in the zone dropdown
                    $('#pathao_recipient_zone').empty();

                    console.log(response)
                    // Add a placeholder option
                    $('#pathao_recipient_zone').append('<option value="">' + recipientZonePlaceholder + '</option>');

                    // Loop through the response to create new options
                    $.each(response, function(key, value) {
                        $('#pathao_recipient_zone').append('<option value="' + key + '">' + value + '</option>');
                    });
                },
                error: function() {
                    alert('Error retrieving zones. Please try again.');
                }
            });
        } else {
            // If no city is selected, reset the zone dropdown
            $('#pathao_recipient_zone').empty().append('<option value="">' + recipientZonePlaceholder + '</option>');
        }
    });

    // Validate the item weight
    $(document).on('blur', '#pathao_item_weight', function() {
        var itemWeight = parseFloat($(this).val()); // Get the value as a float

        // Check if the value is within the valid range
        if ($(this).val() && (isNaN(itemWeight) || itemWeight < 0.5 || itemWeight > 10)) {
            // Show an alert if the value is outside the valid range
            swal({
                title: 'Invalid weight!',
                text: 'The item weight should be between 0.5 and 10 kg.',
                icon: 'warning',
                buttons: true, // Ensure the "OK" button is enabled
            }).then((willClose) => {
                // Clear the input if invalid
                $(this).val('');

                // Delay the focus action slightly so that it happens after the alert is closed
                setTimeout(() => {
                    $(this).focus();
                }, 100); // Delay of 100 milliseconds
            });
        }
    });
</script>
