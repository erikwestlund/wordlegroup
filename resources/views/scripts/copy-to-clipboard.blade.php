@once
@push('scripts')
<script>
    function copyToClipboard(text) {
        if (window.clipboardData && window.clipboardData.setData) {
            notify('Copied to clipboard.')
            console.log('clicked')
            return clipboardData.setData("Text", text);
        }
        else if (document.queryCommandSupported && document.queryCommandSupported("copy")) {
            var textarea = document.createElement("textarea");
            textarea.textContent = text;
            textarea.style.position = "fixed";
            document.body.appendChild(textarea);
            textarea.select();
            try {
                return document.execCommand("copy");
            }
            catch (ex) {
                console.warn("Copy to clipboard failed.", ex);
                return false;
            }
            finally {
                notify('Copied to clipboard.')
                console.log('clicked')
                document.body.removeChild(textarea);
            }
        }
    }
</script>
@endpush
@endonce
