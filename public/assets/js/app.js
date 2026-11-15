(function () {
    'use strict';

    // Menu mobile
    var toggle = document.querySelector('.nav-toggle');
    var menu = document.getElementById('nav-menu');
    if (toggle && menu) {
        toggle.addEventListener('click', function () {
            var open = menu.classList.toggle('is-open');
            toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
            toggle.setAttribute('aria-label', open ? 'Tutup menu' : 'Buka menu');
        });
    }

    // Konfirmasi sebelum aksi berbahaya: <form data-confirm="Pesan...">
    document.addEventListener('submit', function (e) {
        var msg = e.target.getAttribute && e.target.getAttribute('data-confirm');
        if (msg && !window.confirm(msg)) {
            e.preventDefault();
        }
    });

    // Notifikasi sukses hilang otomatis
    var ok = document.querySelector('.alert-success');
    if (ok) {
        setTimeout(function () {
            ok.style.transition = 'opacity .4s';
            ok.style.opacity = '0';
            setTimeout(function () { ok.remove(); }, 450);
        }, 5000);
    }
})();
