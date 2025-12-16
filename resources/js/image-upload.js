document.addEventListener('DOMContentLoaded', function () {    
    const container = document.getElementById('image-upload-container');
    const addBtn = document.getElementById('add-image-btn');    
    const finalInput = document.getElementById('final-upload-input'); 
    const selectorInput = document.getElementById('file-selector');

    if (!container || !finalInput || !addBtn || !selectorInput) return;

    const dt = new DataTransfer(); 
    const maxImages = 3;

    window.checkImageUploadLimit = checkMaxLimit;

    addBtn.addEventListener('click', function () {
        selectorInput.click();
    });

    selectorInput.addEventListener('change', function (event) {        
        const existingCount = document.querySelectorAll('.preview-box.existing-image:not([style*="display: none"])').length;
        let currentTotal = existingCount + dt.items.length;

        for (let i = 0; i < this.files.length; i++) {
            const file = this.files[i];

            if (currentTotal + 1 > maxImages) {
                alert(`Maksimal hanya ${maxImages} gambar!`);
                break;
            }

            if (!file.type.startsWith('image/')) {
                continue;
            }

            dt.items.add(file);
            
            createPreview(file);
            
            currentTotal++; 
        }

        finalInput.files = dt.files;
        
        checkMaxLimit();
        
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

        removeBtn.addEventListener('click', function (e) {
            e.stopPropagation(); 
            removeImage(file, previewDiv);
        });

        previewDiv.appendChild(removeBtn);
        container.insertBefore(previewDiv, addBtn);
    }

    function removeImage(fileToRemove, previewElement) {
        for (let i = 0; i < dt.items.length; i++) {
            if (dt.items[i].getAsFile() === fileToRemove) {
                dt.items.remove(i);
                break;
            }
        }
        
        previewElement.remove();
        
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

    checkMaxLimit();
});