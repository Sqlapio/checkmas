// Validacion solo numeros
jQuery(".valNumber").on("input", function () {
    this.value = this.value.replace(/^([0-9]+\.?[0-9]{0,2})$/g, "");
});

// Validacion solo letras
jQuery(".valLetras").on("input", function () {
    this.value = this.value.replace(/[^qwertyuioplkjhgfdsazxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM ]/g, "");
});

// Validacion solo numero y letras
jQuery(".valNumLetras").on("input", function () {
    this.value = this.value.replace(/[^qwertyuioplkjhgfdsazxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM1234567890]/g, "");
});

jQuery(".precioUnitario").on("input", function () {
    this.value = this.value * 100;
    console.log(this.value);
});

function mostrar(num) {
    var x = $("#num").val();
    alert(x);
}