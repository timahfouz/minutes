@extends('admin.layout.master')
@section('title')
    الرسائل الواردة
@endsection

@section('content')

    <div class="statbox widget box box-shadow" >
        <div class="widget-header" >
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4> الرسائل الواردة

                    </h4>
                </div>
            </div>
        </div>
        <div class="widget-content widget-content-area">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped table-checkable table-highlight-head mb-4">

                    <thead>
                    <tr>
                        <th class="">Name</th>
                        <th class="">Phone</th>
                        <th class="">Message</th>
                        <th class="">Time</th>
                        <th class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $item)
                        <tr>
                            <td class="checkbox-column">
                                <b>{{ $item->name }}</b>
                            </td>
                            <td class="checkbox-column">
                                <b>{{ $item->phone }}</b>
                            </td>
                            <td class="checkbox-column">
                                <b style="font-size: 14px;">{{ $item->message }}</b>
                            </td>
                            <td class="checkbox-column">
                                <b>{{ $item->created_at->format('Y-m-d h:ia') }}</b>
                            </td>

                            <td class="text-center">
                                <button style="border: 0;background: none" type="button"  data-placement="top" title=""
                                        data-original-title="Delet" data-toggle="modal" data-target="#deleteModal{{$item->id}}">

                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-trash-2 text-danger">
                                        <polyline points="3 6 5 6 21 6"></polyline>
                                        <path
                                            d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                        <line x1="10" y1="11" x2="10" y2="17"></line>
                                        <line x1="14" y1="11" x2="14" y2="17"></line>
                                    </svg>
                                </button>
                                <x-admin.delete-modal :route="$delte_route" :id="$item->id" />
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>


            </div>


        </div>
    </div>



@endsection
