
$(function() {
    var nombre = $("#nombre"),
            apellido = $("#apellido"),
            email = $("#email"),
            confirmaremail = $("#confirmaremail"),
            contrasena = $("#contrasena"),
            confirmarcontrasena = $("#confirmarcontrasena"),
            allFields = $([]).add(nombre).add(apellido).add(email).add(confirmaremail).add(contrasena).add(confirmarcontrasena),
            tips = $(".validateTips");
    function updateTips(t) {
        tips
                .text(t)
                .addClass("ui-state-highlight");
        setTimeout(function() {
            tips.removeClass("ui-state-highlight", 1500);
        }, 500);
    }
    function checkLength(o, n, min, max) {
        if (o.val().length > max || o.val().length < min) {
            o.addClass("ui-state-error");
            updateTips("Length of " + n + " must be between " + min + " and " + max + ".");
            return false;
        } else {
            return true;
        }
    }
    function checkRegexp(o, regexp, n) {
        if (!(regexp.test(o.val()))) {
            o.addClass("ui-state-error");
            updateTips(n);
            return false;
        } else {
            return true;
        }
    }
    $("#dialog-form").dialog({
        autoOpen: false,
        height: 400,
        width: 550,
        modal: true,
        buttons: {
            "Registrarme": function() {
                var bValid = true;
                allFields.removeClass("ui-state-error");
                bValid = bValid && checkLength(nombre, "nombre", 10, 100);
                bValid = bValid && checkLength(apellido, "apellido", 10, 100);
                bValid = bValid && checkLength(email, "email", 10, 100);
                bValid = bValid && checkLength(confirmaremail, "confirmaremail", 8, 20);
                bValid = bValid && checkLength(contrasena, "constrasena", 8, 20);
                if (bValid) {
                    $("#formRegistroUsuario").submit();
                    $(this).dialog("close");
                }
            },
            Cancel: function() {
                $(this).dialog("close");
            }
        },
        close: function() {
            allFields.val("").removeClass("ui-state-error");
        }
    });
    $("#create-user").click(function() {
        $("#dialog-form").dialog("open");
    });
});
    