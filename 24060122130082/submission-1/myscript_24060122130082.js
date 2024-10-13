function validateForm(event) {
    var x = document.forms['formProduk']['fusername'];
    var Yes = document.getElementById('wholesaleYes').checked;
    var No = document.getElementById('wholesaleNo').checked;
    var priceG = document.getElementsByName('fpriceG')[0];
    var shippingCheckboxes = document.querySelectorAll('input[name="shipping"]:checked');
    var jawabanChaptcha = document.getElementById("CaptchaAns").value;

    if (x.checkValidity() == false || (!Yes && !No)) {
        document.getElementById('errUsername').innerHTML = x.validationMessage;
        document.getElementById('errGrosir').innerHTML = 'Pilih salah satu opsi grosir.';
        return false;
    }

    if (shippingCheckboxes.length < 3) {
        alert("Jasa Pengiriman harus diisi, minimal 3 jasa kirim");
        return false;
    }

    if (jawabanChaptcha != document.getElementById("fCaptcha").value){
        alert("Jawaban captcha salah");
        return false;
    }

    return true;
}

function VsubCategory() {
    var s1 = document.getElementById("fcategory");
    var s2 = document.getElementById("fsubcategory");

    s2.innerHTML = '<option value="">--Pilih Sub Kategori--</option>';
    var optionArray = [];

    if(s1.value == "Baju"){
        optionArray = ["Baju Pria", "Baju wanita", "Baju anak"];
    }
    else if(s1.value == "Elektronik"){
        optionArray = ["Mesin Cuci", "Kulkas", "AC"];
    }
    else if(s1.value == "Alat Tulis"){
        optionArray = ["Kertas", "Map", "Pulpen"];
    }

    for(var option in optionArray){
        var pair = optionArray[option].split("|");
        var newOption  = document.createElement("option");
        newOption.value = pair[0];
        newOption.innerHTML = pair[0];
        s2.options.add(newOption);
    }
}

function hGrosir() {
    var wholesaleYes = document.getElementById('wholesaleYes').checked;
    var priceG = document.getElementsByName('fpriceG')[0];

    priceG.required = wholesaleYes;
}

function generateChapctha(){
    var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    var captcha = '';
    for (var i = 0; i < 6; i++) {
        var randomIndex = Math.floor(Math.random() * characters.length);
        captcha += characters.charAt(randomIndex);
    }
    document.getElementById("fCaptcha").value = captcha;
    document.getElementById("fCaptcha").disabled = true;
}

function resetcha(){
    document.getElementsByName("formProduk")[0].reset();
    generateChapctha();
}

window.onload = function() {
    generateChapctha();
};