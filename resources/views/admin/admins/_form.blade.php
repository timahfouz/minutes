<div class="form-group mb-4">
    <label for="name"> Name:</label>
    <input type="text" required class="form-control @error('name') is-invalid @enderror" id="name"
            name="name" placeholder="Name" value="{{old('name', (isset($item) ? $item->name : ''))}}">
</div>

<div class="form-group mb-4">
    <label for="email"> Email:</label>
    <input type="text" required class="form-control @error('email') is-invalid @enderror" id="email"
            name="email" placeholder="Email" value="{{old('email', (isset($item) ? $item->email : '') )}}">
</div>

<div class="form-group mb-4">
    <label for="password"> Password:</label>
    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
        name="password" placeholder="Password">

<div class="form-group mb-4">
    <label for="password_confirmation"> Password:</label>
    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation"
        name="password_confirmation" placeholder="Password Confirmation">

</div>