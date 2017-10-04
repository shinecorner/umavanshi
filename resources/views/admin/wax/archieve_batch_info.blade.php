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
    <div class="panel" id="section-to-print">
        <div class="invoice">

            <div class="invoice-address">
                <div class="row">
                    <div class="col-md-5 col-sm-5">
                        <h4 class="inv-to">To</h4>
                        <h2 class="corporate-id">{{$batch_info['labour_name']}}</h2>
                    </div>
                    <div class="col-md-4 col-md-offset-3 col-sm-4 col-sm-offset-3">                        
                        <div class="inv-col"><span>{{__('Invoice Date')}}: </span> {{Carbon\Carbon::parse($batch_info['archieve_date'])->format('d/m/Y')}}</div>
                    </div>
                </div>
            </div>
        </div>        
        <?php $i = 1; ?>
        <table class="table table-bordered">
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

                @foreach($batch_info['entries'] as $key=>$entry)
                <tr>
                    <td>{{$i}}</td>
                    <td class="text-left">{{$entry['detail']}}</td>
                    <td class="text-center">{{$entry['entry_date']}}</td>
                    <td class="text-center">{{$entry['ordered_pieces']}}</td>
                    <td class="text-center">{{$entry['unit_price']}}</td>
                    <td class="text-center">{{$entry['entry_total_prices']}}</td>
                </tr>
                <?php $i++; ?>
                @endforeach
                <tr>
                    <td class="text-right" colspan="4">&nbsp;</td>
                    <td class="text-right">
                        <p><strong>{{__('Sub Total')}}</strong></p>
                        @if($batch_info['apply_withdrawal'])
                        <p id="caption_invoice_withdrawal">{{__('Withdrawal')}}</p>
                        @endif
                        <p>
                            <strong id="caption_total_payable">                                
                                @if(in_array($batch_info['remaining_withdrawal'],array('0','0.0','0.00','')))
                                {{__('Total Payable')}}
                                @else                                
                                {{__('Remaining Withdrawal')}}
                                @endif    
                            </strong>
                        </p>
                    </td>
                    <td class="text-center">
                        <p><strong>{{$batch_info['subtotal'] }}</strong></p>
                        @if($batch_info['apply_withdrawal'])
                        <p id="val_invoice_withdrawal"><strong>{{$batch_info['current_withdrawal']}}</strong></p>
                        @endif
                        <p id="val_total_payable">
                            @if(in_array($batch_info['remaining_withdrawal'],array('0','0.0','0.00','')))
                            <strong>{{$batch_info['total_paid']}}</strong>
                            @else
                            <strong>{{$batch_info['remaining_withdrawal']}}</strong>
                            @endif    
                        </p>                        
                    </td>
                </tr>

            </tbody>
        </table>

    </div>



    <div class="text-center ">

        <a href="#" onclick="window.print();
                return false;" class="btn btn-success" alt="Print" title="Print">Print</a>
        <a href="{{route('wax_work_list',['labour_id' => $batch_info['wax_labour_id']])}}" class="btn btn-primary" alt="Cancel" title="Cancel">Cancel</a>
    </div>
    {!! Form::close() !!}
</div>
@endsection

@push('scripts')

@endpush