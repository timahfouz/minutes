<div class="form-group mb-4">
    <label for="name"> اختر صورة:</label>
    <input type="file" class="form-control" id="image"
        name="image">
</div>


<div class="form-group mb-4 col-md-6">
    <label for="name"> اسم القسم:</label>
    <input type="text" required class="form-control @error('name') is-invalid @enderror" id="name"
        name="name" placeholder="اسم القسم" value="{{old('name', (isset($item) ? $item->name : ''))}}">
</div>