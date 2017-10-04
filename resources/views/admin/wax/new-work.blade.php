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
                    {!! Form::open(array('route' => ['wax_work_create_entry',$labour_id],'class' => 'form-horizontal cmxform')) !!}
                    <div class="form-group">
                        {!! Form::label('entry_date', __('Entry Date'), array('class' => 'col-lg-3 col-sm-3')) !!}
                        <div class="col-lg-7">
                            {!! Form::text('entry_date', Input::old('entry_date'), array('class' => 'form-control','data-mask' => '99/99/9999')) !!}                                    
                            @if($errors->first('entry_date'))
                            <label for="entry_date" class="error">{{$errors->first('entry_date')}}</label>
                            @endif
                        </div>                                
                    </div>
                    <div class="form-group">
                        {!! Form::label('ordered_pieces', __('Wax Pieces'), array('class' => 'col-lg-3 col-sm-3')) !!}
                        <div class="col-lg-7">
                            {!! Form::text('ordered_pieces', Input::old('ordered_pieces'), array('class' => 'form-control')) !!}
                            @if($errors->first('ordered_pieces'))
                            <label for="ordered_pieces" class="error">{{$errors->first('ordered_pieces')}}</label>
                            @endif
                        </div>                                
                    </div>
                    <div class="form-group">
                        {!! Form::label('used_weight', __('Used Weight'), array('class' => 'col-lg-3 col-sm-3')) !!}
                        <div class="col-lg-7">
                            {!! Form::text('used_weight', Input::old('used_weight'), array('class' => 'form-control')) !!}
                            @if($errors->first('used_weight'))
                            <label for="used_weight" class="error">{{$errors->first('used_weight')}}</label>
                            @endif
                        </div>
                    </div>                    
                    <div class="form-group">
                        {!! Form::label('unit_price', __('Unit Price'), array('class' => 'col-lg-3 col-sm-3')) !!}
                        <div class="col-lg-7">
                            {!! Form::text('unit_price', Input::old('unit_price'), array('class' => 'form-control')) !!}
                            @if($errors->first('unit_price'))
                                <label for="unit_price" class="error">{{$errors->first('unit_price')}}</label>
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
                            <a href="{{route('wax_work_list',['labour_id' => $labour_id])}}" class="btn btn-primary" alt="Cancel" title="Cancel">Cancel</a>
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