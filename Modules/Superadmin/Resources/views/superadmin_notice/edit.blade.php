@extends('layouts.app')
@section('title', __('superadmin::lang.superadmin') . ' | ' . __('superadmin::lang.packages'))

@section('content')
	@include('superadmin::layouts.nav')
	<section class="content-header">
		<h1>
			@lang('superadmin::lang.welcome_superadmin')
		</h1>
	</section>

	<section class="content">

    <div class="box box-primary">
      <div class="box-header">Create Notice Message</div>

      <div class="box-body">

        {!! Form::open(['url' => action('\Modules\Superadmin\Http\Controllers\SuperadminNoticeController@update'), 'method' => 'post']) !!}

        <div class="row">
				
          <div class="col-sm-12">
            <div class="form-group">
              {!! Form::label('notice_message', __('Notice Message').':') !!}
              {!! Form::text('notice_message', $notice_message->notice_message, ['class' => 'form-control']); !!}
            </div>
          </div>
        </div>


        <div class="row">
          <div class="col-sm-12">
            <button type="submit" class="btn btn-primary ">@lang('messages.save')</button>
          </div>
        </div>


        {!! Form::close() !!}

      </div>
    </div>

    
  </section>

  @endsection