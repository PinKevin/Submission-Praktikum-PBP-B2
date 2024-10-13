//  Nama : Zahra Nisaa' Fitria Nur'Afifah
//  NIM  : 24060122140162
// 	Lab  : B2 
console.log("JavaScript file loaded");

function generateCaptcha() {
    let captcha = '';
    const characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    for (let i = 0; i < 5; i++) {
        captcha += characters.charAt(Math.floor(Math.random() * characters.length));
    }
    document.getElementById('captcha').value = captcha;
    console.log("Captcha generated:", captcha);
}

function validateForm() {
    console.log("validateForm called");
    const namaProduk = document.forms['formProduk']['namaProduk'].value;
    const deskripsi = document.forms['formProduk']['deskripsi'].value;
    const kategori = document.forms['formProduk']['kategori'].value;
    const subKategori = document.forms['formProduk']['subKategori'].value;
    const hargaSatuan = document.forms['formProduk']['hargaSatuan'].value;
    const grosir = document.forms['formProduk']['grosir'].value;
    const hargaGrosir = document.forms['formProduk']['hargaGrosir'].value;
    const jasaKirim = document.querySelectorAll('input[name="jasaKirim[]"]:checked').length;
    const captchaInput = document.forms['formProduk']['captchaInput'].value;
    const captcha = document.forms['formProduk']['captcha'].value;

    // Validasi Nama Produk
    if (namaProduk.length < 5 || namaProduk.length > 30) {
        console.log("Nama produk invalid");
        alert("Nama produk harus diisi, minimal 5 karakter, maksimal 30 karakter.");
        return false;
    }

    // Validasi Deskripsi Produk
    if (deskripsi.length < 5 || deskripsi.length > 100) {
        console.log("Deskripsi produk invalid");
        alert("Deskripsi produk harus diisi, minimal 5 karakter, maksimal 100 karakter.");
        return false;
    }

    // Validasi Kategori
    if (kategori === "") {
        console.log("Kategori invalid");
        alert("Kategori harus diisi.");
        return false;
    }

    // Validasi Sub Kategori
    if (subKategori === "") {
        console.log("Sub Kategori invalid");
        alert("Sub Kategori harus dipilih sesuai dengan kategori yang dipilih.");
        return false;
    }

    // Validasi Harga Satuan
    if (isNaN(hargaSatuan) || hargaSatuan === "") {
        console.log("Harga Satuan invalid");
        alert("Harga satuan harus diisi dan berupa nilai numerik.");
        return false;
    }

    // Validasi Grosir dan Harga Grosir
    if (grosir === "Ya" && (isNaN(hargaGrosir) || hargaGrosir === "")) {
        console.log("Harga Grosir invalid");
        alert("Jika Grosir dipilih 'Ya', maka Harga Grosir harus diisi dan berupa nilai numerik.");
        return false;
    }

    // Validasi Jasa Kirim
    if (jasaKirim < 3) {
        console.log("Jasa Kirim invalid");
        alert("Minimal jasa kirim yang dipilih adalah 3.");
        return false;
    }

    // Validasi Captcha
    if (captchaInput !== captcha) {
        console.log("Captcha invalid");
        alert("Captcha yang dimasukkan salah.");
        return false;
    }

    return true;
}

function resetForm() {
    generateCaptcha();
    return true;
}

document.addEventListener('DOMContentLoaded', function() {
    generateCaptcha();
});


function updateSubKategori() {
    console.log("updateSubKategori called");
    const kategori = document.getElementById('kategori').value;
    const subKategori = document.getElementById('subKategori');
    
    console.log("Selected Kategori:", kategori);
    
    // Clear existing options
    subKategori.innerHTML = '<option value="" disabled selected>---Pilih Sub Kategori---</option>';
    
    // Define subcategories for each category
    const subKategoriOptions = {
        'Baju': ['Kaos', 'Kemeja', 'Jaket'],
        'Elektronik': ['Handphone', 'Laptop', 'Televisi'],
        'Alat Tulis': ['Pensil', 'Pulpen', 'Buku']
    };
    
    // Populate subcategory options based on selected category
    if (kategori in subKategoriOptions) {
        subKategoriOptions[kategori].forEach(function(sub) {
            const option = document.createElement('option');
            option.value = sub;
            option.text = sub;
            subKategori.add(option);
        });
        console.log("Subcategories added:", subKategoriOptions[kategori]);
    } else {
        console.log("No subcategories found for selected category");
    }
}



