@php
    $courier_service = isset($courier_settings['courier_service']) ? $courier_settings['courier_service'] : 'steadfast';
    $checked = isset($courier_settings['enable_courier_service']) ? 'checked' : '';
@endphp
<div class="pos-tab-content">
    {{-- @dump($courier_settings) --}}
    <div class="row">
        <div class="col-xs-3">
            <div class="form-group">
                {!! Form::label('courier_service', __('lang_v1.courier_service') . ':') !!}
                {!! Form::select('courier_settings[courier_service]', config('constants.couriers'), $courier_service , ['class' => 'form-control', 'id' => 'courier_service']); !!}
            </div>
        </div>
        <div class="col-xs-3">
            <div class="form-group">
                {{-- {!! Form::label('enable_courier_service', __('lang_v1.enable_courier_service') . ':') !!} --}}
                {!! Form::checkbox('courier_settings[enable_courier_service]', 1, false, ['class' => 'input-icheck', 'id' => 'enable_courier_service', $checked]); !!} <strong>@lang('lang_v1.enable_courier_service')</strong>
            </div>
        </div>
    </div>
    <hr>

    {{-- Steadfast Courier Section --}}
    <div class="row courier_service_settings @if($courier_service != 'steadfast') hide @endif" data-service="steadfast">
        <div class="col-xs-3">
            <div class="form-group">
                {!! Form::label('steadfast_api_key', __('lang_v1.steadfast_api_key') . ':') !!}
                {{-- {!! Form::text('courier_settings[steadfast_api_key]', !empty($courier_settings['steadfast_api_key']) ? $courier_settings['steadfast_api_key'] : null, ['class' => 'form-control','placeholder' => __('lang_v1.steadfast_api_key'), 'id' => 'steadfast_api_key']); !!} --}}
                {!! Form::text('courier_settings[steadfast][api_key]', !empty($courier_settings['steadfast']['api_key']) ? $courier_settings['steadfast']['api_key'] : null, ['class' => 'form-control','placeholder' => __('lang_v1.steadfast_api_key'), 'id' => 'steadfast_api_key']); !!}
            </div>
        </div>

        <div class="col-xs-3">
            <div class="form-group">
                {!! Form::label('steadfast_secret_key', __('lang_v1.steadfast_secret_key') . ':') !!}
                {{-- {!! Form::text('courier_settings[steadfast_secret_key]', !empty($courier_settings['steadfast_secret_key']) ? $courier_settings['steadfast_secret_key'] : null, ['class' => 'form-control','placeholder' => __('lang_v1.steadfast_secret_key'), 'id' => 'steadfast_api_key']); !!} --}}
                {!! Form::text('courier_settings[steadfast][api_secret]', !empty($courier_settings['steadfast']['api_secret']) ? $courier_settings['steadfast']['api_secret'] : null, ['class' => 'form-control','placeholder' => __('lang_v1.steadfast_secret_key'), 'id' => 'steadfast_secret_key']); !!}
            </div>
        </div>
        
        <div class="col-xs-3">
            <div class="form-group">
                {!! Form::label('steadfast_base_url', __('lang_v1.steadfast_base_url') . ':') !!}
                {!! Form::text('courier_settings[steadfast][base_url]', !empty($courier_settings['steadfast']['base_url']) ? $courier_settings['steadfast']['base_url'] : null, ['class' => 'form-control','placeholder' => __('lang_v1.steadfast_base_url'), 'id' => 'steadfast_base_url']); !!}
            </div>
        </div>

        <div class="clearfix"></div>
    </div>
    
    {{-- Pathao Courier Section --}}
    <div class="row courier_service_settings @if($courier_service != 'pathao') hide @endif" data-service="pathao">
        <div class="col-xs-3">
            <div class="form-group">
                {!! Form::label('pathao_client_id', __('lang_v1.pathao_client_id') . ':') !!}
                {!! Form::text('courier_settings[pathao][client_id]', !empty($courier_settings['pathao']['client_id']) ? $courier_settings['pathao']['client_id'] : null, ['class' => 'form-control','placeholder' => __('lang_v1.pathao_client_id'), 'id' => 'pathao_client_id']); !!}
            </div>
        </div>

        <div class="col-xs-3">
            <div class="form-group">
                {!! Form::label('pathao_client_secret', __('lang_v1.pathao_client_secret') . ':') !!}
                {!! Form::text('courier_settings[pathao][client_secret]', !empty($courier_settings['pathao']['client_secret']) ? $courier_settings['pathao']['client_secret'] : null, ['class' => 'form-control','placeholder' => __('lang_v1.pathao_client_secret'), 'id' => 'pathao_client_secret']); !!}
            </div>
        </div>
        
        <div class="col-xs-3">
            <div class="form-group">
                {!! Form::label('pathao_client_email', __('lang_v1.pathao_client_email') . ':') !!}
                {!! Form::text('courier_settings[pathao][client_email]', !empty($courier_settings['pathao']['client_email']) ? $courier_settings['pathao']['client_email'] : null, ['class' => 'form-control','placeholder' => __('lang_v1.pathao_client_email'), 'id' => 'pathao_client_email']); !!}
            </div>
        </div>
        
        <div class="col-xs-3">
            <div class="form-group">
                {!! Form::label('pathao_client_password', __('lang_v1.pathao_client_password') . ':') !!}
                {!! Form::text('courier_settings[pathao][client_password]', !empty($courier_settings['pathao']['client_password']) ? $courier_settings['pathao']['client_password'] : null, ['class' => 'form-control','placeholder' => __('lang_v1.pathao_client_password'), 'id' => 'pathao_client_password']); !!}
            </div>
        </div>
        
        {{-- <div class="col-xs-3">
            <div class="form-group">
                {!! Form::label('pathao_store_id', __('lang_v1.pathao_store_id') . ':') !!}
                {!! Form::text('courier_settings[pathao][store_id]', !empty($courier_settings['pathao']['store_id']) ? $courier_settings['pathao']['store_id'] : null, ['class' => 'form-control','placeholder' => __('lang_v1.pathao_store_id'), 'id' => 'pathao_store_id']); !!}
            </div>
        </div> --}}
        
        <div class="col-xs-3">
            <div class="form-group">
                {!! Form::label('pathao_base_url', __('lang_v1.pathao_base_url') . ':') !!}
                {!! Form::text('courier_settings[pathao][base_url]', !empty($courier_settings['pathao']['base_url']) ? $courier_settings['pathao']['base_url'] : null, ['class' => 'form-control','placeholder' => __('lang_v1.pathao_base_url'), 'id' => 'pathao_base_url']); !!}
            </div>
        </div>

        <div class="clearfix"></div>
    </div>
    
    {{-- eCourier Courier Section --}}
    <div class="row courier_service_settings @if($courier_service != 'e_courier') hide @endif" data-service="e_courier">
        <div class="col-xs-3">
            <div class="form-group">
                {!! Form::label('e_courier_api_key', __('lang_v1.e_courier_api_key') . ':') !!}
                {{-- {!! Form::text('courier_settings[e_courier_api_key]', !empty($courier_settings['e_courier_api_key']) ? $courier_settings['e_courier_api_key'] : null, ['class' => 'form-control','placeholder' => __('lang_v1.e_courier_api_key'), 'id' => 'e_courier_api_key']); !!} --}}
                {!! Form::text('courier_settings[e_courier][api_key]', !empty($courier_settings['e_courier']['api_key']) ? $courier_settings['e_courier']['api_key'] : null, ['class' => 'form-control','placeholder' => __('lang_v1.e_courier_api_key'), 'id' => 'e_courier_api_key']); !!}
            </div>
        </div>
        <div class="col-xs-3">
            <div class="form-group">
                {!! Form::label('e_courier_api_secret', __('lang_v1.e_courier_api_secret') . ':') !!}
                {{-- {!! Form::text('courier_settings[e_courier_api_secret]', !empty($courier_settings['e_courier_api_secret']) ? $courier_settings['e_courier_api_secret'] : null, ['class' => 'form-control','placeholder' => __('lang_v1.e_courier_api_secret'), 'id' => 'e_courier_api_secret']); !!} --}}
                {!! Form::text('courier_settings[e_courier][api_secret]', !empty($courier_settings['e_courier']['api_secret']) ? $courier_settings['e_courier']['api_secret'] : null, ['class' => 'form-control','placeholder' => __('lang_v1.e_courier_api_secret'), 'id' => 'e_courier_api_secret']); !!}
            </div>
        </div>
        <div class="col-xs-3">
            <div class="form-group">
                {!! Form::label('e_courier_user_id', __('lang_v1.e_courier_user_id') . ':') !!}
                {{-- {!! Form::text('courier_settings[e_courier_user_id]', !empty($courier_settings['e_courier_user_id']) ? $courier_settings['e_courier_user_id'] : null, ['class' => 'form-control','placeholder' => __('lang_v1.e_courier_user_id'), 'id' => 'e_courier_user_id']); !!} --}}
                {!! Form::text('courier_settings[e_courier][api_user_id]', !empty($courier_settings['e_courier']['api_user_id']) ? $courier_settings['e_courier']['api_user_id'] : null, ['class' => 'form-control','placeholder' => __('lang_v1.e_courier_user_id'), 'id' => 'e_courier_user_id']); !!}
            </div>
        </div>
        <div class="col-xs-3">
            <div class="form-group">
                {!! Form::label('e_courier_base_url', __('lang_v1.e_courier_base_url') . ':') !!}
                {!! Form::text('courier_settings[e_courier][base_url]', !empty($courier_settings['e_courier']['base_url']) ? $courier_settings['e_courier']['base_url'] : null, ['class' => 'form-control','placeholder' => __('lang_v1.e_courier_base_url'), 'id' => 'e_courier_base_url']); !!}
            </div>
        </div>
    </div>
</div>