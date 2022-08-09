<div class="form-group mb-4">
    <label for="name"> اختر صورة:</label>
    <input type="file" class="form-control" id="image"
        name="image">
</div>

<div class="row">
    <div class="form-group mb-4 col-md-6">
        <label for="name"> اسم المنتج:</label>
        <input type="text" required class="form-control @error('name') is-invalid @enderror" id="name"
            name="name" placeholder="اسم المنتج" value="{{old('name', (isset($item) ? $item->name : ''))}}">
    </div>
    
    <div class="form-group mb-4 col-md-6">
        <label for="price"> سعر المنتج:</label>
        <input type="number" min="1" step="0.1" required class="form-control @error('price') is-invalid @enderror" id="price"
            name="price" placeholder="سعر المنتج"  value="{{old('price', (isset($item) ? $item->price : ''))}}">
    </div>
</div>

<div class="row">
    <div class="form-group mb-4 col-md-6">
        <label for="discount"> الخصم:</label>
        <input type="number" min="0" step="0.1" required class="form-control @error('discount') is-invalid @enderror" id="discount"
            name="discount" placeholder="الخصم"  value="{{old('discount', (isset($item) ? $item->discount : ''))}}">
    </div>
    
    <div class="form-group mb-4 col-md-6">
        <label for="unit"> الوحدة:</label>
        <input type="text" required class="form-control @error('unit') is-invalid @enderror" id="unit"
            name="unit" placeholder="الوحدة" value="{{old('unit', (isset($item) ? $item->unit : ''))}}">
    </div>
</div>

<div class="form-group mb-4 col-md-6 offset-md-3">
    <label for="unit"> الفئة:</label>
    <select type="text" required class="form-control" id="category"name="category_id">
        @foreach($categories as $category)
        <option {{(isset($item) ? ($item->category_id == $category->id) ? 'selected' : '' : '')}} value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>
        
</div>