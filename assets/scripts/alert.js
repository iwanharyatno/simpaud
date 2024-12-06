document.querySelectorAll('.alert-dismiss').forEach(el => {
    el.addEventListener('click', function() {
        el.parentElement.remove();
    });
});