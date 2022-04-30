$(document).ready(function(){  
            // $("#registerUser").validate({
            //     rules: {
            //         fname: {
            //             required: true,
            //             minlength:3,
            //             maxlength:50,
            //             alpha:true,
            //         },
            //         lname: {
            //             required: true,
            //             minlength:3,
            //             maxlength:50,
            //             alpha:true,
            //         },
            //         email: {
            //             required: true,
            //             minlength:3,
            //             maxlength:50
            //         },
            //         contact: {
            //             required: true,
            //             minlength:10,
            //             maxlength:10,
            //             number:true
            //         },
            //         password: {
            //             required: true,
            //             minlength:3,
            //             maxlength:50
            //         },
            //         cpassword: {
            //             required: true,
            //             minlength:3,
            //             maxlength:50,
            //             equalTo : "#password"
            //         },
            //         // faceboolUrl: {
            //         //     required: true,
            //         // },
            //         // twitterUrl: {
            //         //     required: true,
            //         // },
            //         // instagramUrl: {
            //         //     required: true,
            //         // },
            //         // linkedinUrl: {
            //         //     required: true,
            //         // }
            //     },
            //     messages: {
            //       fname:{
            //         required: "Please enter first name",
            //         alpha: "only alphabets are allowed"
            //     },
            //     lname:{
            //       required: "Please enter last name",
            //       alpha: "only alphabets are allowed"
            //   },
            //         email: "Enter valid email",
            //         contact: "Enter valid contact number",
            //         password: "Enter valid password",
            //         cpassword: "Password should be match",
            //         faceboolUrl: "Enter Valid Name",
            //         twitterUrl: "Enter Valid Name",
            //         instagramUrl: "Enter Valid Name",
            //         linkedinUrl: "Enter Valid Name",
            //       }
            // })
            $('#profilePic').slim({ratio: '1:1',
            minSize: {
                width: 250,
                height: 250,
            },
            size: {
                width: 250,
                height: 250,
            },
            ratio:"1:1",
            push:true,
            rotateButton:true,
            service: base_url+'student/Myaccount/SetprofilePic',
            download: false,
            willSave: function(data, ready) {
                //alert('saving!');
                ready(data);
            },
            didUpload:function(error, data, response){
              $(".overlap").css("display","block");
            },
            willTransform:function(data, ready){
              ready(data);
            },
            willRemove :function(data,remove)
            {
                remove();
            },
            label: 'Click here to add new image or Drop your image here.',
            buttonConfirmLabel: 'Ok',
            meta: {
                //memberID:memberID
            }});


            $("#login").validate({
              rules: {
                  userEmail: {
                      required: true
                  },
                  userPass: {
                      required: true,
                      minlength:3,
                      maxlength:50
                  },
                  
              },
              messages: {
                  userEmail: "Please Enter Your Email / Mobile Number.",
                  userPass: "Please Enter Your Password.",  
                }
          })

         
          $("#memberDetail").validate({
            rules: {
              contact: {
                    required: true,
                },
            },
            messages: {
              required: "Please provide a contact number",
            }
        })

        
     
            // return
        $(".userNav").on("click",function(){
            
            // $("#form1").valid();
            var type = $(this).attr("data-act");
            var ur = $(this).attr("data-url");
            if(type == "url"){
                window.location.href=ur;
            }else{
                $(".process-section").hide();
                $("."+ur).show();
            }
            $(".header-register .count").html('<span>1</span> of 2 ');
        });
        
      $(document).ready( function () {
        if(typeof(DataTable) === "function"){
          $('#mentorList').DataTable();
        }
        //$('#example').DataTable();
    });
      
        $(document).ready( function () {
          if(typeof(DataTable) === "function"){
            $('#example').DataTable();
          }
          //$('#example').DataTable();
      } );
      
      $(document).ready( function () {
        if(typeof(DataTable) === "function"){
          $('#approvetable').DataTable();
        }
        //$('#example').DataTable();
    } );
    $(document).ready( function () {
      if(typeof(DataTable) === "function"){
        $('#rejecttable').DataTable();
      }
      //$('#example').DataTable();
  } );
  
  $(document).ready( function () {
    if(typeof(DataTable) === "function"){
      $('#holdtable').DataTable();
    }
    //$('#example').DataTable();
} );
$(document).ready( function () {
  if(typeof(DataTable) === "function"){
    $('#phasetwoexample').DataTable();
  }
  //$('#example').DataTable();
} );
$(document).ready( function () {
  if(typeof(DataTable) === "function"){
    $('#phasetwoapprovetable').DataTable();
  }
  //$('#example').DataTable();
} );
$(document).ready( function () {
  if(typeof(DataTable) === "function"){
    $('#phasetworejecttable').DataTable();
  }
  //$('#example').DataTable();
} );
$(document).ready( function () {
  if(typeof(DataTable) === "function"){
    $('#phasetwoholdtable').DataTable();
  }
  //$('#example').DataTable();
} );
$(document).ready( function () {
  if(typeof(DataTable) === "function"){
    $('#top100table').DataTable();
  }
  //$('#example').DataTable();
} );
$(document).ready( function () {
  if(typeof(DataTable) === "function"){
    $('#fiftytable').DataTable();
  }
  //$('#example').DataTable();
} );
$(document).ready( function () {
  if(typeof(DataTable) === "function"){
    $('#betweenhun').DataTable();
  }
  //$('#example').DataTable();
} );
$(document).ready( function () {
  if(typeof(DataTable) === "function"){
    $('#bottom50').DataTable();
    $('#finalistsData').DataTable();
  }
  //$('#example').DataTable();
} );
      $(document).ready(function(){


        var response = [];
        $.ajax({
            type: "GET",
            url:  base_url+"getcontactno",
            async: false,
            success: function(text) {
              response = JSON.parse(text);
              //responseName = JSON.parse(text);
              //console.log(typeof response);
            }
        });

        //alert(response);
        //alert(responseName);

        var bh = new Bloodhound({
         local: response,
        //  remote:{
        //    url:base_url+"getcontactno",
        //  }
        //  identify: function(obj) { return obj.phoneNumber; },
         queryTokenizer: Bloodhound.tokenizers.whitespace,
         datumTokenizer: Bloodhound.tokenizers.whitespace
     });
     $('.typeahead').typeahead({
       minLength: 1,
       highlight: true
     },
     {
       name: 'my-dataset',
       source: bh.ttAdapter()
     });
     });
    //  let dynamicId = '';
    //  let dynamicVal = '';
     
        $("#login").submit(function(e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var form = $(this);
            var url = form.attr('action');
            var isvalid = $("#login").valid();
            if(isvalid){
              $.ajax({
                 type: "POST",
                 url: url,
                 data: form.serialize(), // serializes the form's elements.
                 datatype:'JSON',
                 beforeSend: function(request) {
                  $("#loginSubmit").html("Verifying..");
                },
                success:function(res){
                  res = JSON.parse(res);
                  if(res.flag == "F")
                  {
                    var msg = alertify.error('Default message');
                    msg.delay(3).setContent(res.msg);
                    $('#password').focus();
                  }

                  if(res.flag == "V")
                  {
                    var msg = alertify.error('Default message');
                    msg.delay(3).setContent(res.msg);
                    msg.ondismiss = function(){  window.location.replace(res.redirect);  };
                  }

                  if(res.flag == "S"){
                    window.location.replace(res.redirect);

                  }
                  setTimeout(function(){
                    $("#loginSubmit").html("Login");
                  }, 1000);
                  
                }
               });
              }
          });
        let incubateId = '';
        let incubateVal = '';
        let juryID='';
        let juryVideo='';
        let juryVideoURL='';
        
        $('.actionBtn').on('click', function () {
          incubateId = $(this).attr('data-id');
          incubateVal = $(this).attr('data-value');
            //alert(incubateId);
        })
        $('.juryaction').on('click', function () {
          //alert("hiiiii");
          juryID = $(this).attr('data-id');
          juryVideo = $(this).attr('data-value');
          juryVideoURL = $(this).attr('data-url');
          let url = base_url+"images/studentFiles/"+juryID+"/"+juryVideo;
          var video = document.getElementById('v1');
          var sources = video.getElementsByTagName('source');
          sources[0].src = url;
          video.load();
        })

        $(".yesTop100").click(function(){
          shareWithIncubation();
        })

        $("#incuUpdatePassword").validate({
          rules: {
            userPass: {
                  required: true,
                  pwcheck:true,
              },
              cpassword: {
                  required: true,
                  equalTo: "#userPass"
              },
              incuNDA:{
                required: true,
              }
          },
          messages: {
            userPass: {
              required: "Please Enter Your Password.",
              pwcheck:"Enter at least one uppercase, one lowercase, one number, and one special character",
            },
              cpassword:{
                required:"Please Enter Your Password.",
                equalTo:"Please enter the same password as above",
              },  
              incuNDA:"Please Check The Non-Disclosure Agreement"
            }
      })
       
      $("#incuUpdatePassword").submit(function(e){
        e.preventDefault();
            var form = $(this);
            var url = form.attr('action');    
            $.ajax({
               type: "POST",
               url: url,
               data: form.serialize(), // serializes the form's elements.
               datatype:'JSON',
               
              success:function(res){
                  res = JSON.parse(res);
                if(res.flag == "F")
               {
                var msg = alertify.error('Default message');
                msg.delay(3).setContent(res.msg);
                //  window.location.replace(res.redirect);
                // $('#password').focus();
                
               }                 
                  //$('#userEmail').focus();
                if(res.flag == "S"){
                  var msg = alertify.success('Default message');
                  msg.delay(3).setContent(res.msg);
                  msg.ondismiss = function(){  window.location.replace(res.redirect);  };
                      //alertify.success(res.msg);
                    //window.location.replace(res.redirect);
        
                }
              
                
              }
             });
      })
        // $(".incubate").click(function(e){
        //   e.preventDefault();
        //   $("#incubate").addClass("d-none");
        //   $("#remove").removeClass("d-none");
        // })
        $("#emailVereify").validate({
          rules: {
            email_otp:{
                required: true,
              }
          },
          messages: {  
            email_otp:"Please Enter OTP",
            }
           
        })
           
        
        $("#emailVereify").submit(function(e){
          // return;
          // e.stopImmediatePropagation();
          // e.preventDefault(); // avoid to execute the actual submit of the form.
          //alert('here');
          e.preventDefault();
          e.stopPropagation();
          e.stopImmediatePropagation();
          //alert('here 1');
            var form = $(this);
            var url = form.attr('action');    
            //console.log(url);
            // alert("heee");
            //console.log(form.serialize());
            $.ajax({
               type: "POST",
               url: url,
               data: form.serialize(), // serializes the form's elements.
               datatype:'JSON',
               
              success:function(res){
                  res = JSON.parse(res);
                if(res.flag == "F")
               {
                var msg = alertify.error('Default message');
                msg.delay(3).setContent(res.msg);
                //  window.location.replace(res.redirect);
                // $('#password').focus();
                
               }

                 
                  //$('#userEmail').focus();
                if(res.flag == "S"){
                      //alertify.success(res.msg);
                    window.location.replace(res.redirect);
        
                }
              
                
              }
             });
        })

        $("body").on("click",".resend_otp",function(e){
          var dataId =$(this).attr("data-id");
          $("#resend_otp").hide();
          //alert(dataId);return;
          $.ajax({
            type: "POST",
            url: base_url+"student/resendOtp",
            data: {dataId:dataId}, // serializes the form's elements.
            datatype:'JSON',
            beforeSend: function(request) {
             $("#saveuser").html("<span>Sending..</span>");
           },
           success:function(res){
               res = JSON.parse(res);
             if(res.flag == "F"){
              $("#resend_otp").show();
             var msg = alertify.error('Default message');
             msg.delay(3).setContent(res.msg);
             }
             if(res.flag == "S"){
               //alert("hiii");
               $("#resend_otp").hide();
               var resendCounter = 30;
               $("#resend-timer").remove();
               $("#resend_otp").after("<p id='resend-timer'>Resend in "+resendCounter+" sec</p>");
               var resendTimer = setInterval(function () {
                resendCounter--;
                
                $("#resend-timer").html("Resend in "+resendCounter+" sec");
                if(resendCounter<1){
                  $("#resend-timer").remove();
                  clearInterval(resendTimer);
                  $("#resend_otp").show();
                }
                
               }, 1000);
              
              msg.delay(3).setContent(res.msg);
              //msg.ondismiss = function(){  window.location.replace(res.redirect);  };
             }
             setTimeout(function(){
                 $("#saveuser").html("Send");
             }, 3000);
             
           },
           error:function(res){
            $("#resend_otp").show();
           }
          });
        })

        
        $("#forgotpassword").submit(function(e) {
          $(".back a").css({"display" : "block"});
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var form = $(this);
            //console.log(form);
            var url = form.attr('action');
             //alert("heee");return;
            //  console.log(form.serialize()); return;
            $.ajax({
               type: "POST",
               url: url,
               data: form.serialize(), // serializes the form's elements.
               datatype:'JSON',
               beforeSend: function(request) {
                $("#saveuser").html("<span>Sending..</span>");
              },
              success:function(res){
                  res = JSON.parse(res);
                if(res.flag == "F"){
                var msg = alertify.error('Default message');
                msg.delay(3).setContent(res.msg);
                }
                if(res.flag == "S"){
                  // alertify.success(res.msg);
                  var msg = alertify.success('Default message');
                msg.delay(3).setContent(res.msg);
                msg.ondismiss = function(){  window.location.replace(res.redirect);  };
                    //window.location.replace(res.redirect);
                }
                setTimeout(function(){
                    $("#saveuser").html("Send");
                }, 3000);
                
              }
             });
        });

        var validator = $("#updatePassword").validate({
          rules: {
              userEmail: {
                  required: true,
                  fullEmail: true
              },
              userPass: {
                  required: true,
                  pwcheck:true,
              },
              cpassword: {
                  required: true,
                  equalTo: "#password"
              },
          },
          messages: {
              userEmail: "Please enter a valid email address",
              userPass: {
                  required: "Please provide a password",
                  pwcheck:"Enter at least one uppercase, one lowercase, one number, and one special character"
              },
              cpassword: {
                  required: "Please provide a password",
                  minlength: "Your password must be at least 5 characters long",
                  equalTo: "Please enter the same password as above"
              },
          },submitHandler: function(form) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var form = $(this);
            //console.log(form);return;
            var url = form.attr('action');
            // alert("heee");
            //console.log(form.serialize());return;
            $.ajax({
               type: "POST",
               url: url,
               data: form.serialize(), // serializes the form's elements.
               datatype:'JSON',
               beforeSend: function(request) {
                $("#saveuser").html("<span>Updating..</span>");
              },
              success:function(res){
                  res = JSON.parse(res);
                if(res.flag == "F"){
                var msg = alertify.error('Default message');
                msg.delay(3).setContent(res.msg);
                //msg.ondismiss = function(){  window.location.replace(res.redirect);  };
               // alertify.error(res.msg);
                }
                if(res.flag == "S"){
                  // alertify.success(res.msg);
                  var msg = alertify.success('Default message');
                  msg.delay(3).setContent(res.msg);
                  msg.ondismiss = function(){  window.location.replace(res.redirect);  };
                    //alert(res.redirect)
                    //window.location.replace(res.redirect);
    
                }
                setTimeout(function(){
                    $("#saveuser").html("update");
                }, 3000);
                
              }
             });
          }
      });

        
    

        $("#updateEduProfile").submit(function(e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var form = $(this);
            
           // console.log(form);return;
            var url = form.attr('action');
            // console.log(url);return;
            //console.log(form.serialize());return;
             //alert("heee");return;
            $.ajax({
              url: url,
              type: "POST",
              data: new FormData(this),
              contentType: false,
              cache: false,
              processData:false,
               beforeSend: function(request) {
                $("#updateuser").html("<span>Updating..</span>");
              },
              success:function(res){
                  res = JSON.parse(res);
                if(res.flag == "F")
                {
                var msg = alertify.error('Default message');
                msg.delay(3).setContent(res.msg);
                }
                //msg.ondismiss = function(){  window.location.replace(res.redirect);  };
               // alertify.error(res.msg);
                if(res.flag == "S"){
                  //alert("hiiii");return;
                  var msg = alertify.success('Default message');
                  msg.delay(3).setContent(res.msg);
                  msg.ondismiss = function(){  window.location.replace(res.redirect);  };
                  // alertify.success(res.msg);
                  //   //alert(res.redirect)
                  //    window.location.replace(res.redirect);
    
                }
                setTimeout(function(){
                    $("#updateuser").html("update");
                }, 3000);
                
              }
             });
        });

        $("#updateRefProfile").validate({
          rules:{
            ref1_fname:{
              required:true,
              alpha:true,
            },
            ref1_lname:{
              required:true,
              alpha:true,
            },
            ref1_email:{
              required:true,
              fullEmail:true,
            },
            ref1_phone:{
              required:true,
              number:true,
              minlength:10,
              maxlength:10,
            },
            ref1_designation:{
              required:true,
            },
            ref2_fname:{
              required:true,
              alpha:true,
            },
            ref2_lname:{
              required:true,
              alpha:true,
            },
            ref2_email:{
              required:true,
              fullEmail:true,
            },
            ref2_phone:{
              required:true,
              number:true,
              minlength:10,
              maxlength:10,
              
            },
            ref2_designation:{
              required:true,
            },
          },
          messages:{
            ref1_fname:{
              required:"Please enter first name",
              alpha:"only alphabets are allowed",
            },
            ref1_lname:{
              required:"Please enter last name",
              alpha:"only alphabets are allowed",
            },
            ref1_email:{
              required:"please enter email",
              fullEmail:"Please enter valid email",
            },
            ref1_phone:{
              maxlength:"Contact no. should be a 10 digit no",
                minlength:"Contact no. should be a 10 digit no",
                required: "Please provide a contact number",
				        mobileNo : "Please provide a valid contact no"
            },
            ref1_designation:{
              required:"please select Designation",
            },
            ref2_fname:{
              required:"Please enter first name",
              alpha:"only alphabets are allowed",
            },
            ref2_lname:{
              required:"Please enter first name",
              alpha:"only alphabets are allowed",
            },
            ref2_email:{
              required:"please enter email",
              fullEmail:"Please enter valid email",
            },
            ref2_phone:{
              maxlength:"Contact no. should be a 10 digit no",
                minlength:"Contact no. should be a 10 digit no",
                required: "Please provide a contact number",
				        mobileNo : "Please provide a valid contact no"
              
            },
            ref2_designation:{
              required:"please select Designation",
            },
          }
        })

        $("#updateRefProfile").submit(function(e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var form = $(this);
           // console.log(form);return;
            var url = form.attr('action');
            //console.log(url);return;
            //console.log(form.serialize());return;
            // alert("heee");
            $.ajax({
               type: "POST",
               url: url,
               data: form.serialize(), // serializes the form's elements.
               datatype:'JSON',
               beforeSend: function(request) {
                $("#updaterefuser").html("<span>Updating..</span>");
              },
              success:function(res){
                  res = JSON.parse(res);
                if(res.flag == "F"){
                var msg = alertify.error('Default message');
                msg.delay(3).setContent(res.msg);
                }
                //msg.ondismiss = function(){  window.location.replace(res.redirect);  };
                //alertify.error(res.msg);
                if(res.flag == "S"){
                  var msg = alertify.success('Default message');
                  msg.delay(3).setContent(res.msg);
                  msg.ondismiss = function(){  window.location.replace(res.redirect);  };
                  //alertify.success(res.msg);
                    //alert(res.redirect)
                     //window.location.replace(res.redirect);
    
                }
                setTimeout(function(){
                    $("#updaterefuser").html("update");
                }, 3000);
                
              }
             });
        });

       
        

        $("#updateresources").submit(function(e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var form = $(this);
            //console.log(form);return;
            var url = form.attr('action');
            //console.log(url);return;
            // console.log(form.serialize());return;
            // alert("heee");
            $.ajax({
               type: "POST",
               url: url,
               data: form.serialize(), // serializes the form's elements.
               datatype:'JSON',
               beforeSend: function(request) {
                $("#updatereso").html("<span>Updating..</span>");
              },
              success:function(res){
                  res = JSON.parse(res);
                if(res.flag == "F")
                {
                  var msg = alertify.error('Default message');
                  msg.delay(3).setContent(res.msg);
                  //msg.ondismiss = function(){  window.location.replace(res.redirect);  };
                }
                //alertify.error(res.msg);
                if(res.flag == "S"){
                  // alertify.success(res.msg);
                  //   //alert(res.redirect)
                  //    window.location.replace(res.redirect);
                  var msg = alertify.success('Default message');
                  msg.delay(3).setContent(res.msg);
                  msg.ondismiss = function(){  window.location.replace(res.redirect);  };
    
                }
                setTimeout(function(){
                    $("#updatereso").html("update");
                }, 3000);
                
              }
             });
        });
        $(".sendinvite").hide();
        $("#memberDetail").submit(function(e) {
          e.preventDefault(); // avoid to execute the actual submit of the form.
          var form = $(this);
          //console.log(form);return;
          var url = form.attr('action');
           //alert("heee");
          //console.log(form.serialize());return;
          $.ajax({
             type: "POST",
             url: url,
             data: form.serialize(), // serializes the form's elements.
             datatype:'JSON',
             beforeSend: function(request) {
              $("#saveuser").html("<span>Updating..</span>");
            },
            success:function(res){
                res = JSON.parse(res);
              if(res.flag == "F"){
                var msg = alertify.error('Default message');
                msg.delay(3).setContent(res.msg);
                //msg.ondismiss = function(){  window.location.replace(res.redirect);  };
              }
              // alertify.set({ delay: 10000 });
              //alertify.error(res.msg);
              if(res.flag == "M"){
                var msg = alertify.error('Default message');
                msg.delay(3).setContent(res.msg);
                msg.ondismiss = function(){  window.location.replace(res.redirect);  };
                // alertify.error(res.msg);
                //  window.location.replace(res.redirect);
              }
              
              if(res.flag == "S"){
                // alert("hiii");
                  $(".para1").hide();
                  $(".sendinvite").show();
              }
              setTimeout(function(){
                  $("#saveuser").html("update");
              }, 3000);
              
            }
           });
      });
      
      $('.sent-b').click(function(){
        window.location.replace(base_url+"student/project");
      });
      var dropvalue = '';
      
      dropvalue = $('#dropdownYear').val();
      //alert(dropvalue);
      $('#dropdownYear').each(function() {

        
        //alert(dropvalue);
        var year = (new Date()).getFullYear();
        var current = year;
        year -= 0;
        for (var i = 0; i < 5; i++) {
          if ((year+i) == current)
          {
              //$(this).append('<option value="">Select Year</option>');
              if(year + i == dropvalue){
                $(this).append('<option selected value="' + (year + i) + '">' + (year + i) + '</option>');
              }else{
                $(this).append('<option value="' + (year + i) + '">' + (year + i) + '</option>');
              }
          }
            
          else{
            if(year + i == dropvalue){
              $(this).append('<option selected value="' + (year + i) + '">' + (year + i) + '</option>');
            }else{
              $(this).append('<option value="' + (year + i) + '">' + (year + i) + '</option>');
            }
          }
        }
        
        })

        $('#dropYear').each(function() {

          var year = (new Date()).getFullYear();
          var current = year;
          year -= 0;
          for (var i = 1; i < 5; i++) {
            if ((year+i) == current)
            {
                $(this).append('<option value="">Select Year</option>');
                $(this).append('<option value="' + (year + i) + '">' + (year + i) + '</option>');
            }
              
            else{
              $(this).append('<option value="' + (year + i) + '">' + (year + i) + '</option>');
            }
          }
          
          })

        $(document).ready(function(){
          $(".para1").hide();
          $(".btn1").click(function(){
            $(".para1").hide();
            $(".my-teamhide").show();
            // location.reload();
          });
          $(".btn2").click(function(){
            
            $(".para1").show();
             $(".my-teamhide").hide();
            
          });
        });
        
        $(".delemem").click(function(e){
          var name = $(e.currentTarget).closest(".name-icon").find(".Uname").html();
          alertify.confirm('Warning', 'Do you want to remove '+name+'?', function(){ 
            var memId = $(e.currentTarget).attr("data-memID");
              $.ajax({
                  type: "POST",
                  url: base_url+"student/removeMember",
                  data: {memID:memId}, // serializes the form's elements.
                  datatype:'JSON',
                  beforeSend: function(request) {
                  //$("#save").html("<span>SENDING..</span>");
                  },
                  success:function(res){
                      res = JSON.parse(res);
                      if(res.flag == "F")
                      {
                        var msg = alertify.error('Default message');
                        msg.delay(3).setContent(res.msg);
                      }
                      if(res.flag == "S"){
                        $(e.currentTarget).closest(".my-teaml").remove();
                        var msg = alertify.success('Default message');
                        msg.delay(3).setContent(res.msg);
                        //msg.ondismiss = function(){  window.location.replace(res.redirect);  };
                      }
                  }
              });
            }
            , function(){ 
              console.log("noting to do");
            });
  
          });

          

          $(document).ready(function(){
            /* Get iframe src attribute value i.e. YouTube video url
            and store it in a variable */
            var url = $("#cartoonVideo").attr('src');
            
            /* Assign empty url value to the iframe src attribute when
            modal hide, which stop the video playing */
            $("#myModal").on('hide.bs.modal', function(){
                $("#cartoonVideo").attr('src', '');
            });
            
            /* Assign the initially stored url back to the iframe src
            attribute when modal is displayed again */
            $("#myModal").on('show.bs.modal', function(){
                $("#cartoonVideo").attr('src', url);
            });
        });
       
      //  $("#portal").click(function(){
      //   $(".sub-myaccount").css("display", "none");
      //  })


      //  const togglemenu = document.querySelector('#togglemenu');
      //   const menu = document.querySelector('#menu');
      //   togglemenu.addEventListener('click', function (e) {
      //     // toggle the type attribute
      //     const type = menu.getAttribute('type') === 'menu' ? 'div' : 'menu';
      //     menu.setAttribute('type', type);
      //     // toggle the eye / eye slash icon
      //     this.classList.toggle('bx-chevron-up');
      // });
      //  $("#togglemenu").click(function(){
      //   $(".sub-myaccount").css("display", "none");
      //  })

      //  $("#apporoved").hide();
      //  $("#all").click(function(){
      //   $("#all").show();
      //   $("#apporoved").hide();
      //  })
      //  $("#apporoved").click(function(){
      //   $("#apporoved").show();
      //   $("#all").hide();
      //  })
       
       

      /*var currentUrl = window.location.href;
      var splitVal = currentUrl.split('/');
      var lastSplitVal = splitVal[splitVal.length-1];
      $("."+lastSplitVal+'0.make-active').addClass('active-nav');*/
     
      
      
      $(".approveProject").click(function(e) {
        // $title =$("input[name=innovate]").prop('checked', true);
        // alert($title);return;
      e.preventDefault();
      $.ajax({
          type: "POST",
          url: base_url+"project/approveProject",
          data:{ 
            projectid:$(this).attr("data-projectID"),
              //adminId: $("#adminid").val(),
              //console.log()
          },
          datatype:'JSON',
          beforeSend: function(request) {
          //$("#saveuser").html("<span>Sending..</span>");
      },
      success:function(res){
          res = JSON.parse(res);
          if(res.flag == "F"){
            var msg = alertify.error('Default message');
            msg.delay(3).setContent(res.msg);
            //msg.ondismiss = function(){  window.location.replace(res.redirect);  };
          }
          //alertify.error(res.msg);
          
          if(res.flag == "S"){
            var msg = alertify.success('Default message');
            msg.delay(3).setContent(res.msg);
            //msg.ondismiss = function(){  window.location.replace(res.redirect);  };
            // alertify.success(res.msg);
            //   window.location.replace(res.redirect);
          }
         
      }
      });
      
  });

  
  $(".rejectProject").click(function(e) {
    e.preventDefault();
    $("#rejectAction").val("rejectProject")
    $("#rejectConfirm").attr("data-projectID", $(this).attr("data-projectID"));
    //alert(base_url+"project/rejectProject");return;
    $("#textReason").val("");
    $("#reasonModal").modal("show");
    
  });

  $("#rejectConfirm").click(function(e) {
    e.preventDefault();
    $("#rejection-error").addClass("hide");
    if($("#textReason").val().trim() == ""){
      $("#rejection-error").removeClass("hide");
      return false;
    }
    $("#reasonModal").modal("hide");
    $.ajax({
      type: "POST",
      url: base_url+"project/"+$("#rejectAction").val(),
      data:{ 
        projectid:$(this).attr("data-projectID"),
        "reason":$("#textReason").val(),
          //adminId: $("#adminid").val(),
          //console.log()
      },
        datatype:'JSON',
        beforeSend: function(request) {
        //$("#saveuser").html("<span>Sending..</span>");
    },
    success:function(res){
        res = JSON.parse(res);
        if(res.flag == "F"){
          var msg = alertify.error('Default message');
          msg.delay(3).setContent(res.msg);
          //msg.ondismiss = function(){  window.location.replace(res.redirect);  };
        }
        //alertify.error(res.msg);
        
        if(res.flag == "S"){
          var msg = alertify.success('Default message');
          msg.delay(3).setContent(res.msg);
          msg.ondismiss = function(){  window.location.replace(res.redirect);  };
          // alertify.error(res.msg);
          // window.location.replace(res.redirect);
        }
      
    }
    });
    
  });

$(".holdProject").click(function(e) {
  e.preventDefault();
  //alert(base_url+"project/rejectProject");return;
  $.ajax({
      type: "POST",
      url: base_url+"project/holdProject",
      data:{ 
        projectid:$(this).attr("data-projectID"),
          //adminId: $("#adminid").val(),
          //console.log()
      },
      datatype:'JSON',
      beforeSend: function(request) {
      //$("#saveuser").html("<span>Sending..</span>");
  },
  success:function(res){
      res = JSON.parse(res);
      if(res.flag == "F"){
        var msg = alertify.error('Default message');
        msg.delay(3).setContent(res.msg);
        //msg.ondismiss = function(){  window.location.replace(res.redirect);  };
      }
      //alertify.error(res.msg);
      
      if(res.flag == "S"){
        var msg = alertify.success('Default message');
        msg.delay(3).setContent(res.msg);
        msg.ondismiss = function(){  window.location.replace(res.redirect);  };
        // alertify.success(res.msg);
        // window.location.replace(res.redirect);
      }
  }
  });
});

$(".phase2approveProject").click(function(e) {
  // $title =$("input[name=innovate]").prop('checked', true);
  // alert($title);return;
e.preventDefault();
$.ajax({
    type: "POST",
    url: base_url+"project/phase2approveProject",
    data:{ 
      projectid:$(this).attr("data-projectID"),
        //adminId: $("#adminid").val(),
        //console.log()
    },
    datatype:'JSON',
    beforeSend: function(request) {
    //$("#saveuser").html("<span>Sending..</span>");
},
success:function(res){
    res = JSON.parse(res);
    if(res.flag == "F"){
      var msg = alertify.error('Default message');
      msg.delay(3).setContent(res.msg);
      //msg.ondismiss = function(){  window.location.replace(res.redirect);  };
    }
    // alertify.error(res.msg);
    
    if(res.flag == "S"){
      var msg = alertify.success('Default message');
      msg.delay(3).setContent(res.msg);
      msg.ondismiss = function(){  window.location.replace(res.redirect);  };
      // alertify.success(res.msg);
      //   window.location.replace(res.redirect);
    }
}
});
});

$(".phase2rejectProject").click(function(e) {
  // $title =$("input[name=innovate]").prop('checked', true);
  // alert($title);return;
  e.preventDefault();
  $("#rejectAction").val("phase2rejectProject");
  $("#rejectConfirm").attr("data-projectID", $(this).attr("data-projectID"));
    //alert(base_url+"project/rejectProject");return;
    $("#textReason").val("");
    $("#reasonModal").modal("show");
});

$(".phase2holdProject").click(function(e) {
  // $title =$("input[name=innovate]").prop('checked', true);
  // alert($title);return;
e.preventDefault();
$.ajax({
    type: "POST",
    url: base_url+"project/phase2holdProject",
    data:{ 
      projectid:$(this).attr("data-projectID"),
        //adminId: $("#adminid").val(),
        //console.log()
    },
    datatype:'JSON',
    beforeSend: function(request) {
    //$("#saveuser").html("<span>Sending..</span>");
},
success:function(res){
    res = JSON.parse(res);
    if(res.flag == "F"){
      var msg = alertify.error('Default message');
      msg.delay(3).setContent(res.msg);
      //msg.ondismiss = function(){  window.location.replace(res.redirect);  };
    }
    // alertify.error(res.msg);
    
    if(res.flag == "S"){
      var msg = alertify.success('Default message');
      msg.delay(3).setContent(res.msg);
      msg.ondismiss = function(){  window.location.replace(res.redirect);  };
      // alertify.success(res.msg);
      //   window.location.replace(res.redirect);
    }
}
});
});


$(".fiftyProject").click(function(e) {
  e.preventDefault();
  //alert("hiii");return;
  //alert(base_url+"project/rejectProject");return;
  //alert($(this).attr("data-projectID"));return;
  $.ajax({
      type: "POST",
      url: base_url+"project/fiftyProject",
      data:{ 
        projectid:$(this).attr("data-projectID"),
          //adminId: $("#adminid").val(),
          //console.log()
      },
      datatype:'JSON',
      beforeSend: function(request) {
      //$("#saveuser").html("<span>Sending..</span>");
  },
  success:function(res){
      res = JSON.parse(res);
      if(res.flag == "F")
      {
        var msg = alertify.error('Default message');
        msg.delay(3).setContent(res.msg);
        //msg.ondismiss = function(){  window.location.replace(res.redirect);  };
      }
      // alertify.error(res.msg);
      
      if(res.flag == "S"){
        var msg = alertify.success('Default message');
        msg.delay(3).setContent(res.msg);
        msg.ondismiss = function(){  window.location.replace(res.redirect);  };
        // alertify.success(res.msg);
        // window.location.replace(res.redirect);
      }
  }
  });
});

$(".bottomfiftyProject").click(function(e) {
  e.preventDefault();
  //alert("hiii");return;
  //alert(base_url+"project/rejectProject");return;
  //alert($(this).attr("data-projectID"));return;
  $.ajax({
      type: "POST",
      url: base_url+"project/bottomfiftyProject",
      data:{ 
        projectid:$(this).attr("data-projectID"),
          //adminId: $("#adminid").val(),
          //console.log()
      },
      datatype:'JSON',
      beforeSend: function(request) {
      //$("#saveuser").html("<span>Sending..</span>");
  },
  success:function(res){
      res = JSON.parse(res);
      if(res.flag == "F"){
        var msg = alertify.error('Default message');
        msg.delay(3).setContent(res.msg);
        //msg.ondismiss = function(){  window.location.replace(res.redirect);  };
      }
      // alertify.error(res.msg);
      
      if(res.flag == "S"){
        var msg = alertify.success('Default message');
        msg.delay(3).setContent(res.msg);
        msg.ondismiss = function(){  window.location.replace(res.redirect);  };
        // alertify.success(res.msg);
        // window.location.replace(res.redirect);
      }
  }
  });
});

$(".twohunProject").click(function(e) {
  e.preventDefault();
  //alert("hiii");return;
  //alert(base_url+"project/rejectProject");return;
  //alert($(this).attr("data-projectID"));return;
  $.ajax({
      type: "POST",
      url: base_url+"project/twohunProject",
      data:{ 
        projectid:$(this).attr("data-projectID"),
          //adminId: $("#adminid").val(),
          //console.log()
      },
      datatype:'JSON',
      beforeSend: function(request) {
      //$("#saveuser").html("<span>Sending..</span>");
  },
  success:function(res){
      res = JSON.parse(res);
      if(res.flag == "F")
      {
        var msg = alertify.error('Default message');
        msg.delay(3).setContent(res.msg);
        //msg.ondismiss = function(){  window.location.replace(res.redirect);  };
      }
      // alertify.error(res.msg);
      
      if(res.flag == "S"){
         var msg = alertify.error('Default message');
                msg.delay(3).setContent(res.msg);
                msg.ondismiss = function(){  window.location.replace(res.redirect);  };
        // alertify.error(res.msg);
        // window.location.replace(res.redirect);
      }
  }
  });
});


$(".approved").hide();
$(".rejected").hide();
$(".hold").hide();
 $(".phasetwoapproved").hide();
 $(".phasetworejected").hide();
 $(".phasetwohold").hide();
$(".fifty").hide();
$(".betweenhun-two").hide();
$(".bottom").hide();

$('.pha-select').click(function(){
  $('.posi-content,.phatwo-content,.phasetwo-content').hide();
});
$('.pha-cla,.phatwo-cla,.phasetwo-cla').click(function(){
  $('.posi-select').hide();
})

function hidePhaseOnePanels(){
  $(".all").hide();
  $(".approved").hide();
  $(".rejected").hide();
  $(".hold").hide();
}

$('#all').click(function(){
  var approved = $("input[name='phaseOne']:checked").val();
  $(".change-text").html(approved);
  //alert(approved);
  hidePhaseOnePanels();
  $(".all").show();
});
$('#approved').click(function(){
  var approved = $("input[name='phaseOne']:checked").val();
  $(".change-text").html(approved);
  hidePhaseOnePanels();
  $(".approved").show();
});

$('#rejected').click(function(){
  var approved = $("input[name='phaseOne']:checked").val();
  $(".change-text").html(approved);
  hidePhaseOnePanels();
  $(".rejected").show();
});

$('#hold').click(function(){
   var approved = $("input[name='phaseOne']:checked").val();
  $(".change-text").html(approved);
  hidePhaseOnePanels();
  $(".hold").show();
});

function hidePhaseTwoPanels(){
  $(".phasetwoall").hide();
  $(".phasetwoapproved").hide();
  $(".phasetworejected").hide();
  $(".phasetwohold").hide();
}


$('#phasetwoall').click(function(){
  var approved = $("input[name='phasethree']:checked").val();
 $(".change-text").html(approved);
 // alert(approved);
 hidePhaseTwoPanels();
 $(".phasetwoall").show();
});

$('#phasetwoapproved').click(function(){
  var approved = $("input[name='phasethree']:checked").val();
 $(".change-text").html(approved);
 hidePhaseTwoPanels();
 $(".phasetwoapproved").show();
});

$('#phasetworejected').click(function(){
  var approved = $("input[name='phasethree']:checked").val();
 $(".change-text").html(approved);
 // alert(approved);
 hidePhaseTwoPanels();
 $(".phasetworejected").show();
});

$('#phasetwohold').click(function(){
  var approved = $("input[name='phasethree']:checked").val();
 $(".change-text").html(approved);
 // alert(approved);
 hidePhaseTwoPanels();
 $(".phasetwohold").show();
});

$('#phasethall').click(function(){
  var top = $("input[name='phasetwo']:checked").val();
  //alert(top);
  $(".changerank-text").html(top);
  $('.top100').show();
  $('.fifty').hide();
  $(".betweenhun-two").hide();
  $('.bottom').hide();
})

$('#top').click(function(){
  var top = $("input[name='phasetwo']:checked").val();
  //alert(top);
  $(".changerank-text").html(top);
  $('.top100').hide();
  $('.fifty').show();
  $(".betweenhun-two").hide();
  $('.bottom').hide();
})
$('#hundred').click(function(){
  var top = $("input[name='phasetwo']:checked").val();
  //alert(top);
  $(".changerank-text").html(top);
  $('.top100').hide();
  $('.fifty').hide();
  $(".betweenhun-two").hide();
  $('.bottom').show();
})
$('#bottom').click(function(){
  var top = $("input[name='phasetwo']:checked").val();
  //alert(top);
  $(".changerank-text").html(top);
  $('.top100').hide();
  $('.fifty').hide();
  $(".betweenhun-two").show();
  $('.bottom').hide();
})

$('.phasetwo-cla').hide();
$('.phatwo-cla').hide();
$('.finalists-cla').hide();
$('.phasethreedisply').hide();
$('.phasetwodisplay').hide();
$('.finalistsdisplay').hide();


$('#phase1').click(function(){
  var phases = $("input[name='innovate']:checked").val();
  $(".changephase-text").html(phases);
  var approved = $("#all").val();
  $(".change-text").html(approved);
  hidePhaseOnePanels();
  $(".all").show();
  $("#all").prop("checked", true);
  $(".all").show();
  

  $('.phaseonedisplay').show();
  $('.phasetwodisplay').hide();
  $('.phasethreedisply').hide();
  $('.finalistsdisplay').hide();
  // var gender = $("input[name='innovate']:checked").val();
  // alert(gender);
  $('.pha-cla').show();
  $('.phatwo-cla').hide();
  $('.phasetwo-cla').hide();
  $('.finalists-cla').hide();
});

$('#phase2').click(function(){
  var phases = $("input[name='innovate']:checked").val();
  $(".changephase-text").html(phases);
  var approved = $("#all").val();
  $(".change-text").html(approved);
  hidePhaseTwoPanels();
  $("#all").prop("checked", true);
  $(".phasetwoall").show();
  $('.phaseonedisplay').hide();
  $('.phasetwodisplay').show();
  $('.phasethreedisply').hide();
  $('.finalistsdisplay').hide();
  // var gender = $("input[name='innovate']:checked").val();
  // alert(gender);
  $('.pha-cla').hide();
  $('.phatwo-cla').show();
  $('.phasetwo-cla').hide();
  $('.finalists-cla').hide();
});


$('#phase3').click(function(){
  var phases = $("input[name='innovate']:checked").val();
  $(".changephase-text").html(phases);
  $('.phaseonedisplay').hide();
  $('.phasetwodisplay').hide();
  $('.phasethreedisply').show();
  $('.finalistsdisplay').hide();

  $('.pha-cla').hide();
  $('.phatwo-cla').hide();
  $('.phasetwo-cla').show();
  $('.finalists-cla').hide();
 
});
$('#finalists').click(function(){
  var phases = $("input[name='innovate']:checked").val();
  $(".changephase-text").html(phases);
  $('.phaseonedisplay').hide();
  $('.phasethreedisply').hide();
  $('.finalistsdisplay').show();

  $('.pha-cla').hide();
  $('.phatwo-cla').hide();
  $('.phasetwo-cla').hide();
  $('.finalists-cla').show();
 
});

$("#juryUpdatePassword").validate({
  rules: {
    userPass: {
          required: true,
          pwcheck:true,
      },
      cpassword: {
          required: true,
          equalTo: "#userPass"
      },
      juryNDA:{
        required: true,
      }
  },
  messages: {
    userPass: {
      required: "Please Enter Your Password.",
      pwcheck:"Enter at least one uppercase, one lowercase, one number, and one special character",
    },
      cpassword:{
        required:"Please Enter Your Password.",
        equalTo:"Please enter the same password as above",
      },  
      juryNDA:"Please Check The Non-Disclosure Agreement"
    }
})

$("#juryUpdatePassword").submit(function(e){
  e.preventDefault();
  var form = $(this);
  var url = form.attr('action');
  //alert(url);
  $.ajax({
    type:"POST",
    url:url,
    data:form.serialize(),
    datatype:'JSON',
    success:function(res){
      res = JSON.parse(res);
      if(res.flag =='F'){
        var msg = alertify.error('Default message');
        msg.delay(3).setContent(res.msg);
      }
      if(res.flag == 'S'){
        var msg = alertify.success('Default message');
        msg.delay(3).setContent(res.msg);
        msg.ondismiss = function(){  window.location.replace(res.redirect);  };
        //alert("hiiii");
        //window.location.replace(res.redirect);
      }
    }
  })
})

// $('input[name="juryYestop50"]').change(function() {
//  // alert($(this).val());return;
//  var projectID = $(this).attr("data-Id");
//  //alert(projectID);
//   if($(this).is(':checked')) {
//        $('#jurytop10').modal('show');
//        $('.jurymodal-description').html("Are you sure you want to add "+projectID+" to top 10 projects?");
//   }
// });

$("#menUpdatePassword").validate({
  rules: {
    userPass: {
          required: true,
          pwcheck:true,
      },
      cpassword: {
          required: true,
          equalTo: "#userPass"
      },
      menNDA:{
        required: true,
      }
  },
  messages: {
    userPass: {
      required: "Please Enter Your Password.",
      pwcheck:"Enter at least one uppercase, one lowercase, one number, and one special character",
    },
      cpassword:{
        required:"Please Enter Your Password.",
        equalTo:"Please enter the same password as above",
      },  
      menNDA:"Please Check The Non-Disclosure Agreement"
    }
})

$("#menUpdatePassword").submit(function(e){ 
  e.preventDefault();
          e.stopPropagation();
          e.stopImmediatePropagation();
          //alert('here 1');
            var form = $(this);
            var url = form.attr('action');    
            //console.log(url);
            // alert("heee");
            //console.log(form.serialize());
            $.ajax({
               type: "POST",
               url: url,
               data: form.serialize(), // serializes the form's elements.
               datatype:'JSON',
               
              success:function(res){
                  res = JSON.parse(res);
                if(res.flag == "F")
               {
                var msg = alertify.error('Default message');
                msg.delay(3).setContent(res.msg);
                //  window.location.replace(res.redirect);
                // $('#password').focus();
                
               }
                  //$('#userEmail').focus();
                if(res.flag == "S"){
                  var msg = alertify.success('Default message');
                  msg.delay(3).setContent(res.msg);
                  msg.ondismiss = function(){  window.location.replace(res.redirect);  };
                      //alertify.success(res.msg);
                    //window.location.replace(res.redirect);
                }
              }
             });
})

    $('input[name="yestop50"]').change(function() {
      var share_val = $('input[name="yestop50"]:checked').val();
      if(share_val =="Yes"){
        $(".incubation-status").html("")
      }else{
        $(".incubation-status").html("not ");
      }
      $('#incubateModal').modal('show');
    });
    $('#incubateModal').on('hidden.bs.modal', function () {
        console.log("Hidei");
        $('#flexRadioDefault1').prop('checked', false);
        $('#flexRadioDefault2').prop('checked', false);
    });


})


