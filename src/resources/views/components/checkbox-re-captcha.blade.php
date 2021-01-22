<div {{ $attributes->merge(["class" => "g-recaptcha", "id" => ""]) }}
     data-sitekey="{{ $siteKey }}"></div>
@error("g-recaptcha-response")
    <div class="text-danger" role="alert">
        {{ $message }}
    </div>
@enderror

@push("js-lib")
    @if (! $noScript)
        <script src="https://www.google.com/recaptcha/api.js"
                async defer>
        </script>
    @endif
@endpush
