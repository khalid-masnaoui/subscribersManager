   
    <style>

                 /*pop up*/
                 .popup-parent {
              position: fixed;
              top: 0;
              left: 0;
              height: 100vh;
              width: 100%;
              display: none;
              z-index:1;
          }
          
          .popup {
              background: #fff;
              border-radius: 5px;
              padding: 40px 20px;
              width: 50%;
              position: relative;
              top: 50%;
              left: 50%;
              transform: translate(-50%, -50%);
              animation: 0.9s drop;
          }
          
          @keyframes drop {
              0% {
                  top: -100px;
              }
              100% {
                  top: 50%;
              }
          }
          
          .popup h1 {
              font-size: 30px;
              letter-spacing: -2.5px;
          }
          
          .popup p {
              font-size: 15px;
              margin-top: 15px;
          }
          /* Close icon */
          
          .close {
              position: absolute;
              right: 20px;
              top: 10px;
              font-size: 40px;
              background: none;
              border: none;
              cursor: pointer;
          }
       
          .parent > *:last-child {
            width: 30px;
          }
    
     
          td.delete,td.email_class{
            cursor:grab;

          }
          /* //media */
          @media only screen and (max-width: 725px) {
            .popup {
              width: 80%;
            }
          }
          @media only screen and (max-width: 465px) {
            .popup {
              width: 98%;
            }
          }
    </style>
    <!-- Pop-up box -->
    <div class="popup-parent">
                    <div class="popup">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title" style='font-weight:bold;'>Add a New Subcriber Form</h4>
                                    <hr size="" width="60%" color="">  
                                    <!-- <p class="card-description">General Informations</p> -->
                                    <form method="post" class="form" id="subcriberForm"  enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="email"  style='font-weight:bold;color:black;'>Email</label>
                                            <input type="text" class="form-control" id="email" placeholder="Enter the subcriber's email..." />
                                         
                                        </div>       
                                        <div class="form-group">
                                            <label for="name"  style='font-weight:bold;color:black;'>Name</label>
                                            <input type="text" class="form-control" id="name" placeholder="Enter the subcriber's name ..." />
                                        </div>    
                                        <div class="form-group">
                                            <label for="country"  style='font-weight:bold;color:black;'>Country</label>
                                            <input type="text" class="form-control" id="country" placeholder="Enter the subcriber's country..." />
                                        </div>       
                                           
                                         <div class="form-group fullwidth d-none">
                                            <label for="date">Report Date</label>
                                            <!-- <input type="date" class="form-control" id="date" data-date="" data-date-format="yyyy-mm-dd H:i:s" value=""; ?>> -->
                                            <input type="date" name="date" class="form-control" id="date" value="<?php echo date('d-m-Y H:i:s'); ?>"  />

                                           
                                          
                                        </div>    
                                    

                                        <div class="invalid_back" >
                                              
                                        </div>
   

                                  </form>
                                 
                     
                                        <button type="submit" id="submit_add" form="subcriberForm" class="btn btn-gradient-primary mr-2" style='font-weight:bold;color:black;'>
                                          Submit
                                        </button>
                                            <button type="submit" id="submit_edit" form="subcriberForm" class="btn btn-gradient-primary mr-2"  style="display:none;font-weight:bold;color:black;">
                                              Edit
                                            </button>
                                        <button class="btn btn-light" id="cancel" style='font-weight:bold;color:black;'>Cancel</button>
                                </div>
                            </div>
                        </div>
                        <button class="close" draggable="true">&times;</button>
                    </div>
    </div>