function shareWithIncubation(){
  var yesno = $('input[name="yestop50"]:checked').val();
  $(".incu-yestop100").addClass("hide");
  $.ajax({
    type: "POST",
    url: base_url+"student/shareWithIncubation",
    data: {"shareWithIncubator":yesno}, // serializes the form's elements.
    datatype:'JSON',
    
   success:function(res){
      res = JSON.parse(res);
      if(res.flag == "F")
      {
        $(".incu-yestop100").removeClass("hide");;
      }else{
        $(".ayesTop100").removeClass("hide");
        location.reload();
      }
   }
  });
}

$(document).ready(function(){
  $(".bx-group").on("click", function(){
      if($('.msg1').css('display') == 'block' && $('.mobile-click').css('display') == 'none') {
          $(".mobile-click").hide(); 
      } else {
          $(".mobile-click").toggle();
      }
  $(".team1").toggle();
  $(".msg1").hide();
  $(".mobile-team").toggle();
  $(".add-member1").hide();
  });
  $(".bxs-chat").on("click", function(){
      if($('.team1').css('display') == 'block' && $('.mobile-click').css('display') == 'none') {
          $(".mobile-click").hide(); 
      } else {
          $(".mobile-click").toggle();
          }
      $(".msg1").toggle();
      $(".team1").hide();
      $(".mentor-msg").toggle();
      $(".mobile-change").hide();
  });
  $(".bx-plus").on("click", function(){
      $(".mobile-change").toggle();
      $(".mobile-team").hide();
      $(".add-member1").hide();
  });  
  $("#sendinvitebtn").on("click", function(){
      $(".add-member1").toggle();
      $(".mobile-change").hide();
      $(".bxs-chevron-left").hide();
  });

  $('.jury-content').on('change', function(e) {
    var value = $('input[name="juryfina"]:checked', '.jury-content').val();
    //console.log(value);
    if(value == 'All'){
     var url = base_url+"jury/allList";
     console.log(url);
    } else{
     //console.log("top 10");
     var url = base_url+"jury/top10List";
     console.log(url);
    }

    $.ajax({
     type:"POST",
     url:url,
     data:{datavalue:value},
     datatype:'JSON',
     success:function(res){
       res = JSON.parse(res);
       if(res.flag =='F'){
         var msg = alertify.error('Default message');
         msg.delay(3).setContent(res.msg);
       }
       if(res.flag == 'S'){
         //alert("hiiii");
         window.location.replace(res.redirect);
       }
     }
   })

 });

  $('#filterOption').on("change",function(e){
    //alert("hiiiii");
   // var value = $('input[name="juryfina"]:checked', '.jury-content').val();
   // $('#juryhidden').val(value);
    $('#juryFilter').submit();
    // alert(value);
    //   if(value == 'All'){
    //     var url = base_url+"jury/allList";
    //     console.log(url);
    //  } else{
    //        //console.log("top 10");
    //     var url = base_url+"jury/top10List";
    //     console.log(url);
    //   }
  })

 let projectISparD ='';
 var projectId ='';
 let sparkleId ='';
 let project_ID='';
 let value ='';
$('input[name="juryYestop50"]').change(function() {
   //alert($(this).val());return;
   projectISparD = $(this).attr("data-id");
   projectId = $(this).attr("data-proid");

  //console.log(projectId);
  //  if($(this).is(':checked')) {
  //       $('#jurytop10').modal('show');
  //       $('.jurymodal-description').html("Are you sure you want to add "+projectISparD+" to top 10 projects?");
  //  }
 });
 
 $('.jury-btn').click(function(){
   //alert("hiiiii");
   value = $('input[name="juryYestop50"]:checked').val();
  console.log(value);
  if(value == "Yes"){
    //alert("hiiii");
    $('#jurytop10').modal('show');
    $('.jurymodal-description').html("Are you sure you want to add "+projectISparD+" to top 10 projects?");
  }else{
    $('#jurytop10').modal('show');
    $('.jurymodal-description').html(" "+projectISparD+" to top 10 projects?");
  }
 })
let proId='';
 $('.juryremove').click(function(){
  sparkleId = $(this).attr("data-id");
   proId = $(this).attr("data-proId");
   //alert(proId);
  //console.log(sparkleId);
  //$('#removeTop10').modal('show');
  $('.jurymodal-remove').html("Are you sure you want to remove "+sparkleId+" to top 10 projects?");
 })

 $('.sendinTop10').click(function(e){
   //alert("hiiii");
   //console.log(value);return;
   var url = base_url+"jury/selectTop10";
   $.ajax({
    type:"POST",
    url:url,
    data:{projectId:projectId,jurysatus:value},
    datatype:'JSON',
    success:function(res){
      res = JSON.parse(res);
      //alert(res.flag);return;
      if(res.flag =='F'){
        var msg = alertify.error('Default message');
        msg.delay(3).setContent(res.msg);
      }
      if(res.flag == 'S'){
        //alert(res.msg);return;
        var msg = alertify.success('Default message');
        msg.delay(3).setContent(res.msg);
        //alert("hiiii");
        //window.location.replace(res.redirect);
      }
    }
  })
 })
 
 $('.removetop').click(function(e){
  //alert("hiiii");
  //console.log(value);return;
 
  //alert(proId);return;
  var jurysatus = "No";
  var url = base_url+"jury/selectTop10";
  $.ajax({
   type:"POST",
   url:url,
   data:{projectId:proId,jurysatus:jurysatus},
   datatype:'JSON',
   success:function(res){
     res = JSON.parse(res);
     //alert(res.flag);return;
     if(res.flag =='F'){
       var msg = alertify.error('Default message');
       msg.delay(3).setContent(res.msg);
     }
     if(res.flag == 'S'){
       //alert(res.msg);return;
       var msg = alertify.success('Default message');
       msg.delay(3).setContent(res.msg);
       //alert("hiiii");
       //window.location.replace(res.redirect);
     }
   }
 })
})

});