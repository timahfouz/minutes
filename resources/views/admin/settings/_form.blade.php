<div class="row">
    <div class="form-group mb-4 col-md-6">
        <label for="facebook">Facebook:</label>
        <input type="text" class="form-control @error('facebook') is-invalid @enderror" id="facebook"
            name="facebook" placeholder="https://www.facebook.com/minutes" value="{{ $facebook ?? '' }}">
    </div>
    <div class="form-group mb-4 col-md-6">
        <label for="twitter">Twitter:</label>
        <input type="text" class="form-control @error('twitter') is-invalid @enderror" id="twitter"
            name="twitter" placeholder="https://www.twitter.com/minutes" value="{{ $twitter ?? '' }}">
    </div>
</div>

<div class="row">
    <div class="form-group mb-4 col-md-6">
        <label for="instagram">Instagram:</label>
        <input type="text" class="form-control @error('instagram') is-invalid @enderror" id="instagram"
            name="instagram" placeholder="https://www.instagram.com/minutes" value="{{ $instagram?? '' }}">
    </div>
    <div class="form-group mb-4 col-md-6">
        <label for="website">Website:</label>
        <input type="text" class="form-control @error('website') is-invalid @enderror" id="website"
            name="website" placeholder="https://www.minutes.com" value="{{ $website ?? '' }}">
    </div>
</div>

<div class="row">
    <div class="form-group mb-4 col-md-6">
        <label for="commission">أجر المنصة:</label>
        <input type="number" min="0" step="0.1" class="form-control @error('commission') is-invalid @enderror" id="commission"
            name="commission" placeholder="أجر المنصة" value="{{ $commission ?? 0 }}">
    </div>
    <div class="form-group mb-4 col-md-6">
        <label for="delivery_fees">خدمة التوصيل:</label>
        <input type="number" min="0" step="0.1" class="form-control @error('delivery_fees') is-invalid @enderror" id="delivery_fees"
            name="delivery_fees" placeholder="خدمة التوصيل" value="{{ $delivery_fees ?? 0 }}">
    </div>
</div>


<div class="form-group mt-4">
    <label for="commission">من نحن:</label>
    <textarea min="0" step="0.1" class="form-control @error('about_us') is-invalid @enderror" id="about_us"
        rows="7" name="about_us" placeholder="أجر المنصة">{{ $about_us ?? '' }}</textarea>
</div>
