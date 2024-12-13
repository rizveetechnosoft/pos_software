<div class="row">
  <div class="col-sm-12">
    {{-- @dump($register_details) --}}
    
    <table class="table table-condensed">
      <tr>
        <th>@lang('lang_v1.payment_method')</th>
        <th>@lang('sale.sale')</th>
        <th>@lang('cash_register.expense_and_purchase')</th>
      </tr>
      <tr>
        <td>
          @lang('cash_register.opening_balance'):
        </td>
        <td>
          <span class="display_currency" data-currency_symbol="true">{{ $register_details->cash_in_hand }}</span>
        </td>
        <td>--</td>
      </tr>
      <tr>
        <td>
          @lang('cash_register.cash_payment'):
        </th>
        <td>
          <span class="display_currency" data-currency_symbol="true">{{ $register_details->total_cash }}</span>
        </td>
        <td>
          <span class="display_currency" data-currency_symbol="true">{{ $register_details->total_cash_expense }}</span>
          {{-- <span class="display_currency" data-currency_symbol="true">{{ $register_details->total_cash_expense + $register_details->total_cash_sell_return }}</span> --}}
        </td>
      </tr>
      <tr>
        <td>
          @lang('cash_register.checque_payment'):
        </td>
        <td>
          <span class="display_currency" data-currency_symbol="true">{{ $register_details->total_cheque }}</span>
        </td>
        <td>
          <span class="display_currency" data-currency_symbol="true">{{ $register_details->total_cheque_expense }}</span>
        </td>
      </tr>
      <tr>
        <td>
          @lang('cash_register.card_payment'):
        </td>
        <td>
          <span class="display_currency" data-currency_symbol="true">{{ $register_details->total_card }}</span>
        </td>
        <td>
          <span class="display_currency" data-currency_symbol="true">{{ $register_details->total_card_expense }}</span>
        </td>
      </tr>
      <tr>
        <td>
          @lang('cash_register.bank_transfer'):
        </td>
        <td>
          <span class="display_currency" data-currency_symbol="true">{{ $register_details->total_bank_transfer }}</span>
        </td>
        <td>
          <span class="display_currency" data-currency_symbol="true">{{ $register_details->total_bank_transfer_expense }}</span>
        </td>
      </tr>
      <tr>
        <td>
          @lang('lang_v1.advance_payment'):
        </td>
        <td>
          <span class="display_currency" data-currency_symbol="true">{{ $register_details->total_advance }}</span>
        </td>
        <td>
          <span class="display_currency" data-currency_symbol="true">{{ $register_details->total_advance_expense }}</span>
        </td>
      </tr>
      @if(array_key_exists('custom_pay_1', $payment_types))
        <tr>
          <td>
            {{$payment_types['custom_pay_1']}}:
          </td>
          <td>
            <span class="display_currency" data-currency_symbol="true">{{ $register_details->total_custom_pay_1 }}</span>
          </td>
          <td>
            <span class="display_currency" data-currency_symbol="true">{{ $register_details->total_custom_pay_1_expense }}</span>
          </td>
        </tr>
      @endif
      @if(array_key_exists('custom_pay_2', $payment_types))
        <tr>
          <td>
            {{$payment_types['custom_pay_2']}}:
          </td>
          <td>
            <span class="display_currency" data-currency_symbol="true">{{ $register_details->total_custom_pay_2 }}</span>
          </td>
          <td>
            <span class="display_currency" data-currency_symbol="true">{{ $register_details->total_custom_pay_2_expense }}</span>
          </td>
        </tr>
      @endif
      @if(array_key_exists('custom_pay_3', $payment_types))
        <tr>
          <td>
            {{$payment_types['custom_pay_3']}}:
          </td>
          <td>
            <span class="display_currency" data-currency_symbol="true">{{ $register_details->total_custom_pay_3 }}</span>
          </td>
          <td>
            <span class="display_currency" data-currency_symbol="true">{{ $register_details->total_custom_pay_3_expense }}</span>
          </td>
        </tr>
      @endif
      @if(array_key_exists('custom_pay_4', $payment_types))
        <tr>
          <td>
            {{$payment_types['custom_pay_4']}}:
          </td>
          <td>
            <span class="display_currency" data-currency_symbol="true">{{ $register_details->total_custom_pay_4 }}</span>
          </td>
          <td>
            <span class="display_currency" data-currency_symbol="true">{{ $register_details->total_custom_pay_4_expense }}</span>
          </td>
        </tr>
      @endif
      @if(array_key_exists('custom_pay_5', $payment_types))
        <tr>
          <td>
            {{$payment_types['custom_pay_5']}}:
          </td>
          <td>
            <span class="display_currency" data-currency_symbol="true">{{ $register_details->total_custom_pay_5 }}</span>
          </td>
          <td>
            <span class="display_currency" data-currency_symbol="true">{{ $register_details->total_custom_pay_5_expense }}</span>
          </td>
        </tr>
      @endif
      @if(array_key_exists('custom_pay_6', $payment_types))
        <tr>
          <td>
            {{$payment_types['custom_pay_6']}}:
          </td>
          <td>
            <span class="display_currency" data-currency_symbol="true">{{ $register_details->total_custom_pay_6 }}</span>
          </td>
          <td>
            <span class="display_currency" data-currency_symbol="true">{{ $register_details->total_custom_pay_6_expense }}</span>
          </td>
        </tr>
      @endif
      @if(array_key_exists('custom_pay_7', $payment_types))
        <tr>
          <td>
            {{$payment_types['custom_pay_7']}}:
          </td>
          <td>
            <span class="display_currency" data-currency_symbol="true">{{ $register_details->total_custom_pay_7 }}</span>
          </td>
          <td>
            <span class="display_currency" data-currency_symbol="true">{{ $register_details->total_custom_pay_7_expense }}</span>
          </td>
        </tr>
      @endif
      <tr>
        <td>
          @lang('cash_register.other_payments'):
        </td>
        <td>
          <span class="display_currency" data-currency_symbol="true">{{ $register_details->total_other }}</span>
        </td>
        <td>
          <span class="display_currency" data-currency_symbol="true">{{ $register_details->total_other_expense }}</span>
        </td>
      </tr>
    </table>

    <hr>
    
    {{-- <table class="table table-condensed">
        <tr>
          <td>
            @lang('cash_register.total_received_amount'):
          </td>
          <td>
            <span class="display_currency" data-currency_symbol="true">{{ $register_details->total_sale }}</span>
          </td>
        </tr>
        <tr class="danger">
          <th>
            @lang('cash_register.total_refund'):
          </th>
          <td>
            <b><span class="display_currency" data-currency_symbol="true">{{ $register_details->total_refund }}</span></b><br>
            <small>
            @if($register_details->total_cash_refund != 0)
              Cash: <span class="display_currency" data-currency_symbol="true">{{ $register_details->total_cash_refund }}</span><br>
            @endif
            @if($register_details->total_cheque_refund != 0) 
              Cheque: <span class="display_currency" data-currency_symbol="true">{{ $register_details->total_cheque_refund }}</span><br>
            @endif
            @if($register_details->total_card_refund != 0) 
              Card: <span class="display_currency" data-currency_symbol="true">{{ $register_details->total_card_refund }}</span><br> 
            @endif
            @if($register_details->total_bank_transfer_refund != 0)
              Bank Transfer: <span class="display_currency" data-currency_symbol="true">{{ $register_details->total_bank_transfer_refund }}</span><br>
            @endif
            @if(array_key_exists('custom_pay_1', $payment_types) && $register_details->total_custom_pay_1_refund != 0)
                {{$payment_types['custom_pay_1']}}: <span class="display_currency" data-currency_symbol="true">{{ $register_details->total_custom_pay_1_refund }}</span>
            @endif
            @if(array_key_exists('custom_pay_2', $payment_types) && $register_details->total_custom_pay_2_refund != 0)
                {{$payment_types['custom_pay_2']}}: <span class="display_currency" data-currency_symbol="true">{{ $register_details->total_custom_pay_2_refund }}</span>
            @endif
            @if(array_key_exists('custom_pay_3', $payment_types) && $register_details->total_custom_pay_3_refund != 0)
                {{$payment_types['custom_pay_3']}}: <span class="display_currency" data-currency_symbol="true">{{ $register_details->total_custom_pay_3_refund }}</span>
            @endif
            @if($register_details->total_other_refund != 0)
              Other: <span class="display_currency" data-currency_symbol="true">{{ $register_details->total_other_refund }}</span>
            @endif
            </small>
          </td>
        </tr>
        <tr class="success">
          <th>
            @lang('lang_v1.total_cash'):
          </th>
          <td>
            <b><span class="display_currency" data-currency_symbol="true">{{ $register_details->cash_in_hand + $register_details->total_cash - $register_details->total_cash_refund }}</span></b>
          </td>
        </tr>
        <tr class="success">
          <th>
            @lang('lang_v1.credit_sales'):
          </th>
          <td>
            <b><span class="display_currency" data-currency_symbol="true">{{ $current_register_due }}</span></b>
          </td>
        </tr>
        <tr class="success">
          <th>
            @lang('lang_v1.previous_due_received'):
          </th>
          <td>
            <b><span class="display_currency" data-currency_symbol="true">{{ $register_details->previous_due_received }}</span></b>
          </td>
        </tr>
        <tr class="success">
          <th>
            @lang('cash_register.total_sales'):
          </th>
          <td>
            <b><span class="display_currency" data-currency_symbol="true">{{ $details['transaction_details']->total_sales }}</span></b>
          </td>
        </tr>
        <tr class="danger">
          <th>
            @lang('report.total_expense_and_purchase'):
          </th>
          <td>
            <b><span class="display_currency" data-currency_symbol="true">{{ $register_details->total_expense }}</span></b>
          </td>
        </tr>
        <tr class="danger">
          <th>
            @lang('report.due_expense'):
          </th>
          <td>
            <b><span class="display_currency" data-currency_symbol="true">{{ $register_details->gross_total_expense - $register_details->total_expense }}</span></b>
          </td>
        </tr>
    </table> --}}

    <div class="row">
      <div class="col-sm-6">
        <table class="table table-condensed custom-border-black">
          <tr>
            <th>
              @lang('cash_register.total_sales'):
            </th>
            <td>
              <b><span class="display_currency" data-currency_symbol="true">{{ $details['transaction_details']->total_sales }}</span></b>
            </td>
          </tr>
          <tr>
            <th>
              @lang('lang_v1.credit_sales'):
            </th>
            <td>
              <b><span class="display_currency" data-currency_symbol="true">{{ $current_register_due }}</span></b>
            </td>
          </tr>
          <tr class="danger">
            <th>
              @lang('cash_register.total_sell_return'):
            </th>
            <td>
              <b><span class="display_currency" data-currency_symbol="true">{{ $register_details->total_sell_return }}</span></b>
            </td>
          </tr>
          <tr class="success">
            <th>
              @lang('cash_register.total_due_received'):
            </th>
            <td>
              <b><span class="display_currency" data-currency_symbol="true">{{ $register_details->previous_due_received }}</span></b>
            </td>
          </tr>
        </table>
      </div>

      <div class="col-sm-6">
        <table class="table table-condensed custom-border-black">
          {{-- <tr class="danger">
            <th>
              @lang('cash_register.total_expense_and_purchase'):
            </th>
            <td>
              <b><span class="display_currency" data-currency_symbol="true">{{ $register_details->gross_total_expense }}</span></b>
            </td>
          </tr> --}}
          <tr class="danger">
            <th>
              @lang('cash_register.paid_expense_and_purchase'):
            </th>
            <td>
              <b><span class="display_currency" data-currency_symbol="true">{{ $register_details->total_expense }}</span></b>
            </td>
          </tr>
          {{-- <tr class="danger">
            <th>
              @lang('cash_register.cash_paid_expense_and_purchase'):
            </th>
            <td>
              <b><span class="display_currency" data-currency_symbol="true">{{ $register_details->total_cash_expense }}</span></b>
            </td>
          </tr> --}}
          <tr class="success">
            <th>
              @lang('cash_register.total_purchase_return'):
            </th>
            <td>
              <b><span class="display_currency" data-currency_symbol="true">{{ $register_details->total_purchase_return }}</span></b>
            </td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</div>

