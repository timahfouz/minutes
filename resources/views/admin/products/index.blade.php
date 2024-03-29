@extends('admin.layout.master')
@section('title')
Products
@endsection

@section('content')

    <div class="statbox widget box box-shadow" >
        <div class="widget-header" >
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4> Products

                    </h4>
                    <div class="float-lg-right">
                        <a class="btn btn-primary" href="{{ route('admin.products.create') }}">إضافة منتج جديد</a>
                    </div>
                </div>
            </div>
        </div>

        {{ Form::open(['method' => 'GET']) }}
        <div class="row">
            <div class="form-group" style="margin-left: 50px;">
                <input  type="text" class="form-control" name="keyword" placeholder="بحث بالاسم">
            </div>
            <div class="form-group" style="margin-left: 10px;">
                <select name="category_id" class="form-control">
                    <option value="">اختر الفئة</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name}}</option>
                    @endforeach
                </select>
            </div>
            <button style="margin-left: 50px;" type="submit" class="btn btn-success">Search</button>
        </div>
        {{ Form::close() }}

        <div class="widget-content widget-content-area">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped table-checkable table-highlight-head mb-4">

                    <thead>
                    <tr>
                        <th class="">الاسم</th>
                        <th class="">الفئة</th>
                        <th class="">السعر</th>
                        <th class="">الخصم</th>
                        <th class="">الوحدة</th>
                        <th class="">المخزن</th>
                        <th class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $item)
                        <tr>
                            <td class="checkbox-column">
                                <img class="img-circle" src="{{ $item->image->realPath() }}" alt="">
                                <b>{{ $item->name }}</b>
                            </td>
                            <td class="checkbox-column">
                                <b>{{ $item->category->name }}</b>
                            </td>
                            <td class="checkbox-column">
                                <b>{{ $item->price }}</b>
                            </td>
                            <td class="checkbox-column">
                                <b>{{ $item->discount }}%</b>
                            </td>
                            <td class="checkbox-column">
                                <b>{{ $item->unit }}</b>
                            </td>
                            <td class="checkbox-column">
                                <b>{{ $item->in_stock }}</b>
                            </td>

                            <td class="text-center">
                                <a data-toggle="tooltip" href="{{ route('admin.products.edit', $item->id) }}"
                                data-placement="top" title="" data-original-title="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="feather feather-edit-2 text-success">
                                        <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                    </svg>
                                </a>

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
