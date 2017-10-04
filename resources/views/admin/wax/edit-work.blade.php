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
                    {!! Form::open(array('route' => ['wax_work_edit_entry',$entry->id],'class' => 'form-horizontal cmxform')) !!}
                    <div class="form-group">
                        <?php 
                                $entry_date = '';
                                if(Input::old('entry_date')){
                                    $entry_date = Input::old('entry_date');
                                }
                                elseif($entry->entry_date){
                                    $entry_date = Carbon\Carbon::parse($entry->entry_date)->format('d/m/Y');
                                }
                                
                            ?>
                        {!! Form::label('entry_date', __('Entry Date'), array('class' => 'col-lg-3 col-sm-3')) !!}
                        <div class="col-lg-7">
                            {!! Form::text('entry_date', $entry_date, array('class' => 'form-control','data-mask' => '99/99/9999')) !!}
                            @if($errors->first('entry_date'))
                            <label for="entry_date" class="error">{{$errors->first('entry_date')}}</label>
                            @endif
                        </div>                                
                    </div>
                    <div class="form-group">
                        {!! Form::label('ordered_pieces', __('Wax Pieces'), array('class' => 'col-lg-3 col-sm-3')) !!}
                        <div class="col-lg-7">
                            {!! Form::text('ordered_pieces', (Input::old('ordered_pieces')) ? Input::old('ordered_pieces') : $entry->ordered_pieces, array('class' => 'form-control')) !!}
                            @if($errors->first('ordered_pieces'))
                            <label for="ordered_pieces" class="error">{{$errors->first('ordered_pieces')}}</label>
                            @endif
                        </div>                                
                    </div>
                    <div class="form-group">
                        {!! Form::label('used_weight', __('Used Weight'), array('class' => 'col-lg-3 col-sm-3')) !!}
                        <div class="col-lg-7">
                            {!! Form::text('used_weight', (Input::old('used_weight')) ? Input::old('used_weight') : $entry->used_weight, array('class' => 'form-control')) !!}
                            @if($errors->first('used_weight'))
                            <label for="used_weight" class="error">{{$errors->first('used_weight')}}</label>
                            @endif
                        </div>
                    </div> 
                    <div class="form-group">
                        {!! Form::label('unit_price', __('Unit Price'), array('class' => 'col-lg-3 col-sm-3')) !!}
                        <div class="col-lg-7">
                            {!! Form::text('unit_price', (Input::old('unit_price')) ? Input::old('unit_price') : $entry->unit_price, array('class' => 'form-control')) !!}
                            @if($errors->first('unit_price'))
                                <label for="unit_price" class="error">{{$errors->first('unit_price')}}</label>
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
                    <div class="col-lg-3">&nbsp;</div>
                    <div class="col-lg-9">
                    {!! Form::submit('Save',array('class' => 'btn btn-success')) !!}

                    <a href="{{route('wax_work_list',['labour_id' => $entry->wax_labour_id])}}" class="btn btn-primary" alt="Cancel" title="Cancel">Cancel</a>

                    {!! Form::close() !!}

                    {!! Form::open(array('route' => ['wax_work_delete_entry', $entry->id],'onsubmit' => "return confirm('Are you sure to delete?');",'style'=>'display: inline;')) !!}                    
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
<script type="text/javascript" src="/js/bootstrap-inputmask/bootstrap-inputmask.min.js"></script>
<script type="text/javascript">
    var unit_price = "<?php echo $entry->unit_price;?>";
    var given_weight = "<?php echo $entry->given_weight;?>";
    /*$(function(){        
       $('#ordered_pieces').blur(function(){
          var ordered_pieces_val = $(this).val();
          var total_price = unit_price * ordered_pieces_val;
          $("#total_price").val(total_price.toFixed(2));
       });
       $('#used_weight').blur(function(){
          var used_weight = $(this).val();
          var remaining_weight = given_weight - used_weight;
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

    });*/
</script>
@endpush