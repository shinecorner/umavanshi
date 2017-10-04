@extends('admin.layouts.master')

@push('stylesheets')
@endpush

@section('content')
@parent
<div class="page-heading">
    <h3>
        {{__('Archieve Batch List')}}
    </h3>    
</div>
<div class="wrapper">        
    <div class="row">
        <div class="col-sm-12">
            <section class="panel">                
                <div class="panel-body">
                    <section id="unseen">
                        @if(count($list_batch) > 0)
                        <table class="table table-bordered table-striped table-condensed">
                            <thead>
                                <tr>
                                    <th width="5%">{{__('ID')}}</th>
                                    <th width="8%">{{__('Archieve date range')}}</th>                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($list_batch as $batch)
                                <tr>
                                    <td>{{$batch['id']}}</td>
                                    <td>
                                        <a href="{{route('wax_fetch_archieve_entry',['labour_id' => $batch['id']])}}" alt="{{__('Archieve Batch')}}" title="{{__('Archieve Batch')}}">
                                            {{Carbon\Carbon::parse($batch['archieve_start_date'])->format('d/m/Y')}} - {{Carbon\Carbon::parse($batch['archieve_end_date'])->format('d/m/Y')}}
                                        </a>
                                        
                                    </td>
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