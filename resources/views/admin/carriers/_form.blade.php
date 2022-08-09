<div class="form-group mb-4">
    <label for="name"> اختر صورة:</label>
    <input type="file" class="form-control" id="image"
        name="image">
</div>

<div class="form-group mb-4">
    <label for="username"> الاسم:</label>
    <input type="text" required class="form-control @error('username') is-invalid @enderror" id="username"
            name="username" placeholder="الاسم" value="{{old('username', (isset($item) ? $item->username : ''))}}">
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