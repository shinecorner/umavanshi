@extends('admin.layouts.master')

@push('stylesheets')
@endpush

@section('content')
@parent
<div class="page-heading">
    <h3>
        {{__('Order Form List')}}
    </h3>    
</div>
<div class="wrapper">    
    <div class="row">
                <div class="col-md-4">
                    <section class="">                            
                            <div class="">                                
                                <p>                                    
                                    <a href="{{route('wax_new_order_form',['labour_id' => $labour_id])}}" class="btn btn-info" type="button">{{__('New Entry')}}</a>
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
                        @if(count($order_form_list) > 0)
                        <table class="table table-bordered table-striped table-condensed">
                            <thead>
                                <tr>
                                    <th width="10%">{{__('Sr No')}}</th>
                                    <th width="40%">{{__('Entry Date')}}</th>
                                    <th width="40%">{{__('Ordered Pieces')}}</th>
                                    <th width="40%">{{__('Detail')}}</th>                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order_form_list as $entry)
                                <tr>
                                    <td>{{$entry['id']}}</td>
                                    <td>{{Carbon\Carbon::parse($entry['entry_date'])->format('d/m/Y')}}</td>
                                    <td>{{$entry['ordered_pieces']}}</td>                                                                       
                                    <td>{{$entry['detail']}}</td>                                                                                                           
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