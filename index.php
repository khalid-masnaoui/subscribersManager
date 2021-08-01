<?php
require_once "bootstrap.php";

require_once "function/inc_with_var.php";

use \App\DB;


$db=DB::getInstance();

$count=$db->get('ApiKey','valid_api_key')->count();
if($count>0){//=1
    header("location:/pages/subscribersManager.php");
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
   
        <!-- includes:includes/_styles.files.php -->
    
        <?php includeWithVariables('includes/_styles.files.php', array('title' => 'Subscribers Manager ','favicon'=>'assets/images/icons/favicon.ico'));;?>  
      

    <style>
        .loader {
            position: absolute;
            z-index: 100000;
            left: 49%;
            transform: translateX(-50%);
            transform: translateY(-50%);
            top: 15%;
            height: 60px;
            width: 60px;
            margin: 0px auto;
            -webkit-animation: rotation 0.6s infinite linear;
            -moz-animation: rotation 0.6s infinite linear;
            -o-animation: rotation 0.6s infinite linear;
            animation: rotation 0.6s infinite linear;
            border-left: 6px solid rgba(0, 174, 239, 0.15);
            border-right: 6px solid rgba(0, 174, 239, 0.15);
            border-bottom: 6px solid rgba(0, 174, 239, 0.15);
            border-top: 6px solid rgba(0, 174, 239, 0.8);
            border-radius: 100%;
            display: none;
        }
        
        @-webkit-keyframes rotation {
            from {
                -webkit-transform: rotate(0deg);
            }
            to {
                -webkit-transform: rotate(359deg);
            }
        }
        
        @-moz-keyframes rotation {
            from {
                -moz-transform: rotate(0deg);
            }
            to {
                -moz-transform: rotate(359deg);
            }
        }
        
        @-o-keyframes rotation {
            from {
                -o-transform: rotate(0deg);
            }
            to {
                -o-transform: rotate(359deg);
            }
        }
        
        @keyframes rotation {
            from {
                transform: rotate(0deg);
            }
            to {
                transform: rotate(359deg);
            }
        }
    </style>
</head>

<body>
    <!--  -->
    <div class="simpleslide100">
        <div class="simpleslide100-item bg-img1" style="background-image: url('assets/images/bg01.jpg')"></div>
        <div class="simpleslide100-item bg-img1" style="background-image: url('assets/images/bg02.jpg')"></div>
        <div class="simpleslide100-item bg-img1" style="background-image: url('assets/images/bg03.jpg')"></div>
    </div>

    <div class="size1 overlay1">
        <!--  -->
        <div class="size1 flex-col-c-m p-l-15 p-r-15 p-t-50 p-b-50">
            <h3 class="l1-txt1 txt-center p-b-25">Subscribers Manager</h3>

            <p class="m2-txt1 txt-center p-b-48">
                Manage your MailLite account's subscribers easily
            </p>

            <form class="w-full flex-w flex-c-m validate-form">
                <div class="wrap-input100 validate-input where1" data-validate="Invalid API Key">
                    <input class="input100 placeholder0 s2-txt2" type="text" name="email" placeholder="Enter Your MailLIte API Key" />
                    <span class="focus-input100"></span>
                </div>

                <button class="flex-c-m size3 s2-txt3 how-btn1 trans-04 where1">
            Submit MailLite API KEY
          </button>
            </form>
        </div>
        <div class="loader" id="loader"></div>
    </div>




    <script src="assets/vendor_js/jquery/jquery-3.2.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="assets/vendor_js/bootstrap/js/bootstrap.min.js"></script>

    <script src="assets/vendor_js/vanilla-toast.min.js"></script>

    <script src="assets/js/main.js"></script>

    <script>
        (function($) {
            // $("#loader").hide();

            $(document).ajaxStart(function() {
                $("#loader").show();
            });
            $(document).ajaxComplete(function() {
                $("#loader").hide();
            });
            $(document).ajaxError(function() {
                $("#loader").hide();
            });
        })(jQuery);
    </script>


  
</body>

</html>