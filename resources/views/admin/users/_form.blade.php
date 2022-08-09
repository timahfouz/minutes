<div class="form-group mb-4">
    <label for="name"> اختر صورة:</label>
    <input type="file" class="form-control" id="image"
        name="image">
</div>

<div class="form-group mb-4">
    <label for="name"> الاسم:</label>
    <input type="text" required class="form-control @error('name') is-invalid @enderror" id="name"
            name="name" placeholder="الاسم" value="{{old('name', (isset($item) ? $item->name : ''))}}">
</div>

<div class="form-group mb-4">
    <label for="phone"> رقم الهاتف:</label>
    <input type="text" required class="form-control @error('phone') is-invalid @enderror" id="phone"
            name="phone" placeholder="رقم الهاتف" value="{{old('phone', (isset($item) ? $item->phone : '') )}}">
</div>

<div class="row">
    <div class="form-group mb-4 col-md-6">
        <label for="password"> كلمة المرور:</label>
        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
            name="password" placeholder="كلمة المرور">
    </div>
    <div class="form-group mb-4 col-md-6">
        <label for="password_confirmation"> تأكيد كلمة المرور:</label>
        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation"
            name="password_confirmation" placeholder="تأكيد كلمة المرور">
    </div>
</div>

<div class="row">
    <div class="form-group mb-4 col-md-4">
        <label for="unit"> المحافظة:</label>
        <select type="text" required class="form-control" id="city"name="governorate_id">
            <option value="">المحافظة</option>
            @foreach($places as $place)
            <option {{(isset($item) ? ($item->governorate_id == $place->id) ? 'selected' : '' : '')}} value="{{ $place->id }}">{{ $place->name }}</option>
            @endforeach
        </select>  
    </div>
    <div class="form-group mb-4 col-md-4">
        <label for="unit"> المركز:</label>
        <select type="text" required class="form-control" id="city" name="city_id">
            <option value="">المركز</option>
            @foreach($cities as $city)
            <option {{(isset($item) ? ($item->city_id == $city->id) ? 'selected' : '' : '')}} value="{{ $city->id }}">{{ $city->name }}</option>
            @endforeach
        </select>  
    </div>
    <div class="form-group mb-4 col-md-4">
        <label for="unit"> المنطقة:</label>
        <select type="text" required class="form-control" id="area"name="area_id">
            <option value="">المنطقة</option>
            @foreach($areas as $area)
            <option {{(isset($item) ? ($item->area_id == $area->id) ? 'selected' : '' : '')}} value="{{ $area->id }}">{{ $area->name }}</option>
            @endforeach
        </select>  
    </div>
</div>




