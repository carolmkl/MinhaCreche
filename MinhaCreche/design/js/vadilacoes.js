function validaNome(texto) {
    var teste = /^[A-Za-z0-9 ]{3,}$/;
    return teste.test(texto);
}

function validaEstado(texto) {
    var teste = /^[A-Za-z0-9 ]{2,}$/;
    return teste.test(texto);
}

function validaCpf(texto) {
    var teste = /^[0-9]{11}$/;
    return teste.test(texto);
}

function validaRg(texto) {
    var teste = /^[A-Za-z0-9]{7}$/;
    return teste.test(texto);
}

function validaEmail(texto) {
    var teste = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    return teste.test(texto);
}

function validaTelefone(texto) {
    var teste = /^\([1-9]{2}\)\s[0-9]{8,9}$/;
    return teste.test(texto);
}

function validaNumero(texto) {
    var teste = /^[0-9]{1,}$/;
    return teste.test(texto);
}

function validaLogin(texto) {
    var teste = /^\w{3,20}$/;
    return teste.test(texto);
}

function validaSenha(texto) {
    var teste = /^[A-Za-z0-9!@#$%^&*()_]{6,20}$/;
    return teste.test(texto);
}