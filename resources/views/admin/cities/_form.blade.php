
<div class="form-group mb-4 col-md-6">
    <label for="name"> اسم المحافظة:</label>
    <input type="text" required class="form-control @error('name') is-invalid @enderror" id="name"
        name="name" placeholder="اسم المحافظة" value="{{old('name', (isset($item) ? $item->name : ''))}}">
</div>