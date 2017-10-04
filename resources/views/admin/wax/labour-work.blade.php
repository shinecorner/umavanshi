@extends('admin.layouts.master')

@push('stylesheets')
@endpush

@section('content')
@parent
<div class="page-heading">
    <h3>
        {{__('Wax work')}}
    </h3>    
</div>
<div class="wrapper">    
    <div class="row">
                <div class="col-md-8">
                    <section class="">                            
                            <div class="">                                
                                <p>                                    
                                    <a href="{{route('wax_work_new_entry',['labour_id' => $labour_id])}}" class="btn btn-info" type="button">{{__('New Entry')}}</a>
                                    <a href="{{route('wax_withdrawal_list',['labour_id' => $labour_id])}}" class="btn btn-info" type="button">{{__('Withdrawal')}}</a>
                                    <a href="{{route('wax_given_weight_list',['labour_id' => $labour_id])}}" class="btn btn-info" type="button">{{__('Given Weight')}}</a>
                                    <a href="{{route('wax_order_form_list',['labour_id' => $labour_id])}}" class="btn btn-info" type="button">{{__('Order Form')}}</a>
                                    <a href="{{route('wax_do_archieve',['labour_id' => $labour_id])}}" class="btn btn-info" type="button">{{__('Archieve Entry')}}</a>                                    
                                    <a href="{{route('list_archieve_batch',['labour_id' => $labour_id])}}" class="btn btn-info" type="button">{{__('Archieve Batch List')}}</a>                                    
                                </p>                                
                            </div>                        
                    </section>
                </div>
                
            </div>
    <div class="row">
        <div class="col-sm-12">
            <section class="panel">                
                <div class="panel-body">
                    <section id="unseen">
                        @if(count($works) > 0)
                        <table class="table table-bordered table-striped table-condensed">
                            <thead>
                                <tr>
                                    <th width="5%">{{__('Sr No')}}</th>
                                    <th width="8%">{{__('Entry Date')}}</th>
                                    <th width="5%">{{__('Wax Pieces')}}</th>                                    
                                    <th width="8%">{{__('Weight')}}</th>
                                    <th width="15%">{{__('Detail')}}</th>
                                    <th width="8%">{{__('Unit Price')}}</th>
                                    <th width="8%">{{__('Total Price')}}</th>
                                    <th width="8%">{{__('Given Weight')}}</th>
                                    <th width="8%">{{__('Given Wax Date')}}</th>
                                    <th width="8%">{{__('Remaining Weight')}}</th>                                    
                                    <th width="11%">{{__('Action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1;?>
                                @foreach($works as $work)
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{Carbon\Carbon::parse($work['entry_date'])->format('d/m/Y')}}</td>
                                    <td>{{$work['ordered_pieces']}}</td>
                                    <td>{{$work['used_weight']}}</td>
                                    <td>{{$work['detail']}}</td>
                                    <td>{{$work['unit_price']}}</td>
                                    <td>{{$work['total_price']}}</td>
                                    <td>{{$work['given_wax_weight']}}</td>
                                    <td>{{Carbon\Carbon::parse($work['given_wax_date'])->format('d/m/Y')}}</td>                                                                        
                                    <td>{{$work['remaining_weight']}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button data-toggle="dropdown" class="btn btn-info dropdown-toggle" type="button">{{__('Action')}}<span class="caret"></span></button>
                                            <ul role="menu" class="dropdown-menu">                                                
                                                <li><a href="{{route('wax_work_edit_entry',['entry_id' => $work['id']])}}" alt="{{__('Edit Entry')}}" title="{{__('Edit Entry')}}">{{__('Edit Entry')}}</a></li>
                                            </ul>
                                        </div><!-- /btn-group -->
                                    </td>
                                </tr>        
                                <?php $i++;?>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        
                        @endif
                    </section>
                </div>
            </section>                        
        </div>
    </div>    
</div>
@endsection

@push('scripts')
@endpush