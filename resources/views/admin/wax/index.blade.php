@extends('admin.layouts.master')

@push('stylesheets')
@endpush

@section('content')
@parent
<div class="page-heading">
    <h3>
        {{__('Wax Labour List')}}
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
                        <a href="{{route('labour_new_entry')}}" class="btn btn-info" type="button">{{__('New Labour Entry')}}</a>
                        <a href="{{route('wax-design-list')}}" class="btn btn-info" type="button">{{__('Design Detail')}}</a>
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
                                    <th>{{__('ID')}}</th>
                                    <th>{{__('Name')}}</th>
                                    <th>{{__('Action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($labours) > 0)
                                @foreach($labours as $labour)
                                <tr>
                                    <td>{{$labour['id']}}</td>
                                    <td>
                                        <a href="{{route('wax_work_list',['labour_id' => $labour['id']])}}" alt="" title="">{{$labour['name']}}</a>                                        
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <button data-toggle="dropdown" class="btn btn-info dropdown-toggle" type="button">{{__('Action')}}<span class="caret"></span></button>
                                            <ul role="menu" class="dropdown-menu">                                                
                                                <li><a href="{{route('labour_edit_entry',['entry_id' => $labour['id']])}}" alt="{{__('Edit Entry')}}" title="{{__('Edit Entry')}}">{{__('Edit Entry')}}</a></li>
                                            </ul>
                                        </div><!-- /btn-group -->
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="3" align="center">
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