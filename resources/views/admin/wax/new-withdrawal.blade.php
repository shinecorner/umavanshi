@extends('admin.layouts.master')

@push('stylesheets')
@endpush

@section('content')
@parent
<div class="page-heading">
    <h3>
        {{__('New Entry')}}
    </h3>    
</div>
<div class="wrapper">
    <div class="row">
        <div class="col-lg-6">
            <section class="panel">                    
                <div class="panel-body">
                    {!! Form::open(array('route' => ['wax_withdrawal_new_entry',$labour_id],'class' => 'form-horizontal cmxform')) !!}
                    <div class="form-group">
                        {!! Form::label('current_amount', __('Current Amount'), array('class' => 'col-lg-3 col-sm-3')) !!}
                        <div class="col-lg-7">
                            {{$current_amount}}
                        </div>                                
                    </div>
                    <div class="form-group">
                        {!! Form::label('withdrawal_amount', __('Withdrawal Amount'), array('class' => 'col-lg-3 col-sm-3')) !!}
                        <div class="col-lg-7">
                            {!! Form::text('withdrawal_amount', Input::old('withdrawal_amount'), array('class' => 'form-control')) !!}
                            @if($errors->first('withdrawal_amount'))
                            <label for="withdrawal_amount" class="error">{{$errors->first('withdrawal_amount')}}</label>
                            @endif
                        </div>                                
                    </div>
                    <div class="form-group">
                        {!! Form::label('settled_amount', __('Settled Amount'), array('class' => 'col-lg-3 col-sm-3')) !!}
                        <div class="col-lg-7">
                            {!! Form::text('settled_amount', Input::old('settled_amount'), array('class' => 'form-control')) !!}
                            @if($errors->first('settled_amount'))
                            <label for="settled_amount" class="error">{{$errors->first('settled_amount')}}</label>
                            @endif
                        </div>
                    </div>                                                          
                    <div class="form-group">
                        {!! Form::label('detail', __('Detail'), array('class' => 'col-lg-3 col-sm-3')) !!}
                        <div class="col-lg-7">
                            {!! Form::text('detail', Input::old('detail'), array('class' => 'form-control')) !!}
                            @if($errors->first('detail'))
                                <label for="detail" class="error">{{$errors->first('detail')}}</label>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-offset-3 col-lg-7">
                            {!! Form::submit('Save',array('class' => 'btn btn-success')) !!}
                            <a href="{{route('wax_withdrawal_list',['labour_id' => $labour_id])}}" class="btn btn-primary" alt="Cancel" title="Cancel">Cancel</a>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </section>
        </div>        
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript" src="/js/bootstrap-inputmask/bootstrap-inputmask.min.js"></script>
@endpush