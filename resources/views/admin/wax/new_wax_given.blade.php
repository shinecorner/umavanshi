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
                    {!! Form::open(array('route' => ['wax_given_new_entry',$labour_id],'class' => 'form-horizontal cmxform')) !!}
                    
                    <div class="form-group">
                        {!! Form::label('given_date', __('Given Date'), array('class' => 'col-lg-3 col-sm-3')) !!}
                        <div class="col-lg-7">
                            {!! Form::text('given_date', Input::old('given_date'), array('class' => 'form-control','data-mask' => '99/99/9999')) !!}                                    
                            @if($errors->first('given_date'))
                            <label for="given_date" class="error">{{$errors->first('given_date')}}</label>
                            @endif
                        </div>                                
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label('weight', __('Given Weight'), array('class' => 'col-lg-3 col-sm-3')) !!}
                        <div class="col-lg-7">
                            {!! Form::text('weight', Input::old('weight'), array('class' => 'form-control')) !!}
                            @if($errors->first('weight'))
                            <label for="weight" class="error">{{$errors->first('weight')}}</label>
                            @endif
                        </div>
                    </div>                                                         
                    
                    <div class="form-group">
                        <div class="col-lg-offset-3 col-lg-7">
                            {!! Form::submit('Save',array('class' => 'btn btn-success')) !!}
                            <a href="{{route('wax_given_weight_list',['labour_id' => $labour_id])}}" class="btn btn-primary" alt="Cancel" title="Cancel">Cancel</a>
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