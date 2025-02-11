$(document).ready(function() {
    if ($('#dashboard_date_filter').length == 1) {
        dateRangeSettings.startDate = moment();
        dateRangeSettings.endDate = moment();
        $('#dashboard_date_filter').daterangepicker(dateRangeSettings, function(start, end) {
            $('#dashboard_date_filter span').html(
                start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format)
            );
            update_statistics(start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'));
            if ($('#quotation_table').length && $('#dashboard_location').length) {
                quotation_datatable.ajax.reload();
            }
        });

        update_statistics(moment().format('YYYY-MM-DD'), moment().format('YYYY-MM-DD'));
    }

    $('#dashboard_location').change( function(e) {
        var start = $('#dashboard_date_filter')
                    .data('daterangepicker')
                    .startDate.format('YYYY-MM-DD');

        var end = $('#dashboard_date_filter')
                    .data('daterangepicker')
                    .endDate.format('YYYY-MM-DD');

        update_statistics(start, end);
    });

    //atock alert datatables
    var stock_alert_table = $('#stock_alert_table').DataTable({
        processing: true,
        serverSide: true,
        ordering: false,
        searching: false,
        scrollY:        "75vh",
        scrollX:        true,
        scrollCollapse: true,
        fixedHeader: false,
        dom: 'Btirp',
        ajax: {
            "url": '/home/product-stock-alert',
            "data": function ( d ) {
                if ($('#stock_alert_location').length > 0) {
                    d.location_id = $('#stock_alert_location').val();
                }
            }
        },
        fnDrawCallback: function(oSettings) {
            __currency_convert_recursively($('#stock_alert_table'));
        },
    });

    $('#stock_alert_location').change( function(){
        stock_alert_table.ajax.reload();
    });
    //payment dues datatables
    purchase_payment_dues_table = $('#purchase_payment_dues_table').DataTable({
        processing: true,
        serverSide: true,
        ordering: false,
        searching: false,
        scrollY:        "75vh",
        scrollX:        true,
        scrollCollapse: true,
        fixedHeader: false,
        dom: 'Btirp',
        ajax: {
            "url": '/home/purchase-payment-dues',
            "data": function ( d ) {
                if ($('#purchase_payment_dues_location').length > 0) {
                    d.location_id = $('#purchase_payment_dues_location').val();
                }
            }
        },
        fnDrawCallback: function(oSettings) {
            __currency_convert_recursively($('#purchase_payment_dues_table'));
        },
    });

    $('#purchase_payment_dues_location').change( function(){
        purchase_payment_dues_table.ajax.reload();
    });

    //Sales dues datatables
    sales_payment_dues_table = $('#sales_payment_dues_table').DataTable({
        processing: true,
        serverSide: true,
        ordering: false,
        searching: false,
        scrollY:        "75vh",
        scrollX:        true,
        scrollCollapse: true,
        fixedHeader: false,
        dom: 'Btirp',
        ajax: {
            "url": '/home/sales-payment-dues',
            "data": function ( d ) {
                if ($('#sales_payment_dues_location').length > 0) {
                    d.location_id = $('#sales_payment_dues_location').val();
                }
            }
        },
        fnDrawCallback: function(oSettings) {
            __currency_convert_recursively($('#sales_payment_dues_table'));
        },
    });

    $('#sales_payment_dues_location').change( function(){
        sales_payment_dues_table.ajax.reload();
    });

    //Stock expiry report table
    stock_expiry_alert_table = $('#stock_expiry_alert_table').DataTable({
        processing: true,
        serverSide: true,
        searching: false,
        scrollY:        "75vh",
        scrollX:        true,
        scrollCollapse: true,
        fixedHeader: false,
        dom: 'Btirp',
        ajax: {
            url: '/reports/stock-expiry',
            data: function(d) {
                d.exp_date_filter = $('#stock_expiry_alert_days').val();
            },
        },
        order: [[3, 'asc']],
        columns: [
            { data: 'product', name: 'p.name' },
            { data: 'location', name: 'l.name' },
            { data: 'stock_left', name: 'stock_left' },
            { data: 'exp_date', name: 'exp_date' },
        ],
        fnDrawCallback: function(oSettings) {
            __show_date_diff_for_human($('#stock_expiry_alert_table'));
            __currency_convert_recursively($('#stock_expiry_alert_table'));
        },
    });

    if ($('#quotation_table').length) {
        quotation_datatable = $('#quotation_table').DataTable({
            processing: true,
            serverSide: true,
            aaSorting: [[0, 'desc']],
            "ajax": {
                "url": '/sells/draft-dt?is_quotation=1',
                "data": function ( d ) {
                    if ($('#dashboard_location').length > 0) {
                        d.location_id = $('#dashboard_location').val();
                    }
                }
            },
            columnDefs: [ {
                "targets": 4,
                "orderable": false,
                "searchable": false
            } ],
            columns: [
                { data: 'transaction_date', name: 'transaction_date'  },
                { data: 'invoice_no', name: 'invoice_no'},
                { data: 'name', name: 'contacts.name'},
                { data: 'business_location', name: 'bl.name'},
                { data: 'action', name: 'action'}
            ]            
        });
    }
});

