function checkEkstrakurikuler() {
    var kelas = document.getElementById('kelas').value;
    var ekstrakurikulerSection = document.getElementById('ekstrakurikuler-section');

    if (kelas == 'X' || kelas == 'XI') {
        ekstrakurikulerSection.style.display = 'block';
    } else if (kelas == 'XII') {
        ekstrakurikulerSection.style.display = 'none';
        // Bersihkan checkbox jika kelas XII dipilih
        var checkboxes = document.querySelectorAll('input[name="ekstrakurikuler[]"]');
        checkboxes.forEach((checkbox) => {
            checkbox.checked = false;
        });
    }
}