<hr>

<div class="row">
  <div class="col-sm-4">
    <div class="form-group">
      {!! Form::label('closing_amount', __( 'cash_register.cash_in_hand' ) . ':*') !!}
        {!! Form::text('closing_amount', @num_format($register_details->cash_in_hand + $register_details->total_cash - $register_details->total_cash_refund - $register_details->total_cash_expense - $register_details->total_cash_sell_return), ['class' => 'form-control input_number', 'required', 'placeholder' => __( 'cash_register.total_cash' ) ]); !!}
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group">
      {!! Form::label('total_card_slips', __( 'cash_register.total_card_slips' ) . ':*') !!} @show_tooltip(__('tooltip.total_card_slips'))
        {!! Form::number('total_card_slips', $register_details->total_card_slips, ['class' => 'form-control', 'required', 'placeholder' => __( 'cash_register.total_card_slips' ), 'min' => 0 ]); !!}
    </div>
  </div> 
  <div class="col-sm-4">
    <div class="form-group">
      {!! Form::label('total_cheques', __( 'cash_register.total_cheques' ) . ':*') !!} @show_tooltip(__('tooltip.total_cheques'))
        {!! Form::number('total_cheques', $register_details->total_cheques, ['class' => 'form-control', 'required', 'placeholder' => __( 'cash_register.total_cheques' ), 'min' => 0 ]); !!}
    </div>
  </div> 
</div>

@include('cash_register.register_product_details')

<style>
  .custom-border-black, .custom-border-black th, .custom-border-black td {
    border: 1px solid black !important;
}
</style>