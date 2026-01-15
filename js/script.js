document.addEventListener("DOMContentLoaded", function() {
    
    // --- BAGIAN 1: FORMULIR REQUEST ---
    const form = document.getElementById('requestForm');

    if (form) {
        form.addEventListener('submit', function(event) {
            
            // Mencegah browser refresh otomatis
            // event.preventDefault();

            // 1. Ambil Nilai dari Input
            const nama      = document.getElementById('nama').value.trim(); // .trim() menghapus spasi di awal/akhir
            const email     = document.getElementById('email').value.trim();
            const nohp      = document.getElementById('nohp').value.trim();
            const chara     = document.getElementById('chara').value.trim();
            const game      = document.getElementById('game').value;
            const gender    = document.querySelector('input[name="gender"]:checked');

            // 2. Definisi Pola Validasi (Regex)
            // Pola Email: text + @ + text + . + text
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            
            // Pola Angka: Hanya angka 0-9
            const numberPattern = /^[0-9]+$/;

            // 3. LOGIKA VALIDASI
            
            // Cek Kekosongan Data Dasar
            if (nama === "") {
                alert("Nama pengunjung wajib diisi!");
                return;
            }

            if (email === "") {
                alert("Email wajib diisi!");
                return;
            }

            // --- VALIDASI EMAIL BARU ---
            if (!emailPattern.test(email)) {
                alert("Format email tidak valid! Pastikan mengandung '@' dan nama domain (contoh: user@gmail.com).");
                return;
            }

            if (nohp === "") {
                alert("Nomor WA wajib diisi!");
                return;
            }

            // --- VALIDASI NO HP BARU ---
            if (!numberPattern.test(nohp)) {
                alert("Nomor WA harus berupa angka saja! (Jangan gunakan spasi atau simbol)");
                return;
            }
            
            if (nohp.length < 10) {
                alert("Nomor WA terlalu pendek! Minimal 10 digit.");
                return;
            }

            if (chara === "") {
                alert("Nama Karakter yang direquest tidak boleh kosong!");
                return;
            }

            if (game === "") {
                alert("Silakan pilih Nama Band dari dropdown!");
                return;
            }

            if (!gender) {
                alert("Mohon pilih jenis kelamin karakter (Male/Female)!");
                return;
            }

            // 4. Pesan Sukses
            alert("Sukses! Request karakter " + chara + " (" + gender.value + ") dari band " + game + " berhasil dikirim.\n\nTerima kasih, " + nama + "!");
            
            // 5. Bersihkan Form
            form.reset();
        });
    }

    // --- BAGIAN DARK MODE TOGGLE ---
    const themeToggleBtn = document.getElementById('theme-toggle');
    const body = document.body;

    // Cek tema tersimpan saat loading
    if (localStorage.getItem('theme') === 'dark-mode') {
        body.classList.remove('light-mode');
        body.classList.add('dark-mode');
    }

    if (themeToggleBtn) {
        themeToggleBtn.addEventListener('click', () => {
            if (body.classList.contains('light-mode')) {
                body.classList.remove('light-mode');
                body.classList.add('dark-mode');
                localStorage.setItem('theme', 'dark-mode');
            } else {
                body.classList.remove('dark-mode');
                body.classList.add('light-mode');
                localStorage.setItem('theme', 'light-mode');
            }
        });
    }
});