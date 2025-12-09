document.addEventListener('DOMContentLoaded', function () {    
    const container = document.getElementById('image-upload-container');
    const addBtn = document.getElementById('add-image-btn');    
    const finalInput = document.getElementById('final-upload-input'); // Input Asli
    const selectorInput = document.getElementById('file-selector');   // Dummy Trigger

    if (!container || !finalInput || !addBtn || !selectorInput) return;

    const dt = new DataTransfer(); // Penampung File
    const maxImages = 3;

    // Expose fungsi ini agar bisa dipanggil dari review-edit.js (saat hapus gambar lama)
    window.checkImageUploadLimit = checkMaxLimit;

    // Trigger dummy input
    addBtn.addEventListener('click', function () {
        selectorInput.click();
    });

    // Saat user memilih file baru
    selectorInput.addEventListener('change', function (event) {        
        // Hitung total saat ini (Gambar Lama yg belum dihapus + Gambar Baru di DT)
        const existingCount = document.querySelectorAll('.preview-box.existing-image:not([style*="display: none"])').length;
        // Gunakan 'let' karena nilainya akan berubah
        let currentTotal = existingCount + dt.items.length;

        for (let i = 0; i < this.files.length; i++) {
            const file = this.files[i];

            // Cek Limit
            if (currentTotal + 1 > maxImages) {
                alert(`Maksimal hanya ${maxImages} gambar!`);
                break;
            }

            if (!file.type.startsWith('image/')) {
                continue;
            }

            // Tambahkan ke DataTransfer
            dt.items.add(file);
            
            // Tampilkan Preview
            createPreview(file);
            
            // Increment
            currentTotal++; 
        }

        // Update Input Asli
        finalInput.files = dt.files;
        
        // Cek apakah tombol (+) harus hilang
        checkMaxLimit();
        
        // Reset dummy input agar bisa pilih file yang sama lagi
        this.value = '';
    });

    function createPreview(file) {
        const previewDiv = document.createElement('div');
        previewDiv.classList.add('preview-box');

        const reader = new FileReader();
        reader.onload = function (e) {
            previewDiv.style.backgroundImage = `url(${e.target.result})`;
        };
        reader.readAsDataURL(file);

        const removeBtn = document.createElement('div');
        removeBtn.classList.add('remove-btn');
        removeBtn.innerHTML = '<i class="bi bi-x"></i>';

        // Event Hapus Gambar Baru
        removeBtn.addEventListener('click', function (e) {
            e.stopPropagation(); // Mencegah bubbling
            removeImage(file, previewDiv);
        });

        previewDiv.appendChild(removeBtn);
        container.insertBefore(previewDiv, addBtn);
    }

    function removeImage(fileToRemove, previewElement) {
        // Hapus dari DataTransfer
        for (let i = 0; i < dt.items.length; i++) {
            // Perbandingan file object
            if (dt.items[i].getAsFile() === fileToRemove) {
                dt.items.remove(i);
                break;
            }
        }
        
        // Hapus elemen visual
        previewElement.remove();
        
        // Update Input Asli (PENTING AGAR CONTROLLER TERIMA PERUBAHAN)
        finalInput.files = dt.files;
        
        checkMaxLimit();
    }

    function checkMaxLimit() {
        const existingCount = document.querySelectorAll('.preview-box.existing-image:not([style*="display: none"])').length;
        const newCount = dt.items.length;
        
        if ((existingCount + newCount) >= maxImages) {
            addBtn.style.display = 'none';
        } else {
            addBtn.style.display = 'flex';
        }
    }

    // Jalankan sekali saat load
    checkMaxLimit();
});