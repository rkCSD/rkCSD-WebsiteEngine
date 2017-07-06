<script>
    function validatePrompt(data) {
        var str = data.toString().replace(/ /g, '');
        if (str.length > 0) return false;
        else return true;
    }

    //$('#contactform').submit(
    function sendMail(){
        $('#msg').html('Nachricht wird gesendet...');
        var email = $('#email').val();
        var name = $('#name').val();
        var message = $('#message').val();
        var captcha = $('#g-recaptcha-response').val();
        $('#submit').prop('disabled',true);

        if (validatePrompt(name)) {
            $('#msg').html('Bitte geben Sie Ihren Namen an.');
            $('#name').focus();
            $('#submit').prop('disabled', false);

            return false;
        } else if (validatePrompt(email)) {
            $('#email').focus();
            $('#msg').html('Bitte geben Sie eine E-Mail-Adresse an.');
            $('#submit').prop('disabled', false);

            return false;
        } else if (validatePrompt(message)) {
            $('#message').focus();
            $('#msg').html('Bitte hinterlassen Sie uns eine Nachricht.');
            $('#submit').prop('disabled', false);

            return false;
        }

        $.ajax({
            type: 'POST',
            url: '{$basepath}apps/Contact/sendmail.php',
            async: true,
            data: {
                email: email,
                name: name,
                message: message,
                'g-recaptcha-response': captcha
            },
            timeout: 60000,
            success: function(data) {
                console.log(data);
                //Captcha
                if (data === 'true') {
                    $('#msg').html('Vielen Dank für ihre Nachricht. <br/>Wir werden uns so schnell wie möglich mit Ihnen in Verbindung setzen.');
                    $('#submit').prop('disabled', true);
                } else if (data === 'Captcha') {
                    $('#msg').html('<span style="color: red;">Das Captcha ist falsch. Bitte erneut ausfüllen.</span>');
                    $('#submit').prop('disabled', false);
                } else if (data === 'mail') {
                    $('#msg').html('<span style="color: red;">Die Emailadresse ist ungültig. Bitte gültige Email-Adresse eingeben und erneut versuchen.</span>');
                    $('#submit').prop('disabled', false);
                } else {
                    $('#msg').html('<span style="color: red;">Entschuldigung, da lief etwas schief... <br/>Leider konnten wir Ihre Anfrage nicht verarbeiten.</span>');
                    $('#submit').prop('disabled', false);
                }
            }
        });
    }
</script>
<script src='https://www.google.com/recaptcha/api.js'></script>