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
                    {!! Form::open(array('route' => ['labour_new_entry'],'class' => 'form-horizontal cmxform')) !!}
                    
                    <div class="form-group">
                        {!! Form::label('name', __('Name'), array('class' => 'col-lg-3 col-sm-3')) !!}
                        <div class="col-lg-7">
                            {!! Form::text('name', Input::old('name'), array('class' => 'form-control')) !!}
                            @if($errors->first('name'))
                            <label for="name" class="error">{{$errors->first('name')}}</label>
                            @endif
                        </div>
                    </div>                                                                                                                                   
                    
                    <div class="form-group">
                        <div class="col-lg-offset-3 col-lg-7">
                            {!! Form::submit('Save',array('class' => 'btn btn-success')) !!}
                            <a href="{{route('wax_labour_list')}}" class="btn btn-primary" alt="Cancel" title="Cancel">Cancel</a>
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

@endpush