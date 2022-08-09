
<div class="form-group mb-4 col-md-6">
    <label for="name"> اسم المنطقة:</label>
    <input type="text" required class="form-control @error('name') is-invalid @enderror" id="name"
        name="name" placeholder="اسم المنطقة" value="{{old('name', (isset($item) ? $item->name : ''))}}">
</div>

<label for="unit"> المدينة:</label>
<select required class="form-control" id="category"name="parent_id">
    @foreach($cities as $city)
    <option {{(isset($item) ? ($item->parent_id == $city->id) ? 'selected' : '' : '')}} value="{{ $city->id }}">{{ $city->name }}</option>
    @endforeach
</select>
    
</div>