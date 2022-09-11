@extends('admin.layout.master')
@section('title')
    إضافة قسم جديدة
@endsection
@section('content')
    <div class="col-lg-12 col-12 layout-spacing">
        <div class="statbox widget box box-shadow margin">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12 margin">
                        <h4>التفاصيل </h4>
                    </div>
                </div>
            </div>
            <x-feedback />
            <div class="widget-content widget-content-area margin">
            {{ Form::open(['route' => ['admin.sections.store'], 'method' => 'POST', 'files' => true]) }}

                @include('admin.sections._form')

                <input type="submit" value="Save" class="mt-4 mb-4 btn btn-primary">
            {{ Form::close() }}

            </div>
        </div>
    </div>
@endsection
