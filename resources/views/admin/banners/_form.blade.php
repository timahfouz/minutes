<div class="form-group mb-4">
    <label for="name"> اختر صورة:</label>
    <input type="file" class="form-control" id="image"
        name="image">
</div>


<div class="form-group mb-4 col-md-6">
    <label for="description">  الوصف:</label>
    <textarea type="text" required class="form-control @error('description') is-invalid @enderror" id="description"
        rows="5" name="description" placeholder="الوصف">{{old('description', (isset($item) ? $item->description : ''))}}</textarea>
</div>