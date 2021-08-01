    
    
    <title><?php echo $title;?></title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="<?php echo $favicon;?>" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/assets/vendor_js/bootstrap/css/bootstrap.min.css" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/assets/css/util.css" />
    <link rel="stylesheet" type="text/css" href="/assets/css/main.css" />
    <!--===============================================================================================-->


    <style>
        .loader {
            position: absolute;
            z-index: 99999999999999999999;
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