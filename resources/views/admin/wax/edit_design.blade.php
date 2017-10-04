@extends('admin.layouts.master')

@push('stylesheets')
@endpush

@section('content')
@parent
<div class="page-heading">
    <h3>
        {{__('Edit Entry')}}
    </h3>    
</div>
<div class="wrapper">
    <div class="row">
        <div class="col-lg-6">
            <section class="panel">                    
                <div class="panel-body">
                    {!! Form::open(array('route' => ['wax_design_edit_entry', $entry->id],'class' => 'form-horizontal cmxform')) !!}

                    <div class="form-group">
                        {!! Form::label('name', __('Name'), array('class' => 'col-lg-3 col-sm-3')) !!}
                        <div class="col-lg-7">
                            {!! Form::text('name', (Input::old('name')) ? Input::old('name') : $entry->name, array('class' => 'form-control')) !!}
                            @if($errors->first('name'))
                            <label for="name" class="error">{{$errors->first('name')}}</label>
                            @endif
                        </div>                                
                    </div>
                    <div class="form-group">
                        {!! Form::label('pieces', __('Pieces'), array('class' => 'col-lg-3 col-sm-3')) !!}
                        <div class="col-lg-7">
                            {!! Form::text('pieces', (Input::old('pieces')) ? Input::old('pieces') : $entry->pieces, array('class' => 'form-control')) !!}
                            @if($errors->first('pieces'))
                            <label for="pieces" class="error">{{$errors->first('pieces')}}</label>
                            @endif
                        </div>                                
                    </div>
                    <div class="form-group">
                        {!! Form::label('weight', __('Weight'), array('class' => 'col-lg-3 col-sm-3')) !!}
                        <div class="col-lg-7">
                            {!! Form::text('weight', (Input::old('weight')) ? Input::old('weight') : $entry->weight, array('class' => 'form-control')) !!}
                            @if($errors->first('weight'))
                            <label for="weight" class="error">{{$errors->first('weight')}}</label>
                            @endif
                        </div>                                
                    </div>
                    <div class="col-lg-3">&nbsp;</div>
                    <div class="col-lg-9">
                    {!! Form::submit('Save',array('class' => 'btn btn-success')) !!}
                    <a href="{{route('wax-design-list')}}" class="btn btn-primary" alt="Cancel" title="Cancel">Cancel</a>

                    {!! Form::close() !!}

                    {!! Form::open(array('route' => ['wax_design_delete_entry', $entry->id],'onsubmit' => "return confirm('Are you sure to delete?');",'style'=>'display: inline;')) !!}
                    {!! Form::hidden('_method', 'DELETE') !!}
                    {!! Form::submit(__('Delete'), array('class' => 'btn btn-danger')) !!}
                    {!! Form::close() !!}
                    </div>

                    

                </div>
            </section>
        </div>        
    </div>
</div>
@endsection

@push('scripts')

@endpush