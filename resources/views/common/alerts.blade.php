<script>
    let msg = undefined, type = undefined, title = undefined
    @if(session("success-message"))
        title = "{{ __("words.great") }}"
        msg = "{{ session("success-message") }}"
        type = "success"
    @elseif(session("error-message"))
        title = "{{ __("words.error") }}"
        msg = "{{ session("error-message") }}"
        type = "error"
    @elseif(session("warn-message"))
        title = "{{ __("words.warning") }}"
        msg = "{{ session("warn-message") }}"
        type = "warning"
    @elseif($errors->any())
        title = "{{ __("words.error") }}"
        msg = "{{ collect($errors->all())->implode(",") }}"
        type = "error"
    @endif
    if (msg) {
        swal({
            title: title,
            text: msg,
            icon: type,
        });
    }
</script>
