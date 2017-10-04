@extends('admin.layouts.master')

@push('stylesheets')
@endpush

@section('content')
@parent
<div class="page-heading">
    <h3>
        {{__('Design List')}}
    </h3>    
</div>
<div class="wrapper">    
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
    @if(Session::has('alert-' . $msg))
    <div class="alert alert-{{ $msg }} fade in">
        <button type="button" class="close close-sm" data-dismiss="alert">
            <i class="fa fa-times"></i>
        </button>
        {{ Session::get('alert-' . $msg) }}
    </div>
    @endif
    @endforeach
    <div class="row">
        <div class="col-md-4">
            <section class="">                            
                <div class="">                  
                    <p>                                    
                        <a href="{{route('wax_design_new_entry')}}" class="btn btn-info" type="button">{{__('New Entry')}}</a>
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

                        <table class="table table-bordered table-striped table-condensed">
                            <thead>
                                <tr>
                                    <th width="10%">{{__('Sr No')}}</th>
                                    <th width="20%">{{__('Name')}}</th>
                                    <th width="20%">{{__('Pieces')}}</th>
                                    <th width="20%">{{__('Weight')}}</th>                                    
                                    <th width="20%">{{__('Action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($wax_design_list) > 0)
                                @foreach($wax_design_list as $entry)
                                <tr>
                                    <td>{{$entry['id']}}</td>
                                    <td>{{$entry['name']}}</td>                                                                       
                                    <td>{{$entry['pieces']}}</td>                                                                       
                                    <td>{{$entry['weight']}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button data-toggle="dropdown" class="btn btn-info dropdown-toggle" type="button">{{__('Action')}}<span class="caret"></span></button>
                                            <ul role="menu" class="dropdown-menu">                                                
                                                <li><a href="{{route('wax_design_edit_entry',['entry_id' => $entry['id']])}}" alt="{{__('Edit Entry')}}" title="{{__('Edit Entry')}}">{{__('Edit Entry')}}</a></li>
                                            </ul>
                                        </div><!-- /btn-group -->
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="5" align="center">
                                        <p class="text-danger">
                                            {{__('No record found')}}
                                        </p>
                                    </td>
                                </tr>
                                @endif
                            </tbody>
                        </table>                        
                    </section>
                </div>
            </section>                        
        </div>
    </div>    
</div>
@endsection

@push('scripts')
@endpush