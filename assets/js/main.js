(function($) {
    "use strict";

    /*==================================================================
    [ Validate ]*/
    var input = $('.validate-input .input100');

    $('.validate-form').on('submit', function(e) {
        var value = input.val();
        // console.log(value);

        //1 -we send a req to the server (php script) to validate the api key and then we get the response if validated or no 
        //2- if the API Key is no valid we show the error 
        //3- if it is valid we redirect the user to a page where he can see all the subscribers ...
        //4- while the req of validating the key is processing -> show a loading spinner (user exp);

        //1- we use jquery ajax 
        console.log("submitted");
        e.preventDefault();
        $.ajax({
            // url: '/classes/validateApiKey.php',
            url: '/processing_scripts/process.php',

            type: 'post',
            // dataType: 'json',
            data: {
                key: value,
            },
            success: function(data) {

                data = data.trim();
                // console.log(data);


                if (data == "invalid") {
                    var msg = "Your API-Key is Unauthorized, please provide a valid key";
                    vt.warn(msg, {
                        title: "API-Key Unauthorized",
                        duration: 6000,
                        closable: true,
                        focusable: true,
                        callback: () => {
                            console.log("completed");
                        }
                    });


                } else {
                    //disable submit button;

                    var msg = "Your API-Key is valid, you will be redirected to the management page!";
                    vt.success(msg, {
                        title: "API-Key Authorized",
                        duration: 1000,
                        closable: true,
                        focusable: true,
                        callback: () => {
                            //redirect to the management page!
                            console.log("redirect...");
                            location.replace("/pages/subscribersManager.php");

                        }
                    });
                }


            }


        })





    });



    $('.validate-form .input100').each(function() {
        $(this).focus(function() {
            hideValidate(this);
        });
    });



    function showValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).addClass('alert-validate');
    }

    function hideValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).removeClass('alert-validate');
    }



    /*==================================================================
     [ Simple slide100 ]*/

    $('.simpleslide100').each(function() {
        var delay = 7000;
        var speed = 1000;
        var itemSlide = $(this).find('.simpleslide100-item');
        var nowSlide = 0;

        $(itemSlide).hide();
        $(itemSlide[nowSlide]).show();
        nowSlide++;
        if (nowSlide >= itemSlide.length) { nowSlide = 0; }

        setInterval(function() {
            $(itemSlide).fadeOut(speed);
            $(itemSlide[nowSlide]).fadeIn(speed);
            nowSlide++;
            if (nowSlide >= itemSlide.length) { nowSlide = 0; }
        }, delay);
    });


})(jQuery);