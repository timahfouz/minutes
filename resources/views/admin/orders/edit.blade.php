@extends('admin.layout.master')
@section('title')
    بيانات وتعديل الطلب
@endsection
@section('content')
    <div class="col-lg-12 col-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header margin">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>نوع الطلب: طلب {{ $item->is_special ? 'خاص' : 'عادى'}}</h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area margin">
                {{ Form::open(['route' => ['admin.orders.update', $item->id], 'method' => 'PUT']) }}

                    @include('admin.orders._form')

                    <input type="submit" value="حفظ" class="mt-4 mb-4 btn btn-primary">
                {{ Form::close() }}

            </div>
        </div>
    </div>



@endsection
