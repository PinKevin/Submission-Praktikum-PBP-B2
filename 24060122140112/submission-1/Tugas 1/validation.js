document.addEventListener('DOMContentLoaded', function() {
    // Kategori dan Subkategori
    const kategoriSelect = document.getElementById('kategori');
    const subKategoriSelect = document.getElementById('subKategori');

    kategoriSelect.addEventListener('change', function() {
        const kategori = this.value;
        subKategoriSelect.innerHTML = '';

        if (kategori === 'Baju') {
            addSubKategori(['Baju Pria', 'Baju Wanita', 'Baju Anak']);
        } else if (kategori === 'Elektronik') {
            addSubKategori(['Mesin Cuci', 'Kulkas', 'AC']);
        } else if (kategori === 'Alat Tulis') {
            addSubKategori(['Kertas', 'Map', 'Pulpen']);
        }
    });

    function addSubKategori(options) {
        options.forEach(option => {
            const opt = document.createElement('option');
            opt.value = option;
            opt.textContent = option;
            subKategoriSelect.appendChild(opt);
        });
    }

    // Grosir dan Harga Grosir
    const grosirYa = document.getElementById('grosirYa');
    const grosirTidak = document.getElementById('grosirTidak');
    const hargaGrosirInput = document.getElementById('hargaGrosir');

    grosirYa.addEventListener('change', function() {
        hargaGrosirInput.disabled = false;
        hargaGrosirInput.required = true;
    });

    grosirTidak.addEventListener('change', function() {
        hargaGrosirInput.disabled = true;
        hargaGrosirInput.required = false;
        hargaGrosirInput.value = '';
    });

    // Captcha
    const captchaSpan = document.getElementById('captchaGenerated');
    const captchaInput = document.getElementById('captchaInput');

    function generateCaptcha() {
        const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        let captcha = '';
        for (let i = 0; i < 5; i++) {
            captcha += chars.charAt(Math.floor(Math.random() * chars.length));
        }
        captchaSpan.textContent = captcha;
    }

    generateCaptcha();

    // Validasi form
    const form = document.getElementById('productForm');
    form.addEventListener('submit', function(event) {
        if (!form.checkValidity()) {
            event.preventDefault();
            document.getElementById('namaError').textContent = document.getElementById('namaProduk').validationMessage;
            document.getElementById('deskripsiError').textContent = document.getElementById('deskripsiProduk').validationMessage;
            document.getElementById('kategoriError').textContent = document.getElementById('kategori').validationMessage;
            document.getElementById('subKategoriError').textContent = document.getElementById('subKategori').validationMessage;
            document.getElementById('hargaError').textContent = document.getElementById('hargaSatuan').validationMessage;
            document.getElementById('hargaGrosirError').textContent = document.getElementById('hargaGrosir').validationMessage;
            document.getElementById('jasaError').textContent = document.getElementById('jasaKirim').validationMessage;
            document.getElementById('captchaError').textContent = (captchaInput.value !== captchaSpan.textContent) ? 'Captcha tidak cocok' : '';
        }
    });
});
