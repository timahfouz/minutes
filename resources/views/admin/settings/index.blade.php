@extends('admin.layout.master')
@section('title')
Settings
@endsection

@section('content')

<div class="col-lg-12 col-12 layout-spacing">
    <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4>Settings</h4>
                </div>
            </div>
        </div>
        <div class="widget-content widget-content-area">
        {{ Form::open(['route' => ['admin.settings.update'], 'method' => 'POST', 'files' => true ]) }}

            @include('admin.settings._form')

            <input type="submit" value="Save" class="mt-4 mb-4 btn btn-primary">
        {{ Form::close() }}

        </div>
    </div>
</div>



@endsection


@push('scripts')
	@include('admin.layout.text-editor')
@endpush