<script>
    window.notify = function (content, type = 'info') {
        window.dispatchEvent(new CustomEvent("notify", {  detail: {content, type }} ));
     };
</script>
