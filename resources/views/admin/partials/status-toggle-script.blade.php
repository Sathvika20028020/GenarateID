<script>
document.addEventListener('change', function (event) {
    const toggle = event.target.closest('.js-status-toggle');

    if (!toggle) {
        return;
    }

    const url = toggle.dataset.url;
    const previousState = !toggle.checked;

    if (!url) {
        return;
    }

    toggle.disabled = true;

    fetch(url, {
        method: 'PATCH',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            status: toggle.checked ? 1 : 0
        })
    })
    .then(function (response) {
        if (!response.ok) {
            throw new Error('Status update failed');
        }

        return response.json();
    })
    .then(function (data) {
        toggle.checked = Boolean(data.status);

        if (window.Swal) {
            Swal.fire({
                icon: 'success',
                title: 'Updated',
                text: data.message || 'Status updated successfully.',
                timer: 1200,
                showConfirmButton: false
            });
        }
    })
    .catch(function () {
        toggle.checked = previousState;

        if (window.Swal) {
            Swal.fire({
                icon: 'error',
                title: 'Update failed',
                text: 'Unable to update status. Please try again.',
                confirmButtonColor: '#ff6a88'
            });
        }
    })
    .finally(function () {
        toggle.disabled = false;
    });
});
</script>
