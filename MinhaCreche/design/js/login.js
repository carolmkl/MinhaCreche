$(document).ready(function (e) {
    $("#enter").click(function (e) {
        var vLogin = $("#login").val(), vPassword = $("#password").val();
        
            $.post("../code/login.php", {login: vLogin, senha: vPassword}, function (retorno) {
                alert(retorno);
                if (retorno == 1) {
                    window.location.replace("home.php")
                } else {
                     $("#login").focus();
                    $("#erro").show();
				}
            });
    });
});