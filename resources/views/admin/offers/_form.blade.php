<div class="row">
    <div class="form-group mb-4 col-md-6">
        <label for="unit"> المنتج:</label>
        <select type="text" required class="form-control" id="product"name="product_id">
            <option value="">اختر المنتج</option>
            @foreach($products as $product)
            <option {{(isset($item) ? ($item->product_id == $product->id) ? 'selected' : '' : '')}} value="{{ $product->id }}">{{ $product->name }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="row">
    <div class="form-group mb-4 col-md-6">
        <label for="new_price"> سعر العرض:</label>
        <input type="number" min="1" step="0.1" required class="form-control @error('new_price') is-invalid @enderror" id="new_price"
            name="new_price" placeholder="سعر العرض"  value="{{old('new_price', (isset($item) ? $item->new_price : ''))}}">
    </div>
    
    <div class="form-group mb-4 col-md-6">
        <label for="new_unit"> الوحدة:</label>
        <input type="text" required class="form-control @error('new_unit') is-invalid @enderror" id="new_unit"
            name="new_unit" placeholder="الوحدة" value="{{old('new_unit', (isset($item) ? $item->new_unit : ''))}}">
    </div>
</div>

<div class="row">
    <div class="form-group mb-4 col-md-6">
        <label for="new_price"> نوع العرض:</label>
        <select required class="form-control" id="is_offer_expired" name="is_offer_expired">
            <option value="0">عروض منتجات</option>
            <option {{(isset($item) ? $item->is_offer_expired? 'selected' : '' : '')}} value="1">عروض يومية</option>
        </select>
    </div>
    
    <div class="form-group mb-4 col-md-6">
        <label for="new_unit"> تاريخ انتهاء العرض:</label>
        <input type="time" class="form-control @error('expired_at') is-invalid @enderror" id="expired_at"
            name="expired_at" placeholder="تاريخ انتهاء العرض" value="{{old('expired_at', (isset($item) ? $item->expired_at : ''))}}">
    </div>
</div>