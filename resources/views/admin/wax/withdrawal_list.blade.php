@extends('admin.layouts.master')

@push('stylesheets')
@endpush

@section('content')
@parent
<div class="page-heading">
    <h3>
        {{__('Withdrawal')}}
    </h3>    
</div>
<div class="wrapper">    
    <div class="row">
                <div class="col-md-4">
                    <section class="">                            
                            <div class="">                                
                                <p>                                    
                                    <a href="{{route('wax_withdrawal_new_entry',['labour_id' => $labour_id])}}" class="btn btn-info" type="button">{{__('New Entry')}}</a>
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
                        @if(count($withdrawal_list) > 0)
                        <table class="table table-bordered table-striped table-condensed">
                            <thead>
                                <tr>                                    
                                    <th width="8%">{{__('Entry Date')}}</th>                                    
                                    <th width="8%">{{__('Current Amount')}}</th>
                                    <th width="5%">{{__('Withdrawal Amount')}}</th>
                                    <th width="5%">{{__('Settled Amount')}}</th>
                                    <th width="8%">{{__('Last Amount')}}</th>
                                    <th width="8%">{{__('Detail')}}</th>                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($withdrawal_list as $withdrawal_entry)
                                <tr>                                    
                                    <td>{{Carbon\Carbon::parse($withdrawal_entry['created_at'])->format('d/m/Y')}}</td>
                                    <td>{{$withdrawal_entry['current_amount']}}</td>
                                    <td>{{$withdrawal_entry['withdrawal_amount']}}</td>
                                    <td>{{$withdrawal_entry['settled_amount']}}</td>
                                    <td>{{$withdrawal_entry['last_amount']}}</td>                                    
                                    <td>{{$withdrawal_entry['detail']}}</td>                                                                        
                                </tr>
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