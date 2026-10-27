document.addEventListener('submit', (event) => {
    if (event.target.matches('[data-confirm-delete]') && !window.confirm('Hapus produk ini?')) {
        event.preventDefault();
    }
});
