$(document).ready(function (e) {
    $("#enter").click(function (e) {
        var vLogin = $("#login").val(), vPassword = $("#password").val();
        
        if (vLogin.length === 0) {
            alert("Atenção\nO campo de Login está vazio");
            $("#login").focus();
        } else if (vPassword.length === 0) {
            alert("Atenção\nO campo de Senha está vazio");
            $("#password").focus();
        } else {
            $.post("/MinhaCreche/code/user.php", {login: vLogin, senha: vPassword}, function (retorno) {
                if (retorno) {
                    alert("Passou Miseraverl");
                } else {
                     $("#login").focus();
                    $("#erro").show();
				}
            });
        }
    });
});