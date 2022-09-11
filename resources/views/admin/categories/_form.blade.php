<div class="form-group mb-4 col-md-6">
    <label for="name"> اسم الفئة:</label>
    <input type="text" required class="form-control @error('name') is-invalid @enderror" id="name"
        name="name" placeholder="اسم الفئة" value="{{old('name', (isset($item) ? $item->name : ''))}}">
</div>

<div class="form-group mb-4 col-md-6">
    <label for="unit"> القسم:</label>
    <select type="text" required class="form-control" id="section" name="parent_id">
        @foreach($sections as $section)
        <option {{(isset($item) ? ($item->parent_id == $section->id) ? 'selected' : '' : '')}} value="{{ $section->id }}">{{ $section->name }}</option>
        @endforeach
    </select>
        
</div>