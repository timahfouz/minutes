@if(session()->has('success'))
    <div class="alert alert-success" role="alert">
        تمت العملية بنجاح.
    </div>
@elseif(session()->has('error') || $errors->any())

    <div class="alert alert-danger" role="alert">
        {{ $errors->first() }}
    </div>

@endif