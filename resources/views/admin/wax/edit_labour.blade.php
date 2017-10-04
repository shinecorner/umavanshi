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
                    {!! Form::open(array('route' => ['labour_edit_entry', $entry->id],'class' => 'form-horizontal cmxform')) !!}

                    <div class="form-group">
                        {!! Form::label('name', __('Name'), array('class' => 'col-lg-3 col-sm-3')) !!}
                        <div class="col-lg-7">
                            {!! Form::text('name', (Input::old('name')) ? Input::old('name') : $entry->name, array('class' => 'form-control')) !!}
                            @if($errors->first('name'))
                            <label for="name" class="error">{{$errors->first('name')}}</label>
                            @endif
                        </div>                                
                    </div>


                    <div class="col-lg-3">&nbsp;</div>
                    <div class="col-lg-9">
                    {!! Form::submit('Save',array('class' => 'btn btn-success')) !!}


                    <a href="{{route('wax_labour_list')}}" class="btn btn-primary" alt="Cancel" title="Cancel">Cancel</a>

                    {!! Form::close() !!}

                    {!! Form::open(array('route' => ['labour_delete_entry', $entry->id],'onsubmit' => "return confirm('Are you sure to delete?');",'style'=>'display: inline;')) !!}
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