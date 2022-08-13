@extends('admin.layout.master')
@section('title')
    الطلبات
@endsection

@section('content')

    <div class="statbox widget box box-shadow margin" >
        <div class="widget-header" >
            <div class="row margin">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4> الطلبات
                    </h4>
                </div>
            </div>
        </div>
        <div class="widget-content widget-content-area margin">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped table-checkable table-highlight-head mb-4">

                    <thead>
                    <tr>
                        <th class="">اسم العميل</th>
                        <th class="">عامل التوصيل</th>
                        <th class="">الحالة</th>
                        <th class="">عدد المنتجات</th>
                        <th class="">التكلفة الإجمالية</th>
                        <th class="">طلب خاص</th>
                        <th class="">الخيارات</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $item)
                        <tr>
                            <td class="checkbox-column">
                                <b style="font-size: 18px;">{{ $item->user->name }}</b>
                            </td>
                            <td class="checkbox-column">
                                <b style="font-size: 18px;">{{ $item->carrier_id ? $item->carrier->username.' - '.$item->carrier->phone : '---' }}</b>
                            </td>
                            <td class="checkbox-column">
                                <b style="font-size: 18px;">{{ translateStatus($item->status) }}</b>
                            </td>
                            <td class="checkbox-column">
                                <b style="font-size: 18px;">{{ count($item->items()) }}</b>
                            </td>
                            <td class="checkbox-column">
                                <b style="font-size: 18px;">{{ $item->total_cost }}</b>
                            </td>
                            <td class="checkbox-column">
                                <i style="font-size: 20px; color: {{ $item->is_special ? 'green' : 'brown' }};" class="fa fa-thumbs-{{ $item->is_special ? 'up' : 'down' }}"></i>
                            </td>
                            <td class="text-center">
                                <a data-toggle="tooltip" href="{{ route('admin.orders.edit', $item->id) }}"
                                data-placement="top" title="" data-original-title="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="feather feather-edit-2 text-success">
                                        <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                    </svg>
                                </a>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>


            </div>


        </div>
    </div>



@endsection
