<table class="table">
    <thead>
        <tr>
            <th>العميل</th>
            <th>عامل التوصيل</th>
            <th>إجمالى التكلفة</th>
            <th>كوبون الخصم</th>
            <th>عدد المنتجات</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ $item->user->name }}</td>
            <td>{{ $item->carrier->name ?? '---' }}</td>
            <td>{{ $item->total_cost }}</td>
            <td>{{ $item->coupon ?  $item->coupon->code." - ".$item->coupon->value.' جنيه' : '' }}</td>
            <td>{{ count($item->items()) }}</td>
        </tr>
    </tbody>
</table>

<div class="form-group col-md-4">
    <label for="unit"> تغيير الحالة:</label>
    <select required class="form-control" id="status" name="status">
        <option value="pending">جارى التنفيذ</option>
        <option {{ ($item->status == 'on-way') ? 'selected' : '' }} value='on-way'>قيد التوصيل</option>
        <option {{ ($item->status == 'completed') ? 'selected' : '' }} value='completed'>مكتمل</option>
        <option {{ ($item->status == 'rejected') ? 'selected' : '' }} value='rejected'>مرفوض</option>
    </select>
</div>
    
</div>