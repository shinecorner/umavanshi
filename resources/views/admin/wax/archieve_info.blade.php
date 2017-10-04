@extends('admin.layouts.master')

@push('stylesheets')
@endpush

@section('content')
@parent
<div class="page-heading">
    <h3>
        {{__('Archieve Detail')}}
    </h3>    
</div>
<div class="wrapper">    
    {!! Form::open(array('route' => ['wax_do_archieve',$archieve_info['wax_labour_id']],'class' => 'cmxform')) !!}
    <div class="panel">
        <div class="invoice">

            <div class="invoice-address">
                <div class="row">
                    <div class="col-md-5 col-sm-5">
                        <h4 class="inv-to">To</h4>
                        <h2 class="corporate-id">{{$archieve_info['labour_name']}}</h2>
                    </div>
                    <div class="col-md-4 col-md-offset-3 col-sm-4 col-sm-offset-3">                        
                        <div class="inv-col"><span>{{__('Invoice Date')}}: </span> {{date('d/m/Y')}}</div>
                    </div>
                </div>
            </div>
        </div>        
        <?php $i = 1;?>
        <table class="table table-bordered table-invoice">            
            <thead>
                <tr>
                    <th width="15%">{{__('Sr No')}}</th>
                    <th width="25%">{{__('Detail')}}</th>         
                    <th width="15%" class="text-center">{{__('Entry Date')}}</th>         
                    <th width="15%" class="text-center">{{__('Ordered Pieces')}}</th>
                    <th width="15%" class="text-center">{{__('Unit Price')}}</th>
                    <th width="15%" class="text-center">{{__('Total Price')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($archieve_info['entries'] as $key=>$entry)
                <tr>
                    <td>{{$i}}</td>
                    <td>
                        <h4>{{$entry['detail']}}</h4>                        
                    </td>
                    <td class="text-center"><strong>{{$entry['entry_date']}}</strong></td>
                    <td class="text-center"><strong>{{$entry['ordered_pieces']}}</strong></td>
                    <td class="text-center"><strong>{{$entry['unit_price']}}</strong></td>
                    <td class="text-center"><strong>{{$entry['entry_total_prices']}}</strong></td>
                </tr>
                <?php $i++;?>
                @endforeach
                <tr>
                    <td class="text-right" colspan="4">
                        {{__('Include withdrawal in invoice')}}                                                
                        <input id="chk_include_withdrawal" name="chk_include_withdrawal" value="1" checked="1" type="checkbox" />
                    </td>
                    <td class="text-right">
                        <p>{{__('Sub Total')}}</p>
                        <p id="caption_invoice_withdrawal">{{__('Withdrawal')}}</p>
                        <p>
                            <strong id="caption_total_payable">
                                @if($archieve_info['withdrawal'] > $archieve_info['payable_exclude_withdrawal'])
                                {{__('Remaining Withdrawal')}}
                                @else
                                {{__('Total Payable')}}
                                @endif    
                            </strong>
                        </p>
                    </td>
                    <td class="text-center">
                        <p>{{$archieve_info['subtotal'] }}</p>
                        <p id="val_invoice_withdrawal">{{$archieve_info['withdrawal']}}</p>
                        <p id="val_total_payable">                            
                            {{$archieve_info['payable_include_withdrawal']}}
                        </p>                        
                    </td>
                </tr>

            </tbody>
        </table>

    </div>

    <div class="row center" style="float: center">
        <div class="col-lg-3"></div>
        <div class="col-lg-6">
            <section class="panel">
                <div class="panel-body">
                    <div class="form-group">
                        
                        <div class="col-lg-3 form-group refereshrecapcha">
                            {!! captcha_img('flat') !!}                        
                        </div>
                        <div class="col-lg-2 col-md-2"><a href="javascript:void(0)" onclick="refreshCaptcha()">Refresh</a></div>
                        <div class="col-lg-4">
                            {!! Form::text('captcha', Input::old('captcha'), array('class' => 'form-control','data-validation'=> "required")) !!}

                            @if($errors->first('captcha'))
                            <label for="given_date" class="error">{{__('Captcha code invalid')}}</label>
                            @endif
                        </div>                                
                    </div>
                    
                </div>
            </section>
        </div>
    </div>        

    <div class="text-center ">

        {!! Form::submit('Submit',array('class' => 'btn btn-success')) !!}        
        <a href="{{route('wax_work_list',['labour_id' => $archieve_info['wax_labour_id']])}}" class="btn btn-primary" alt="Cancel" title="Cancel">Cancel</a>
    </div>
    {!! Form::close() !!}
</div>
@endsection

@push('scripts')
<script src="/js/jquery-loader/loadingoverlay.min.js"></script>
<script type="text/javascript">
                            $(function () {
                                $('#chk_include_withdrawal').change(function () {
                                    var payable_include_withdrawal = "<?php echo $archieve_info['payable_include_withdrawal']; ?>";
                                    var payable_exclude_withdrawal = "<?php echo $archieve_info['payable_exclude_withdrawal']; ?>";
                                    var withdrawal = "<?php echo $archieve_info['withdrawal']; ?>";
                                    var caption_remaining_withdrawal = "<?php echo __('Remaining Withdrawal'); ?>";
                                    var caption_total_payable = "<?php echo __('Total Payable'); ?>";
                                    var caption_include_withdrawal = "<?php echo __('Total Payable'); ?>";

                                    if ($(this).is(':checked')) {
                                        $('#caption_invoice_withdrawal').show();
                                        $('#val_invoice_withdrawal').show();
                                        if (parseFloat(withdrawal) > parseFloat(payable_exclude_withdrawal)) {
                                            $('#caption_total_payable').html(caption_remaining_withdrawal);
                                        }
                                        else {
                                            $('#caption_total_payable').html(caption_include_withdrawal);
                                        }
                                        $('#val_total_payable').html(payable_include_withdrawal);
                                        //$.LoadingOverlay("show");
                                    }
                                    else {
                                        $('#caption_invoice_withdrawal').hide();
                                        $('#val_invoice_withdrawal').hide();
                                        $('#caption_total_payable').html(caption_total_payable);
                                        $('#val_total_payable').html(payable_exclude_withdrawal);
                                    }
                                });
                            });
                            function refreshCaptcha() {
                                $.ajax({
                                    url: "<?php echo route('refresh_captcha'); ?>",
                                    type: 'get',
                                    dataType: 'html',
                                    success: function (json) {
                                        $('.refereshrecapcha').html(json);
                                    },
                                    error: function (data) {
                                        alert('Try Again.');
                                    }
                                });
                            }
</script>
@endpush