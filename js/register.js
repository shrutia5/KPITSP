$(document).ready(function () {
  var isDataValid = false;

  $(".forIncubation").hide();
  $("#enquryType").change(function (e) {
    selVal = $(e.currentTarget).val();
    $(".studentShow").show();
    $(".forIncubation").hide();
    $("#name").val("");

    if (selVal == "For Incubation") {
      $(".studentShow").hide();
      $(".forIncubation").show();
    }
  });
  $("#registerUser").keyup(function () {
    //console.log(validator.form())
  });
  $("#subbtn").click(function () {
    $("#registerUserEduDetails").submit();
  });
  if ($("#cardfile").length) {
    $("#cardfile").RealTimeUpload({
      text: "drag and drop your file here OR Upload here",
      maxFiles: 5,
      maxFileSize: 20000,
      uploadButton: false,
      notification: false,
      autoUpload: true,
      extension: "jpg|jpeg|png|pdf",
      thumbnails: false,
      element: "cardfile",
      isSingle: true,
      onSucess: function (data) {
        try {
          if (data.status == "File uploaded") {
            $("#RTU-uploadContainer").hide();
            $("#reg-icard").hide();
            $("#icard-file-holder").show();
            $("#frm-card-file .RTU-uploadItem").remove();
            $("#identityCard").val(data.filename);
            $("#icard-file").attr(
              "href",
              base_url + "uploads/student_icards/" + data.filename
            );
            $("#icard-file").html(data.filename);
            this.elements = [];
          }
        } catch (ex) {
          console.log(ex);
        }
      },
    });
  }

  $("body").on("click", ".removeCardFiles", function (e) {
    if (confirm("Do you want to delete?")) {
      $("#icard-file-holder").hide();
      $.ajax({
        type: "POST",
        url: base_url + "student/register/removeicard",
        data: { imgname: $("#identityCard").val() }, // serializes the form's elements.
        datatype: "JSON",
        beforeSend: function (request) {},
        success: function (res) {
          res = JSON.parse(res);
          if (res.flag == "S") {
            $("#identityCard").val("");
            //$("#cardfile").unbind().removeData();
            $("#reg-icard").show();
            //setUpload();
          } else {
            var msg = alertify.success("Default message");
            msg.delay(3).setContent(res.msg);
          }
        },
      });
    }
  });

  // $(".personl-section").show();

  var validator = $("#registerUser").validate({
    rules: {
      fname: {
        required: {
          depends: function () {
            $(this).val($(this).val().replace(/^\s+/g, ""));
            return true;
          },
        },
        alpha: true,
      },
      lname: {
        required: {
          depends: function () {
            $(this).val($(this).val().replace(/^\s+/g, ""));
            return true;
          },
        },
        alpha: true,
      },
      contact: {
        required: true,
        maxlength: 10,
        minlength: 10,
        mobileNo: true,
        digits: true,
      },
      password: {
        required: true,
        pwcheck: true,
      },
      cpassword: {
        required: true,
        equalTo: "#password",
      },
      email: {
        required: true,
        fullEmail: true,
      },
      state: {
        required: true,
      },
      city: {
        required: true,
      },
      college: {
        required: true,
      },
      branch: {
        required: true,
      },
      degree: {
        required: true,
      },
      stream: {
        required: true,
      },
      YearOfCompletion: {
        required: true,
      },
    },
    messages: {
      fname: {
        required: "Please enter first name",
        alpha: "only alphabets are allowed",
      },
      lname: {
        required: "Please enter last name",
        alpha: "only alphabets are allowed",
      },
      contact: {
        maxlength: "Contact no. should be a 10 digit no",
        minlength: "Contact no. should be a 10 digit no",
        required: "Please provide a contact number",
        mobileNo: "Please provide a valid contact no",
      },
      password: {
        required: "Please provide a password",
        pwcheck:
          "Enter at least one uppercase, one lowercase, one number, and one special character",
      },
      cpassword: {
        required: "Please provide a password",
        minlength: "Your password must be at least 5 characters long",
        equalTo: "Please enter the same password as above",
      },

      email: "Please enter a valid email address",
      faceboolUrl: "Please Enter facebbok url",
      twitterUrl: "Please Enter facebbok url",
      instagramUrl: "Please Enter facebbok url",
      linkedinUrl: "Please Enter facebbok url",
      state: "Please Select College state",
      city: "Please Select College City",
      college: "Please Select College",
      branch: "Please Select branch",
      degree: "Please Select degree",
      stream: "Please Select Stream",
      YearOfCompletion: "Enter Year Of Completion",
    },
    submitHandler: function (form) {
      if (isDataValid) {
        $(".home").hide();
        $(".eduDetails").show();
        $(".header-register .count").html("<span>2</span> of 2 ");
      }
    },
  });
  $("#student_verification").validate({
    rules: {
      email_otp: {
        required: true,
      },
    },
    messages: {
      required: "Please Enter Email OTP",
    },
  });

  $("#registerUserEduDetails").validate({
    rules: {
      state: {
        required: true,
      },
      city: {
        required: true,
      },
      college: {
        required: true,
      },
      branch: {
        required: true,
      },
      degree: {
        required: true,
      },
      stream: {
        required: true,
      },
      YearOfCompletion: {
        required: true,
      },
      otherCollege: {
        required: {
          depends: function () {
            $(this).val($(this).val().replace(/^\s+/g, ""));
            return true;
          },
        },
        lettersonly: true,
      },
      otherCity: {
        required: {
          depends: function () {
            $(this).val($(this).val().replace(/^\s+/g, ""));
            return true;
          },
        },
        lettersonly: true,
      },
      card: {
        required: true,
        extension: "jpg|jpeg|png|pdf",
      },
    },
    messages: {
      state: "Please Select College state",
      city: "Please Select College City",
      otherCity: {
        required: "Please Enter City Name",
        lettersonly: "Only characters allowed",
      },
      otherCollege: {
        required: "Please Enter City Name",
        lettersonly: "Only characters allowed",
      },
      college: "Please Select College",
      branch: "Please Select branch",
      degree: "Please Select degree",
      stream: "Please Select Stream",
      YearOfCompletion: "Enter Year Of Completion",
      card: {
        required: "Please upload identity card",
        extension: "Only jpg|jpeg|png|pdf allowed",
      },
    },
    submitHandler: function (form) {
      if ($("#identityCard").val() == "") {
        $("#reg-icard").append(
          '<div class="error">Upload College Identity Card</div>'
        );
        return false;
      }
      this.valid();
      var url = $("#registerUserEduDetails").attr("action");
      $.ajax({
        type: "POST",
        url: url,
        data: $("#registerUser,#registerUserEduDetails").serialize(), // serializes the form's elements.
        datatype: "JSON",

        success: function (res) {
          res = JSON.parse(res);
          if (res.flag == "F") {
            var msg = alertify.error("Default message");
            msg.delay(3).setContent(res.msg);
            //msg.ondismiss = function(){  window.location.replace(res.redirect);  };
          }
          // alertify.error(res.msg);
          //window.location.replace(res.redirect);
          if (res.flag == "S") {
            var msg = alertify.success("Default message");
            msg.delay(3).setContent(res.msg);
            msg.ondismiss = function () {
              window.location = base_url + "verify";
            };
            // alertify.success(res.msg);
            // window.location = base_url+"verify";
            // window.location.replace(res.redirect);
          }
          setTimeout(function () {
            $("#saveuser").html("update");
          }, 3000);
        },
      });
    },
  });

  $("#registerUser1").submit(function (e) {
    e.preventDefault(); // avoid to execute the actual submit of the form.
    var form = $(this);
    //console.log(form);return;
    var url = form.attr("action");
    $.ajax({
      type: "POST",
      url: url,
      data: form.serialize(), // serializes the form's elements.
      datatype: "JSON",

      success: function (res) {
        res = JSON.parse(res);
        if (res.flag == "F") {
          var msg = alertify.error("Default message");
          msg.delay(3).setContent(res.msg);
        }
        //alertify.error(res.msg);
        //window.location.replace(res.redirect);
        if (res.flag == "S") {
          var msg = alertify.success("Default message");
          msg.delay(3).setContent(res.msg);
          msg.ondismiss = function () {
            window.location.replace(res.redirect);
          };
          // alertify.success(res.msg);
          // window.location.replace(res.redirect);
        }
        setTimeout(function () {
          $("#saveuser").html("update");
        }, 3000);
      },
    });
  });

  $(".check-duplicate").on("blur", function (e) {
    var tocheck = $(this).attr("id");
    var value = $(this).val().trim();
    //checkDuplicateDetails
    var sel = $(this);
    if (value != "") {
      isDataValid = false;
      $.ajax({
        type: "POST",
        url: base_url + "checkDuplicate",
        data: { tocheck: tocheck, value: value },
        datatype: "JSON",
        beforeSend: function (request) {},
        success: function (res) {
          res = JSON.parse(res);
          if (res.flag == "F") {
            var msg = alertify.error("Default message");
            msg.delay(3).setContent(res.msg);
            //alertify.error(res.msg);
            $(sel).val("");
            $(".edu-details").hide();
            $(".personl-section").show();
          } else {
            isDataValid = true;
          }
        },
      });
    }
  });

  $("#contactUsForm").submit(function (e) {
    e.preventDefault(); // avoid to execute the actual submit of the form.
    var form = $(this);
    var url = form.attr("action");
    var method = form.attr("method");
    $.ajax({
      type: method,
      url: url,
      data: form.serialize(), // serializes the form's elements.
      datatype: "JSON",
      beforeSend: function (request) {
        $("#save").html("<span>SENDING..</span>");
      },
      success: function (res) {
        res = JSON.parse(res);

        if (res.flag == "F") {
          var msg = alertify.error("Default message");
          msg.delay(3).setContent(res.msg);
        }
        //alertify.error(res.msg);
        if (res.flag == "S") {
          var msg = alertify.success("Default message");
          msg.delay(3).setContent(res.msg);
          //alert(res.msg);
          location.reload();
        }
        setTimeout(function () {
          $("#save").html("SEND");
        }, 3000);
      },
    });
  });

  $(".replaceState").on("change", function (e) {
    //alert("hiiii");return;
    var valuetxt = $(e.currentTarget).val();
    //alert(valuetxt);
    var url = $(e.currentTarget).attr("data-action");
    //alert(url);
    $.ajax({
      type: "POST",
      url: url,
      data: { stateID: valuetxt }, // serializes the form's elements.
      datatype: "JSON",
      beforeSend: function (request) {},
      success: function (res) {
        res = JSON.parse(res);
        $("#collegel")
          .find("option")
          .remove()
          .end()
          .append('<option value="">Select College</option>');
        // $('#city').find('#city').remove().end().append('');
        if (res.flag == "F") {
        } // alert(res.msg);
        if (res.flag == "S") {
          //console.log(opt)
          //alert(res.data)
          if (res.data != "") {
            res.data.forEach(function (opt) {
              $("#collegel").append(
                "<option value='" +
                  opt.college_id +
                  "'>" +
                  opt.college_name +
                  "</option>"
              );
            });
          }
        }
        $("#collegel").append("<option value='other'>Other</option>");
        setTimeout(function () {
          $("#save").html("");
        }, 3000);
      },
    });
  });

  $(".replacecollege").on("change", function (e) {
    //alert("hiiii");return;
    var valuetxt = $(e.currentTarget).val();
    //alert(valuetxt);
    var url = $(e.currentTarget).attr("data-action");
    //alert(url);
    $.ajax({
      type: "POST",
      url: url,
      data: { college_id: valuetxt }, // serializes the form's elements.
      datatype: "JSON",
      beforeSend: function (request) {},
      success: function (res) {
        res = JSON.parse(res);
        $("#city").find("#city").remove().end().append("");
        $("#cityList").val("");
        if (res.flag == "F") {
        }
        if (res.flag == "S") {
          if (res.data != "") {
            $("#cityList").val(res.data[0].city_name);
            $("#city").val(res.data[0].city_id);
          }
        }
        // $('#collList').append("<option value='other'>Other</option>");
        setTimeout(function () {
          $("#save").html("");
        }, 3000);
      },
    });
  });
  $(".changeCountry").on("change", function (e) {
    //alert("hiiii");
    var valuetxt = $(e.currentTarget).val();
    //alert(valuetxt);
    if (valuetxt != "") {
      $.ajax({
        type: "POST",
        url: base_url + "/getStateList",
        data: { telID: valuetxt }, // serializes the form's elements.
        datatype: "JSON",
        beforeSend: function (request) {},
        success: function (res) {
          res = JSON.parse(res);
          $("#state")
            .find("option")
            .remove()
            .end()
            .append('<option value="">Select</option>');
          $("#cityList").val("");
          if (res.flag == "F") {
          } // alert(res.msg);
          if (res.flag == "S") {
            if (res.data != "") {
              res.data.forEach(function (opt) {
                $("#state").append(
                  "<option value='" +
                    opt.state_id +
                    "'>" +
                    opt.state_name +
                    "</option>"
                );
              });
            }
          }
        },
      });
    } else {
      $("#cityList").val("");
      $("#state")
        .find("option")
        .remove()
        .end()
        .append('<option value="">Select</option>');
    }
  });

  $(".changeState").on("change", function (e) {
    //alert("hiiii");
    var valuetxt = $(e.currentTarget).val();
    //alert(valuetxt);
    var url = $(e.currentTarget).attr("data-action");
    if (valuetxt != "") {
      $.ajax({
        type: "POST",
        url: url,
        data: { stateID: valuetxt }, // serializes the form's elements.
        datatype: "JSON",
        beforeSend: function (request) {},
        success: function (res) {
          res = JSON.parse(res);
          $("#collegeList")
            .find("option")
            .remove()
            .end()
            .append('<option value="">Select</option>');
          $("#cityList").val("");
          if (res.flag == "F") {
          } // alert(res.msg);
          if (res.flag == "S") {
            if (res.data != "") {
              res.data.forEach(function (opt) {
                $("#collegeList").append(
                  "<option value='" +
                    opt.college_id +
                    "'>" +
                    opt.college_name +
                    "</option>"
                );
              });
            }
          }
          $("#collegeList").append("<option value='other'>Other</option>");
          setTimeout(function () {
            $("#save").html("");
          }, 3000);
        },
      });
    } else {
      $("#cityList").val("");
      $("#collegeList")
        .find("option")
        .remove()
        .end()
        .append('<option value="">Select</option>');
    }
  });

  $("#collegeList").on("change", function (e) {
    var valuetxt = $(e.currentTarget).val();
    if (valuetxt == "other") {
      $(".otherClgList").removeClass("hide");
      $(".otherCityList").removeClass("hide");
      $(".clgcity").addClass("hide");
    } else {
      $(".otherClgList").addClass("hide");
      $(".otherCityList").addClass("hide");
      $(".clgcity").removeClass("hide");
    }
  });

  $("#state").on("change", function (e) {
    var valuetxt = $(e.currentTarget).val();
    if (valuetxt == "other") {
      $(".otherClgList").removeClass("hide");
      $(".otherCityList").removeClass("hide");
      $(".clgcity").addClass("hide");
    } else {
      $(".otherClgList").addClass("hide");
      $(".otherCityList").addClass("hide");
      $(".clgcity").removeClass("hide");
    }
  });

  $(".changecollege").on("change", function (e) {
    //alert("hiiii");
    var valuetxt = $(e.currentTarget).val();
    //alert(valuetxt);
    var url = $(e.currentTarget).attr("data-action");
    // alert(url);return;
    if (valuetxt != "") {
      $.ajax({
        type: "POST",
        url: url,
        data: { college_id: valuetxt }, // serializes the form's elements.
        datatype: "JSON",
        beforeSend: function (request) {},
        success: function (res) {
          res = JSON.parse(res);
          $("#city").find("#city").remove().end().append("");
          $("#cityList").val("");
          if (res.flag == "F") {
          } // alert(res.msg);
          if (res.flag == "S") {
            // console.log(opt)
            //alert(res.data)
            if (res.data != "") {
              $("#cityList").val(res.data[0].city_name);
              $("#city").val(res.data[0].city_id);
            }
          }
          // $('#collList').append("<option value='other'>Other</option>");
          setTimeout(function () {
            $("#save").html("");
          }, 3000);
        },
      });
    } else {
      $("#cityList").val("");
    }
  });
  $(".dash-save").click(function () {
    $(".dask-updateEduProfile").submit();
    return false;
  });
});
