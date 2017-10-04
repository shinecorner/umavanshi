@extends('admin.layouts.master')

@push('stylesheets')
@endpush

@section('content')
@parent
<div class="page-heading">
    <h3>
        {{__('Dashboard')}}
    </h3>    
</div>
<div class="wrapper">
    <div class="row states-info">
        <div class="col-md-2">
            <div class="panel red-bg">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-4">
                            <i class="fa fa-money"></i>
                        </div>
                        <a href="{{route('wax_labour_list')}}" title="{{__('Wax')}}" alt="{{__('Wax')}}">
                            <div class="col-xs-8">
                                <h3 style="color: #fff">{{__('Wax')}}</h3> 
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-2">
            <div class="panel blue-bg">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-4">
                            <i class="fa fa-money"></i>
                        </div>
                        <a href="{{route('casting_labour_list')}}" title="{{__('Casting')}}" alt="{{__('Casting')}}">
                            <div class="col-xs-8">
                                <h3 style="color: #fff">{{__('Casting')}}</h3> 
                            </div>
                        </a>                        
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-2">
            <div class="panel green-bg">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-4">
                            <i class="fa fa-money"></i>
                        </div>
                        <a href="{{route('nachak_labour_list')}}" title="{{__('Nachak')}}" alt="{{__('Nachak')}}">
                            <div class="col-xs-8">
                                <h3 style="color: #fff">{{__('Nachak')}}</h3> 
                            </div>
                        </a>                        
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-2">
            <div class="panel yellow-bg">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-4">
                            <i class="fa fa-money"></i>
                        </div>                       
                        <a href="{{route('jaboro_labour_list')}}" title="{{__('Jaboro')}}" alt="{{__('Jaboro')}}">
                            <div class="col-xs-8">
                                <h3 style="color: #fff">{{__('Jaboro')}}</h3> 
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-2">
            <div class="panel blue-bg">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-4">
                            <i class="fa fa-money"></i>
                        </div>                        
                        <a href="{{route('drum_labour_list')}}" title="{{__('Drum')}}" alt="{{__('Drum')}}">
                            <div class="col-xs-8">
                                <h3 style="color: #fff">{{__('Drum')}}</h3> 
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-2">
            <div class="panel red-bg">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-4">
                            <i class="fa fa-money"></i>
                        </div>
                        <a href="{{route('rev_labour_list')}}" title="{{__('Revavu')}}" alt="{{__('Revavu')}}">
                            <div class="col-xs-8">
                                <h3 style="color: #fff">{{__('Revavu')}}</h3> 
                            </div>
                        </a>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row states-info">
        <div class="col-md-2">
            <div class="panel blue-bg">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-4">
                            <i class="fa fa-money"></i>
                        </div>
                        <a href="{{route('dull_labour_list')}}" title="{{__('Dull')}}" alt="{{__('Dull')}}">
                            <div class="col-xs-8">
                                <h3 style="color: #fff">{{__('Dull')}}</h3> 
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="panel yellow-bg">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-4">
                            <i class="fa fa-money"></i>
                        </div>                        
                        <a href="{{route('chholkam_labour_list')}}" title="{{__('Chholkam')}}" alt="{{__('Chholkam')}}">
                            <div class="col-xs-8">
                                <h3 style="color: #fff">{{__('Chholkam')}}</h3> 
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="panel red-bg">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-4">
                            <i class="fa fa-money"></i>
                        </div>
                        <a href="{{route('gold_labour_list')}}" title="{{__('Gold')}}" alt="{{__('Gold')}}">
                            <div class="col-xs-8">
                                <h3 style="color: #fff">{{__('Gold')}}</h3> 
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="panel green-bg">
                <div class="panel-body">
                    <div class="row">                                                
                        <a href="{{route('dimond_labour_list')}}" title="{{__('Diamond Seating')}}" alt="{{__('Diamond Seating')}}">
                            <div class="col-xs-12" style="padding-left: 25px;">
                                <h3 style="color: #fff">{{__('Diamond Seating')}}</h3> 
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="panel blue-bg">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-4">
                            <i class="fa fa-money"></i>
                        </div>                        
                        <a href="{{route('mino_labour_list')}}" title="{{__('Mino')}}" alt="{{__('Mino')}}">
                            <div class="col-xs-8">
                                <h3 style="color: #fff">{{__('Mino')}}</h3> 
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="panel green-bg">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-4">
                            <i class="fa fa-money"></i>
                        </div>                        
                        <a href="{{route('packing_labour_list')}}" title="{{__('Packing')}}" alt="{{__('Packing')}}">
                            <div class="col-xs-8">
                                <h3 style="color: #fff">{{__('Packing')}}</h3> 
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
@endpush