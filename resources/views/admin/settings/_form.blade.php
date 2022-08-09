<div class="form-group mb-12">
    <label for="name"> Content:</label>
    <textarea rows="10" type="text" required class="form-control @error('content') is-invalid @enderror" id="myTextarea"
            name="content">{!! old('content', $content) !!}</textarea>
</div>

<div class="form-group mb-4">
    <label for="image">
        <img style="height: 200px; width: 180px;" src="{{ $image }}" alt="">
        Change Image:
    </label>
    <input type="file" class="form-control" id="image" name="image"/>
</div>

