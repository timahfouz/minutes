<div class="form-group mb-4 col-md-6">
    <label for="name"> اسم الفئة:</label>
    <input type="text" required class="form-control @error('name') is-invalid @enderror" id="name"
        name="name" placeholder="اسم الفئة" value="{{old('name', (isset($item) ? $item->name : ''))}}">
</div>

<div class="form-group mb-4 col-md-6">
    <label for="color"> لون الفئة:</label>
    <input type="text" required class="form-control @error('color') is-invalid @enderror" id="color"
        name="color" placeholder="لون الفئة" value="{{old('color', (isset($item) ? $item->color : ''))}}">
</div>

<div class="form-group mb-4 col-md-6">
    <label for="description"> وصف الفئة:</label>
    <input type="text" required class="form-control @error('description') is-invalid @enderror" id="description"
        name="description" placeholder="وصف الفئة" value="{{old('description', (isset($item) ? $item->description : ''))}}">
</div>

<div class="form-group mb-4 col-md-6">
    <label for="unit"> القسم:</label>
    <select type="text" required class="form-control" id="section" name="parent_id">
        @foreach($sections as $section)
        <option {{(isset($item) ? ($item->parent_id == $section->id) ? 'selected' : '' : '')}} value="{{ $section->id }}">{{ $section->name }}</option>
        @endforeach
    </select>
</div>