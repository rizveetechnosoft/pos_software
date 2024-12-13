<div class="modal-dialog no-print modal-xl" role="document">
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
                <div class="col-md-12 courier_tracking" style="height: 80vh">
                    <iframe src="" id="embeddedContent" width="100%" height="100%" frameborder="0"></iframe>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default no-print" data-dismiss="modal">@lang('messages.close')</button>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        @if ($courier_info['service_provider'] == 'pathao')
            // Hide modal and open tracking URL in a new tab
            $('.modal').modal('hide');
            window.open("{{ $courier_info['response']['tracking_url'] }}", "_blank");
        @else
            // Get the tracking URL from the courier info
            var url = "{{ $courier_info['response']['tracking_url'] }}";

            // Embed the tracking view with the iframe
            $('#embeddedContent').attr('src', url);
        @endif
    });
</script>
