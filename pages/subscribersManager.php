<?php
require_once '../bootstrap.php';

require_once "../function/inc_with_var.php";

use \App\DB;

$db=DB::getInstance();

$count=$db->get('ApiKey','valid_api_key')->count();
if ($count==0) {//=1
    header("location:/");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   
        <!-- includes:includes/_styles.files.php -->
    
        <?php includeWithVariables('../includes/_styles.files.php', array('title' => 'Subscribers Manager ','favicon'=>'../assets/images/icons/favicon.ico'));;?>  

        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
  
      

    <style>
        
        
        .dataTables_filter label{
            display: flex ;
            align-items: center;

        }
        /*navbar*/
        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            /* background-color: white; */
            /* position: fixed; */
            top: 0;
            right:0;
            width: 100%;
            z-index:10000000000;

            display: flex;
            justify-content: space-evenly;
            padding : 14px 16px;
            
            }

          

            li a {
            display: block;
            color: black;
            text-align: center;
            padding: 6px 8px; 
            text-decoration: none;
            font-weight:bold;
            /* border-bottom : 1px solid black; */
            }

            li a:hover {
            background-color: #00b4d8;
            color : white;
            }


   
          
     
           /**invalid feedback */
           .invalid_back {
                display:none;
                margin-top: 0.25rem;
                font-size: 80%;
                color: #dc3545;
                margin-bottom: 0.30rem;
                font-weight: bold;
             }
             /* //wrapper */
              .wrapper_{
                
                transform: translate(-0%, 20%);

             } 
      
    </style>
</head>

