function confirmar(texto) {
    var conf = window.confirm(texto + "?");
    if (conf)
        return true;
    else
        return false;
}
