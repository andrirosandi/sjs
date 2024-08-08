import './bootstrap';
import '../css/app.css'; 
import 'flowbite';
import { initDrawers, initFlowbite, initModals } from 'flowbite';
import { Html5Qrcode } from 'html5-qrcode';

document.addEventListener('livewire:navigated',()=>{
    initFlowbite();
    initDrawers();
    initModals();
})

document.addEventListener('livewire:navigating',()=>{
    if ( document.getElementById("logo-sidebar").getAttribute("aria-modal") === "true") {
        document.querySelector('[data-drawer-target="logo-sidebar"]').click();
    }
})

document.addEventListener('livewire:navigating',()=>{
function initUploader(name, caption) {
    console.log('a');
        const fileUploadField = document.getElementById('file-upload-' + name);
        const cancelButton = document.getElementById('cancel-button-' + name);
        const fileName = document.getElementById('file-name-' + name);
        const dragDropText = document.getElementById('drag-drop-text-' + name);

        // Add event listener for file input change
        fileUploadField.addEventListener('change', function() {
            if (fileUploadField.files.length > 0) {
                fileName.textContent = fileUploadField.files[0].name;
                dragDropText.style.display = 'none';
                cancelButton.style.display = 'inline-block';
            }
        });

        // Add event listener for cancel button click
        cancelButton.addEventListener('click', function() {
            fileUploadField.value = ''; // Clear the selected file
            fileName.textContent = 'Upload a file';
            dragDropText.style.display = 'inline-block';
            cancelButton.style.display = 'none';
        });
    }
    });

    
    document.addEventListener('livewire:initialized',()=>{
        Livewire.on('setcookies',({ newcookies })=>{
            newcookies.forEach(item => {
                document.cookie = item.name+'='+item.value+';expires='+item.time+';SameSite=yes;path=/';
            });
            
        });
    });
    document.addEventListener('livewire:initialized',()=>{
        Livewire.on('deletecookies',({ cookiesToDelete })=>{
            cookiesToDelete.forEach(item => {
                document.cookie = item.name+'=;expires=Thu, 01 Jan 1970 00:00:00 UTC;path=/;'; 
            });
        });
    });
    



    // resources/js/qr-scanner.js



document.addEventListener('livewire:navigated', function () {
    function onScanSuccess(decodedText, decodedResult) {
        // Handle hasil scan
        document.getElementById('qr-reader-results').innerText = `${decodedText} - tunggu, sedang dalam proses ...`;
        // let component = Livewire.find('unique-id-for-your-component'); // Ganti 'unique-id-for-your-component' dengan ID komponen Livewire Anda

        // Panggil metode myMethod di komponen Livewire
        // component.call('myMethod');
        Livewire.dispatch('coded', { code: `${decodedText}` });
        // $wire.setCode();
        // console.log('hai');
    }

    const qrReaderElement = document.getElementById('qr-reader');
    if (qrReaderElement) {
        const html5QrCode = new Html5Qrcode("qr-reader");
        html5QrCode.start({ facingMode: "environment" }, {
            fps: 10,
            qrbox: 250
        }, onScanSuccess);
    }


    
});
