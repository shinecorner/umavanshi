@extends('admin.layouts.master')

@push('stylesheets')
@endpush

@section('content')
@parent
<div class="page-heading">
    <h3>
        {{__('Complete Entry')}}
    </h3>    
</div>
<div class="wrapper">    
    <div class="row">
        <div class="col-lg-6">
            <section class="panel">                    
                <div class="panel-body">
                    {!! Form::open(array('route' => ['wax_work_complete_entry',$entry->id],'id' => 'complete_wax_work','class' => 'form-horizontal cmxform')) !!}
                    <div class="form-group">
                        {!! Form::label('return_date', __('Return Date'), array('class' => 'col-lg-3 col-sm-3')) !!}
                        <div class="col-lg-7">
                            {!! Form::text('return_date', Input::old('return_date'), array('class' => 'form-control','data-mask' => '99/99/9999')) !!}
                            @if($errors->first('return_date'))
                            <label for="return_date" class="error">{{$errors->first('return_date')}}</label>
                            @endif
                        </div>                                
                    </div>
                    <div class="form-group">
                        {!! Form::label('return_pieces', __('Return Pieces'), array('class' => 'col-lg-3 col-sm-3')) !!}
                        <div class="col-lg-7">
                            {!! Form::text('return_pieces', Input::old('return_pieces'), array('class' => 'form-control')) !!}
                            @if($errors->first('return_pieces'))
                            <label for="return_pieces" class="error">{{$errors->first('return_pieces')}}</label>
                            @endif
                        </div>                                
                    </div>
                    <div class="form-group">
                        {!! Form::label('return_weight', __('Return Weight'), array('class' => 'col-lg-3 col-sm-3')) !!}
                        <div class="col-lg-7">
                            {!! Form::text('return_weight', Input::old('return_weight'), array('class' => 'form-control')) !!}
                            @if($errors->first('return_weight'))
                            <label for="return_weight" class="error">{{$errors->first('return_weight')}}</label>
                            @endif
                        </div>
                    </div>                                        
                    <div class="form-group">
                        {!! Form::label('remaining_weight', __('Remaining Weight'), array('class' => 'col-lg-3 col-sm-3')) !!}
                        <div class="col-lg-7">
                            {!! Form::text('remaining_weight', Input::old('remaining_weight'), array('class' => 'form-control disabled','readonly'=>true)) !!}
                            <a id="change_remaining_weight" href="javascript:" alt="{{__('Change')}}" title="{{__('Change')}}">{{__('Change')}}</a>
                            @if($errors->first('remaining_weight'))
                            <label for="remaining_weight" class="error">{{$errors->first('remaining_weight')}}</label>
                            @endif
                        </div>
                    </div> 
                    <div class="form-group">
                        {!! Form::label('remaining_weight_status', __('Remaining Weight Status'), array('class' => 'col-lg-3 col-sm-3')) !!}
                        <div class="col-lg-7">
                            {!! Form::select('remaining_weight_status', ['Returned To Labour' => __('Returned To Labour'), 'Deposited Back' => __('Deposited Back')], Input::old('remaining_weight_status'), array('class' => 'form-control')) !!}
                            @if($errors->first('remaining_weight_status'))
                            <label for="remaining_weight_status" class="error">{{$errors->first('remaining_weight_status')}}</label>
                            @endif
                        </div>
                    </div> 
                    <div class="form-group">
                        {!! Form::label('total_price', __('Total Price'), array('class' => 'col-lg-3 col-sm-3')) !!}
                        <div class="col-lg-7">
                            {!! Form::text('total_price', Input::old('total_price'), array('class' => 'form-control disabled','readonly' => true)) !!}
                            <a id="change_total_price" href="javascript:" alt="{{__('Change')}}" title="{{__('Change')}}">{{__('Change')}}</a>
                            @if($errors->first('total_price'))
                            <label for="total_price" class="error">{{$errors->first('total_price')}}</label>
                            @endif
                        </div>
                    </div>                    
                    <div class="form-group">
                        {!! Form::label('detail', __('Detail'), array('class' => 'col-lg-3 col-sm-3')) !!}
                        <div class="col-lg-7">
                            <?php $detail = (Input::old('detail')) ? Input::old('detail') : $entry->detail ?>
                            {!! Form::text('detail', $detail, array('class' => 'form-control')) !!}
                            @if($errors->first('detail'))
                            <label for="detail" class="error">{{$errors->first('detail')}}</label>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-offset-3 col-lg-7">
                            {!! Form::submit('Save',array('class' => 'btn btn-success')) !!}
                            <a href="{{route('wax_work_list',['labour_id' => $entry->wax_labour_id])}}" class="btn btn-primary" alt="Cancel" title="Cancel">Cancel</a>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </section>
        </div>
        <div class="col-sm-6">
                <section class="panel">
                    <header class="panel-heading no-border">
                        {{__('Given Work Detail')}}
                    </header>
                    <div class="panel-body">
                        <table class="table table-bordered" width="50%">
                            <tbody>
                            <tr>
                                <td width="30%"><strong>{{__('Given Date')}}</strong></td>
                                <td width="70%">{{Carbon\Carbon::parse($entry->given_date)->format('d/m/Y')}}</td>
                            </tr>                            
                            <tr>
                                <td width="30%"><strong>{{__('Given Pieces')}}</strong></td>
                                <td width="70%">{{$entry->given_pieces}}</td>
                            </tr>
                            <tr>
                                <td width="30%"><strong>{{__('Given Weight')}}</strong></td>
                                <td width="70%">{{$entry->given_weight}}</td>
                            </tr>
                            <tr>
                                <td width="30%"><strong>{{__('Unit Price')}}</strong></td>
                                <td width="70%">{{$entry->unit_price}}</td>
                            </tr>
                            <tr>
                                <td width="30%"><strong>{{__('Detail')}}</strong></td>
                                <td width="70%">{{$entry->detail}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript" src="/js/bootstrap-inputmask/bootstrap-inputmask.min.js"></script>
<script type="text/javascript">
    var unit_price = "<?php echo $entry->unit_price;?>";
    var given_weight = "<?php echo $entry->given_weight;?>";
    $(function(){        
       $('#return_pieces').blur(function(){
          var return_pieces_val = $(this).val();
          var total_price = unit_price * return_pieces_val;
          $("#total_price").val(total_price.toFixed(2));
       });
       $('#return_weight').blur(function(){
          var return_weight = $(this).val();
          var remaining_weight = given_weight - return_weight;
          $("#remaining_weight").val(remaining_weight.toFixed(2));
       });
       $('#change_total_price').click(function(){
           $("#total_price").removeClass('disabled');
           $("#total_price").attr('readonly', false);
       });       
       $('#change_remaining_weight').click(function(){
           $("#remaining_weight").removeClass('disabled');
           $("#remaining_weight").attr('readonly', false);
       });
       
    });
</script>
@endpush