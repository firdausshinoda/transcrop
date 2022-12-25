$(document).ready(function () {
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar, #content').toggleClass('active');
        $('.collapse.in').toggleClass('in');
        $('a[aria-expanded=true]').attr('aria-expanded', 'false');
    });
});
function setItem(id) {
    if (id==="dashboard"){$('.components #i_dashboard').addClass('active');}
    else if (id==="notifikasi"){$('.components #i_notifikasi').addClass('active');}
    else if (id==="jenis_kendaraan"){$('.components #i_jenis_kendaraan').addClass('active');}
    else if (id==="jenis_barang"){$('.components #i_jenis_barang').addClass('active');}
    else if (id==="jenis_sim"){$('.components #i_jenis_sim').addClass('active');}
    else if (id==="bank"){$('.components #i_bank').addClass('active');}
    else if (id==="pemesanan"){$('.components #i_pemesanan').addClass('active');}
    else if (id==="perusahaan"){$('.components #i_perusahaan').addClass('active');}
    else if (id==="sopir"){$('.components #i_sopir').addClass('active');}
    else if (id==="pengguna"){$('.components #i_pengguna').addClass('active');}
    else if (id==="kritik_saran"){$('.components #i_kritik_saran').addClass('active');}
    else if (id==="laporan"){$('.components #i_laporan').addClass('active');}
    else if (id==="pengaturan"){$('.components #i_pengaturan').addClass('active');}
}
const swalWithBootstrapButtons = Swal.mixin({
    customClass: {confirmButton: 'btn btn-success m-1', cancelButton: 'btn btn-danger m-1'},
    buttonsStyling: false
});
function notif_success_with_reload() {
    swalWithBootstrapButtons.fire({title: 'Berhasil', text: "", icon: 'success',}).then((result) => {
        if (result.value) {
            location.reload();
        }
    });
}
function notif_success_with_url(url) {
    swalWithBootstrapButtons.fire({title: 'Berhasil', text: "", icon: 'success',}).then((result) => {
        if (result.value) {
            window.location.replace(url);
        }
    });
}
$.validator.addMethod('filesize', function (value, element, param) {
    return this.optional(element) || (element.files[0].size <= param)
}, 'Ukuran file harus kurang dari 1 Mb...');
var grays = {
    white: '#fff',
    100: '#f9fafd',
    200: '#edf2f9',
    300: '#d8e2ef',
    400: '#b6c1d2',
    500: '#9da9bb',
    600: '#748194',
    700: '#5e6e82',
    800: '#4d5969',
    900: '#344050',
    1000: '#232e3c',
    1100: '#0b1727',
    black: '#000'
};
var colors = {
    primary: '#2c7be5',
    secondary: '#748194',
    success: '#00d27a',
    info: '#27bcfd',
    warning: '#f5803e',
    danger: '#e63757',
    light: '#f9fafd',
    dark: '#0b1727'
};
function getPosition(pos, params, dom, rect, size) {
    return {
        top: pos[1] - size.contentSize[1] - 10,
        left: pos[0] - size.contentSize[0] / 2
    };
}
function rgbaColor(str1, str2) {
    var color = str1 !== undefined ? str1 : '#fff';
    var alpha = str2 !== undefined ? str2 : 0.5;
    return "rgba(".concat(hexToRgb(color), ", ").concat(alpha, ")");
}
function hexToRgb(hexValue) {
    var hex;
    hexValue.indexOf('#') === 0 ? hex = hexValue.substring(1) : hex = hexValue; // Expand shorthand form (e.g. "03F") to full form (e.g. "0033FF")

    var shorthandRegex = /^#?([a-f\d])([a-f\d])([a-f\d])$/i;
    var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex.replace(shorthandRegex, function (m, r, g, b) {
        return r + r + g + g + b + b;
    }));
    return result ? [parseInt(result[1], 16), parseInt(result[2], 16), parseInt(result[3], 16)] : null;
};