<body>
    <!--  -->
    <div class="simpleslide100">
        <div class="simpleslide100-item bg-img1" style="background-image: url('/assets/images/bg01.jpg')"></div>
        <div class="simpleslide100-item bg-img1" style="background-image: url('/assets/images/bg02.jpg')"></div>
        <div class="simpleslide100-item bg-img1" style="background-image: url('/assets/images/bg03.jpg')"></div>
    </div>

    <div class="size1 overlay1">
        <!--  -->
        <div class="flex-col flex-c wrapper_">

        
                 <div class="container pos-relative">

                    <ul class=''>

                        <li><a href='#' class='flex-c-m size3 s2-txt3 how-btn1 trans-04 where1' id="btn-pop_up" >Add New Subscriber</a></li>
                        <li><a  href='#'class='flex-c-m size3 s2-txt3 how-btn1 trans-04 where1' id='btn_change_account' >Change the Account</a></li>
                    </ul>
                </div>
      
                <div class="container bgwhite compact row-border p-t-20 p-b-20 div-center">
                    <table id="table_id" class="display">
                        <thead class='color-black'>
                            <tr>
                                <th>Email</th>
                                <th>Name</th>
                                <th>Country</th>
                                <th>subscribe date</th>
                                <th>subscribe time</th>
                                <th>delete</th>


                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            
                            </tr>
                            <tr>
                        
                            </tr>
                        </tbody>
                    </table>
                </div>
        </div>
       
        <div class="loader" id="loader"></div>
    </div>
        <!-- includes:includes/_popup_form.php -->
    
        <?php include('../includes/_popup_form.php');;?>  

      


    <script src="/assets/vendor_js/jquery/jquery-3.2.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="/assets/vendor_js/bootstrap/js/bootstrap.min.js"></script>

    <script src="/assets/vendor_js/vanilla-toast.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dompurify/2.2.7/purify.min.js"></script>


    <script src="/assets/js/main.js"></script>

    <script>
       $(document).ready(function () {
            // var data = {subscribers : 1};

            //datatable - side_server_processing
            var table =$('#table_id').DataTable({
                select: true,
                // scrollX: true,

                lengthMenu: [5, 10, 20, 50, 100, 200, 500],
                processing: true,
                serverSide: true,
                ajax: {
                    url: "/processing_scripts/process_.php",
                    // data:{ke:"k"}
               
                },
                "columnDefs": [
                    { className: "email_class", "targets": [ 0 ] },
                    { className: "delete", "targets": [ 5 ] },
                    { orderable: false, targets: [1,2,3,4,5] }


                ],
                "initComplete": function (settings, json) {  //scrollX has misalignement problem
                    $("#table_id").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");            
                },
              
            
            
            
            });
            
            //search by email
            $('input[type=search]').on( 'keyup', function () {
                table
                    .columns( 0 ) //search by email
                    .search( this.value )
                    .draw();
            } );
            $(document).ajaxStart(function() {
                $("#loader").show();
            });
            $(document).ajaxComplete(function() {
                $("#loader").hide();
            });
            $(document).ajaxError(function() {
                $("#loader").hide();
            });

            //showing the pop up for adding new subscriber and editing an existing subscriber;
            var popupParent = document.querySelector(".popup-parent");

            let btn = document.getElementById("btn-pop_up");
            let btn_cancel = document.getElementById("cancel");
            let btnClose = document.querySelector(".close");

            //adding new subscriber
            btn.addEventListener("click", showPopup_new);
            function showPopup_new() {
                    
                    $("#email").prop("disabled", false);
                 

                    //swtitch buttons
                    $("#submit_add").css("display","");
                    $("#submit_edit").css("display","none");


                    //empty
                    $("#email").val("");
                    $("#name").val("");
                    $("#country").val("");
                

                      popupParent.style.display = "block";
            }
            btnClose.addEventListener("click", closePopup);
              btn_cancel.addEventListener("click", closePopup);

              function closePopup() {
                popupParent.style.display = "none";
              }
              popupParent.addEventListener("click", closeOutPopup);
              function closeOutPopup(o) {
                if (o.target.className == "popup-parent") {
                  popupParent.style.display = "none";
                }
              }


              //editing an existing subscrieber
              $('table').on('click', 'td.email_class', display_edit); //email is the table element with class email_class
                //edit a ticket
                function display_edit(e){
                    $("#submit_add").css("display","none");
                    $("#submit_edit").css("display","");

                    // console.log($(this).siblings()[1]);
                    $("#email").val($(this)[0].innerText);
                    $("#email").attr("disabled","disabled");

                    $("#name").val($(this).siblings()[0].innerText);

                    $("#country").val($(this).siblings()[1].innerText);

                        popupParent.style.display = "block";
                }


                //the invalid feedback
                    //on change of the pop up forms fields we hid the incalid feedback;
                $("#email").keyup((e)=>{
                    var $this = $(e.currentTarget);
                    // console.log($this.next(".invalid_back"));
                    $(".invalid_back").css("display","none");

                }) 
                $("#name").keyup((e)=>{
                    var $this = $(e.currentTarget);
                    // console.log($this.next(".invalid_back"));
                    $(".invalid_back").css("display","none");

                }) 
                $("#country").keyup((e)=>{
                    var $this = $(e.currentTarget);
                    // console.log($this.next(".invalid_back"));
                    $(".invalid_back").css("display","none");

                })




              //
              $('#submit_add').on('click',handler_add);
              $('#submit_edit').on('click',handler_edit);


            function handler_add(e){
                e.preventDefault();
                //getting data
                var email= $("#email").val();
                var name= $("#name").val();
                var country= $("#country").val();
                // var date= $("#date").val();
          

        


                
        

       


      


      
                        // console.log("ok");
                            //sanitize
                            email=DOMPurify.sanitize(email, {SAFE_FOR_JQUERY: true});
                            name=DOMPurify.sanitize(name, {SAFE_FOR_JQUERY: true});
                            country=DOMPurify.sanitize(country, {SAFE_FOR_JQUERY: true});
                           

                            


                            

                            var data ={
                                email,
                                name,
                                country,
                                 

                                      }

              

                        $.ajax({
                                    url: '/processing_scripts/process.php',
                                
                                    type: 'post',
                                    

                                    data:data  ,
                        
                                  
                                    success : function(data){
                                        // var num = data.indexOf("<!DOCTYPE html>");
                                        // var rese = data.substr(0, num);
                                        // console.log(data);
                                        data = data.trim();

                                        if(data=="created"){
                                        
                                            //relaod datatable;
                                      

                                            table.ajax.reload();





                                          popupParent.style.display = "none";
                                          vt.success("The new Subscriber has been added successfully!",{
                                              title: "Added",
                                              duration: 6000,
                                              closable: true,
                                              focusable: true,
                                              callback: ()=>{
                                                console.log("completed");
                                              }
                                            });
                                        }else{
                                            $('.invalid_back').text("* "+data);

                                            $('.invalid_back').css("display","block");
                                        }


                                    }

                                   
                            })
     


                           

            }
            function handler_edit(e){
                e.preventDefault();
                //getting data
                var email_edit= $("#email").val();
                var name= $("#name").val();
                var country= $("#country").val();
                // var date= $("#date").val();
          

        


                
        

       


      


      
                        // console.log("ok");
                            //sanitize
                            email_edit=DOMPurify.sanitize(email_edit, {SAFE_FOR_JQUERY: true}); //no need for doing to the email as it is disabled
                            name=DOMPurify.sanitize(name, {SAFE_FOR_JQUERY: true});
                            country=DOMPurify.sanitize(country, {SAFE_FOR_JQUERY: true});
                           

                            


                            

                            var data ={
                                email_edit,
                                name,
                                country,
                                 

                                      }

              

                        $.ajax({
                                    url: '/processing_scripts/process.php',
                                
                                    type: 'post',
                                    

                                    data:data  ,
                        
                                  
                                    success : function(data){
                                        // var num = data.indexOf("<!DOCTYPE html>");
                                        // var rese = data.substr(0, num);
                                        // console.log(data);
                                        data = data.trim();

                                        if(data=="updated"){
                                        
                                            //relaod datatable;
                                      

                                            table.ajax.reload();





                                          popupParent.style.display = "none";
                                          vt.success("The Subscriber information has been updated successfully!",{
                                              title: "Updated",
                                              duration: 6000,
                                              closable: true,
                                              focusable: true,
                                              callback: ()=>{
                                                console.log("completed");
                                              }
                                            });
                                        }else{
                                            $('.invalid_back').text("* "+data);

                                            $('.invalid_back').css("display","block");
                                        }


                                    }

                                   
                        })
     


                           

            }


            //delete a subscriber
            $('table').on('click', 'td.delete', delete_subcriber); 
                function delete_subcriber(e){
                    let email_delete=$(this)[0].firstElementChild.getAttribute("data-email");
                    var data ={email_delete};

                    $.ajax({
                                    url: '/processing_scripts/process.php',
                                
                                    type: 'post',
                                    

                                    data:data  ,
                        
                                  
                                    success : function(data){
                                        // var num = data.indexOf("<!DOCTYPE html>");
                                        // var rese = data.substr(0, num);
                                        // console.log(data);
                                        data = data.trim();

                                        if(data=="deleted"){
                                        
                                            //relaod datatable;
                                      

                                            table.ajax.reload();





                                          popupParent.style.display = "none";
                                        }


                                    }

                                   
                    })

                  
                }



                //change account logic
                

            let btn2 = document.getElementById("btn_change_account");
         

            //adding new subscriber
            btn2.addEventListener("click", change_account);
            function change_account() {
                   //send an ajax request to change the mail and then redirect to the home page (index page)
                   var data = {change_account:true};
                   $.ajax({
                                    url: '/processing_scripts/process.php',
                                
                                    type: 'post',
                                    

                                    data:data  ,
                        
                                  
                                    success : function(data){
                                        // var num = data.indexOf("<!DOCTYPE html>");
                                        // var rese = data.substr(0, num);
                                        // console.log(data);
                                        data = data.trim();

                                        if(data=="success"){
                                        
                                            //relaod datatable;
                                            location.replace("/");

                                        
                                        }


                                    }

                                   
                    })

            }
           


                      
            

        });
    </script>


  
</body>

</html>