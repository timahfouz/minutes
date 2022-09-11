<table class="table">
    <thead>
        <tr>
            <th>العميل</th>
            <th>عامل التوصيل</th>
            <th>إجمالى التكلفة</th>
            <th>كوبون الخصم</th>
            <th>عدد المنتجات</th>
            <th>الضريبة</th>
            <th>سعر الشحن</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <img class="avatar" src="{{ $item->user->image->realPath() }}" alt="">
                {{ $item->user->name }}
            </td>
            <td>{{ $item->carrier->name ?? '---' }}</td>
            <td>{{ $item->total_cost }}</td>
            <td>{{ $item->coupon ?  $item->coupon->code." - ".$item->coupon->value.' جنيه' : '' }}</td>
            <td>{{ count($item->items()) }}</td>
            <td>{{ $item->info->commission }}</td>
            <td>{{ $item->info->delivery_fees }}</td>
        </tr>
    </tbody>
</table>
<pre>



</pre>
<h4>بيانات التواصل</h4>
<table class="table">
    <thead>
        <tr>
            <th>الاسم</th>
            <th>رقم الهاتف</th>
            <th>العنوان</th>
            <th>العنوان التفصيلى</th>
            <th>ملاحظات</th>
            <th>مرفقات</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ $item->info->name }}</td>
            <td>{{ $item->info->phone }}</td>
            <td>{{ $item->info->address }}</td>
            <td>{{ $item->info->extra_address }}</td>
            <td>{{ $item->info->description }}</td>
            <td>
                <img class="attachment" src="{{ $item->info->image->realPath() }}" alt="">
            </td>
        </tr>
    </tbody>
</table>
<pre>



</pre>
<h4>المنتجات</h4>
<table class="table">
    <thead>
        <tr>
            <th>المنتج</th>
            <th>السعر</th>
            <th>الكمية</th>
            <th>الوحدة</th>
            <th>إجمالى السعر</th>
        </tr>
    </thead>
    <tbody>
        @foreach($item->catItems() as $cartItem)
        <tr>
            <td>
                <img class="avatar" src="{{ $cartItem->product->image->realPath() }}" alt="">
                {{ $cartItem->product->name }}
            </td>
            <td>{{ $cartItem->price }} جنيه</td>
            <td>{{ $cartItem->qty }}</td>
            <td>{{ $cartItem->unit }}</td>
            <td>{{ $cartItem->price * $cartItem->qty }} جنيه</td>
        </tr>
        @endforeach
    </tbody>
</table>
<pre>



</pre>
<h4>التكلفة الإجمالية: {{ $item->total_cost + $item->info->commission + $item->info->delivery_fees }} جنيه</h4>
<pre>
    
    

</pre>

<div class="row">
    <div class="form-group col-md-4">
        <label for="unit"> تغيير الحالة:</label>
        <select required class="form-control" id="status" name="status">
            <option value="pending">جارى التنفيذ</option>
            <option {{ ($item->status == 'on-way') ? 'selected' : '' }} value='on-way'>قيد التوصيل</option>
            <option {{ ($item->status == 'completed') ? 'selected' : '' }} value='completed'>مكتمل</option>
            <option {{ ($item->status == 'rejected') ? 'selected' : '' }} value='rejected'>مرفوض</option>
        </select>
    </div>
    
    <div class="form-group col-md-4">
        <label for="unit"> تغيير عامل التوصيل:</label>
        <select class="form-control" id="carrier_id" name="carrier_id">
            <option value="">اختر عامل التوصيل</option>
            @foreach($carriers as $carrier)
            <option {{ ($carrier->id == $item->carrier_id) ? 'selected' : '' }} value='{{ $carrier->id }}'>{{ $carrier->username.' - '.$carrier->phone }}</option>
            @endforeach
        </select>
    </div>
</div>
    
</div>