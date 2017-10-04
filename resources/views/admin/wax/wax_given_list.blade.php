@extends('admin.layouts.master')

@push('stylesheets')
@endpush

@section('content')
@parent
<div class="page-heading">
    <h3>
        {{__('Given Weight List')}}
    </h3>    
</div>
<div class="wrapper">    
    <div class="row">
                <div class="col-md-4">
                    <section class="">                            
                            <div class="">                                
                                <p>                                    
                                    <a href="{{route('wax_given_new_entry',['labour_id' => $labour_id])}}" class="btn btn-info" type="button">{{__('New Entry')}}</a>
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
                        @if(count($wax_given_list) > 0)
                        <table class="table table-bordered table-striped table-condensed">
                            <thead>
                                <tr>
                                    <th width="10%">{{__('Sr No')}}</th>
                                    <th width="40%">{{__('Given Weight')}}</th>
                                    <th width="40%">{{__('Given Date')}}</th>                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($wax_given_list as $wax_given_entry)
                                <tr>
                                    <td>{{$wax_given_entry['id']}}</td>
                                    <td>{{$wax_given_entry['weight']}}</td>                                                                       
                                    <td>{{Carbon\Carbon::parse($wax_given_entry['given_date'])->format('d/m/Y')}}</td>                                                                        
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