function update_statistics(start, end) {
    var location_id = '';
    if ($('#dashboard_location').length > 0) {
        location_id = $('#dashboard_location').val();
    }
    var data = { start: start, end: end, location_id: location_id };
    //get purchase details
    var loader = '<i class="fas fa-sync fa-spin fa-fw margin-bottom"></i>';
    $('.total_sell').html(loader);
    $('.invoice_due').html(loader);
    $('.total_expense').html(loader);
    $('.total_sell_return').html(loader);
    $('.net').html(loader);

    $('.stock_in_hand').html(loader);
    $('.account_payable').html(loader);
    $('.account_receivable').html(loader);

    $('.t_sell').html(loader);
    // $('.sell_return').html(loader);
    $('.total_purchase').html(loader);
    // $('.total_purchase_return').html(loader);
    $('.t_total_expense').html(loader);
    // $('.t_expense_due').html(loader);
    $('.gross_profit').html(loader);
    // $('.net_profit').html(loader);

    $('.t_account_payable').html(loader);
    // $('.purchase_due').html(loader);
    // $('.expense_due').html(loader);
    // $('.sell_return_due').html(loader);
    $('.t_account_receivable').html(loader);
    // $('.sell_due').html(loader);
    // $('.purchase_return_due').html(loader);
    $('.stock_by_sell').html(loader);
    // $('.stock_by_purchase').html(loader);
    $('.cash_in_hand').html(loader);
    // $('.digital_payment').html(loader);
    // $('.external_payment').html(loader);
    
    $.ajax({
        method: 'get',
        url: '/home/get-totals',
        dataType: 'json',
        data: data,
        success: function(data) {
            console.log(data);
            //purchase details
            $('.total_purchase').html(__currency_trans_from_en(data.total_purchase, true));
            $('.purchase_due').html(__currency_trans_from_en(data.purchase_due, true));

            //sell details
            $('.total_sell').html(__currency_trans_from_en(data.total_sell, true));
            $('.invoice_due').html(__currency_trans_from_en(data.invoice_due, true));
            //expense details
            $('.total_expense').html(__currency_trans_from_en(data.total_expense, true));
            var total_purchase_return = data.total_purchase_return - data.total_purchase_return_paid;
            $('.total_purchase_return').html(__currency_trans_from_en(total_purchase_return, true));
            var total_sell_return_due = data.total_sell_return - data.total_sell_return_paid;
            $('.total_sell_return').html(__currency_trans_from_en(total_sell_return_due, true));
            $('.total_sr').html(__currency_trans_from_en(data.total_sell_return, true));
            $('.total_srp').html(__currency_trans_from_en(data.total_sell_return_paid, true));
            $('.total_pr').html(__currency_trans_from_en(data.total_purchase_return, true));
            $('.total_prp').html(__currency_trans_from_en(data.total_purchase_return_paid, true));
            $('.net').html(__currency_trans_from_en(data.net, true));
            
            // $('.purchase_due').html( 'Purchase due: ' + __currency_trans_from_en(data.cash_in_hand, true));
            $('.t_sell').html($('.t_sell').data('translation') + ': ' + __currency_trans_from_en(data.total_sell, true));
            $('.sell_return').html($('.sell_return').data('translation') + ': ' + __currency_trans_from_en(data.total_sell_return, true));
            
            $('.total_purchase').html($('.total_purchase').data('translation') + ': ' + __currency_trans_from_en(data.total_purchase, true));
            $('.purchase_return').html($('.purchase_return').data('translation') + ': ' + __currency_trans_from_en(data.total_purchase_return, true));
            
            $('.t_total_expense').html($('.t_total_expense').data('translation') + ': ' + __currency_trans_from_en(data.total_expense, true));
            $('.t_expense_due').html($('.t_expense_due').data('translation') + ': ' + __currency_trans_from_en(data.total_expense - data.total_expenses_paid, true));
            
            $('.gross_profit').html($('.gross_profit').data('translation') + ': ' + __currency_trans_from_en(data.profit_loss_details.gross_profit, true));
            $('.net_profit').html($('.net_profit').data('translation') + ': ' + __currency_trans_from_en(data.profit_loss_details.net_profit, true));


            $('.t_account_payable').html($('.t_account_payable').data('translation') + ': ' + __currency_trans_from_en(data.account_payable, true));
            $('.purchase_due').html($('.purchase_due').data('translation') + ': ' + __currency_trans_from_en(data.purchase_due, true));
            $('.expense_due').html($('.expense_due').data('translation') + ': ' + __currency_trans_from_en(data.total_expense - data.total_expenses_paid, true));
            $('.sell_return_due').html($('.sell_return_due').data('translation') + ': ' + __currency_trans_from_en(data.total_sell_return - data.total_sell_return_paid, true));
            
            $('.t_account_receivable').html($('.t_account_receivable').data('translation') + ': ' + __currency_trans_from_en(data.account_receivable, true));
            $('.sell_due').html($('.sell_due').data('translation') + ': ' + __currency_trans_from_en(data.invoice_due, true));
            $('.purchase_return_due').html($('.purchase_return_due').data('translation') + ': ' + __currency_trans_from_en(data.total_purchase_return - data.total_purchase_return_paid, true));
            
            $('.stock_by_sell').html($('.stock_by_sell').data('translation') + ': ' + __currency_trans_from_en(data.stock_by_sell, true));
            $('.stock_by_purchase').html($('.stock_by_purchase').data('translation') + ': ' + __currency_trans_from_en(data.stock_by_purchase, true));
            
            $('.cash_in_hand').html($('.cash_in_hand').data('translation') + ': ' + __currency_trans_from_en(data.cash_in_hand, true));
            $('.digital_payment').html($('.digital_payment').data('translation') + ': ' + '--');
            $('.external_payment').html($('.external_payment').data('translation') + ': ' + '--');


            $('.initial_balance').html(__currency_trans_from_en(data.register_details.cash_in_hand, true));
            $('.cash_received').html(__currency_trans_from_en(data.cash_in_hand - data.register_details.cash_in_hand, true));
            $('.stock_in_hand').html(__currency_trans_from_en(data.stock_in_hand, true));
            $('.account_payable').html(__currency_trans_from_en(data.account_payable, true));
            $('.account_receivable').html(__currency_trans_from_en(data.account_receivable, true));
        },
    });
}
