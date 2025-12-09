window.removeExistingImage = function(element, imageId) {
    if (!confirm('Apakah Anda yakin ingin menghapus gambar ini?')) return;

    const previewBox = element.closest('.preview-box');
    const deletedInput = previewBox.querySelector('.deleted-image-input');
    
    deletedInput.value = imageId;
    
    previewBox.style.display = 'none';
    previewBox.classList.remove('existing-image'); 

    if (typeof window.checkImageUploadLimit === 'function') {
        window.checkImageUploadLimit();
    } else {
        const max = 3;
        const visible = document.querySelectorAll('.preview-box.existing-image:not([style*="display: none"])').length;
        const btn = document.getElementById('add-image-btn');
        if (btn) btn.style.display = visible >= max ? 'none' : 'flex';
    }
};