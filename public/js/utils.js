// Validacion solo numeros
jQuery(".valNumber").on("input", function () {
    this.value = this.value.replace(/[^qwertyuioplkjhgfdsazxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM]/g,'');
});

// Validacion solo letras
jQuery(".valLetras").on("input", function () {
    this.value = this.value.replace(/[^qwertyuioplkjhgfdsazxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM ]/g, "");
});

// Validacion solo numero y letras
jQuery(".valNum").on("input", function () {
    this.value = this.value.replace(/[^1234567890]/g, "");
});

jQuery(".precioUnitario").on("input", function () {
    this.value = this.value * 100;
    console.log(this.value);
});