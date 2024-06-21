<x-layout page="Edit Social Links">

    <div class="container">
        <div class="bg-light mt-3 p-4 rounded border border-1">
            <h2 class="text-center m-4">Edit social links</h2>

            @session('message')
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endsession

            <form 
                action="{{ route('social.store') }}"
                method="POST"
                class="social-form form w-50 m-auto">

                @csrf

                <div class="form-group mb-3">
                    <label for="facebook" class="mb-2">Facebook</label>
                    <input type="text" value="{{ old('facebook') ?? $social->facebook }}" id="facebook" class="form-control" placeholder="eq: https://facebook.com/username" name="facebook">
                    @error('facebook')
                        {{ $message }}
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="instagram" class="mb-2">Instagram</label>
                    <input type="text" value="{{ old('instagram') ?? $social->instagram }}" id="instagram" class="form-control" placeholder="eq: https://instagram.com/username" name="instagram">
                    @error('instagram')
                        {{ $message }}
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="tiktok" class="mb-2">TikTok</label>
                    <input type="text" value="{{ old('tiktok') ?? $social->tiktok }}" id="tiktok" class="form-control" placeholder="eq: https://tiktok.com/username" name="tiktok">
                    @error('tiktok')
                        {{ $message }}
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="linkedin" class="mb-2">LinkedIn</label>
                    <input type="text" value="{{ old('linkedin') ?? $social->linkedin }}" id="linkedin" class="form-control" placeholder="eq: https://linkedin.com/username" name="linkedin">
                    @error('linkedin')
                        {{ $message }}
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="github" class="mb-2">Github</label>
                    <input type="text" value="{{ old('github') ?? $social->github }}" id="github" class="form-control" placeholder="eq: https://github.com/username" name="github">
                    @error('github')
                        {{ $message }}
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="google" class="mb-2">Google+</label>
                    <input type="text" value="{{ old('google') ?? $social->google }}" id="google" class="form-control" placeholder="eq: https://plus.google.com/username" name="google">
                    @error('google')
                        {{ $message }}
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="youtube" class="mb-2">YouTube</label>
                    <input type="text" value="{{ old('youtube') ?? $social->youtube }}" id="youtube" class="form-control" placeholder="eq: https://youtube.com/username" name="youtube">
                    @error('youtube')
                        {{ $message }}
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="website" class="mb-2">Own Website</label>
                    <input type="text" value="{{ old('website') ?? $social->website }}" id="website" class="form-control" placeholder="eq: https://example.com" name="website">
                    @error('website')
                        {{ $message }}
                    @enderror
                </div>

                <div class="form-group mt-4">
                    <input type="submit" class="btn btn-primary px-4" value="Submit" name="submit">
                </div>


            </form>

        </div>
    </div>

</x-layout>