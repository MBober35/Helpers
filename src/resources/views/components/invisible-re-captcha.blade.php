<button data-sitekey="{{ $siteKey }}"
        data-callback="{{ $callback }}"
        {{ $attributes->merge([
                "class" => "g-recaptcha btn",
                "type" => "submit",
                "id" => ""
            ]) }}>
    {{ $slot }}
</button>
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
    @if ($formId)
        <script>
            function {{ $callback }}(token) {
                document.getElementById("{{ $formId }}").submit();
            }
        </script>
    @endif
@endpush
