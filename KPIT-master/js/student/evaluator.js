"use strict";
var evprojects = "";
function selectProject(projectID) {
  if ($("#project-" + projectID).html() == "Select") {
    //updateSelection(projectID);
    $("#confirm-title").html("Project selection");
    $("#remove-msg").html(
      "Are you sure you want to select the project " +
        $("#project_link_" + projectID).html() +
        "?"
    );
    $("#removeConfirmModal").modal("show");
    $("#btnRemoveConfirm").attr("pid", projectID);
  } else {
    $("#confirm-title").html("Project Removal");
    $("#remove-msg").html(
      "Are you sure you want to remove the " +
        $("#project_link_" + projectID).html() +
        " from the inbox?"
    );
    $("#removeConfirmModal").modal("show");
    $("#btnRemoveConfirm").attr("pid", projectID);
    //confirmRemoveProject(projectID);
  }

  return false;
}

function confirmRemoveProject(projectID) {
  updateSelection(projectID);
}

function updateSelection(projectID) {
  $("#project-" + projectID).hide();

  $.ajax({
    type: "POST",
    url: base_url + "evaluator/select-project",
    data: { projectID: projectID, status: $("#project-" + projectID).html() },
    datatype: "JSON",
    success: function (res) {
      $("#project-" + projectID).show();
      if (res != "") {
        res = JSON.parse(res);
        if (res.flag == "F") {
          alertify.error(res.msg);
        }
        if (res.flag == "S") {
          if ($("#project-" + projectID).html() == "Select") {
            $("#selectionSuccess").modal("show");
            $("#ev-star-" + projectID).addClass("selection-star");
            $("#ev-star-" + projectID).html('<i class="bx bxs-star"></i>');
            $("#project-" + projectID).html("Remove");
            $("#selection-msg").html(
              "The selected idea " +
                $("#project_link_" + projectID).html() +
                " will now be available in the inbox"
            );
            alertify.success(
              "The selected idea " +
                $("#project_link_" + projectID).html() +
                " will now be available in the inbox"
            );

            setTimeout(function () {
              location.reload();
            }, 2000);
          } else {
            $("#selectionSuccess").modal("show");
            $("#project-" + projectID).html("Select");
            $("#ev-star-" + projectID).removeClass("selection-star");
            $("#ev-star-" + projectID).html('<i class="bx bx-star"></i>');
            alertify.success(
              "The selected idea " +
                $("#project_link_" + projectID).html() +
                " removed from inbox"
            );
            $("#selection-msg").html(
              "The selected idea " +
                $("#project_link_" + projectID).html() +
                " removed from inbox"
            );
          }
        }
      }
    },
  });

  return false;
}

$(document).ready(function () {
  console.log("vali");
  //console.log(getevallist)
  $("#evaluators-details").validate({
    rules: {
      innovation: {
        required: true,
      },
      business: {
        required: true,
      },
      scorereason: {
        required: true,
      },
      technical: {
        required: true,
      },
      environment: {
        required: true,
      },
      simulation: {
        required: true,
      },
    },
    messages: {
      innovation: {
        required: "Invention/ Innovation required",
      },
      business: {
        required: "Market Potential/ Business Case required",
      },
      scorereason: {
        required: "Reason for score required",
      },
      technical: {
        required: "Technical Process required",
      },
      environment: {
        required: "Impact on Environment/ Society required",
      },
      simulation: {
        required: "Product Readiness/ Simulation required",
      },
    },
    submitHandler: function (form) {
      alertify.confirm(
        "",
        "Are you sure want to submit the score?",
        function () {
          //return "";
          $("#btn-submit-evaluation").hide();
          $.ajax({
            type: "POST",
            url: base_url + "evaluator/save-project",
            data: $("#evaluators-details").serialize(),
            datatype: "JSON",
            success: function (res) {
              //$("#btn-submit-evaluation").show();

              if (res != "") {
                res = JSON.parse(res);
                if (res.flag == "F") {
                  alertify.error(res.msg);
                  $("#btn-submit-evaluation").show();
                }
                if (res.flag == "S") {
                  alertify.success(res.msg);
                }
              }
            },
          });
        },
        function () {}
      );
    },
  });
  try {
    if (getevallist == 1) {
      filterProjectList("");
    }
  } catch (ex) {}

  $(".ch-filter").click(function () {
    console.log("Filtering");
    var sList = "";
    $(".ch-filter").each(function () {
      if (this.checked) {
        sList += $(this).val() + ",";
      }
    });
    console.log(sList);
    filterProjectList(sList);
  });

  $("#btnRemoveConfirm").click(function () {
    confirmRemoveProject($(this).attr("pid"));
  });
  $("#evalUpdatePassword").validate({
    rules: {
      userPass: {
        required: true,
        pwcheck: true,
      },
      cpassword: {
        required: true,
        equalTo: "#userPass",
      },
      evaNDA: {
        required: true,
      },
    },
    messages: {
      userPass: {
        required: "Please Enter Your Password.",
        pwcheck:
          "Enter at least one uppercase, one lowercase, one number, and one special character",
      },
      cpassword: {
        required: "Please Enter Your Password.",
        equalTo: "Please enter the same password as above",
      },
      evaNDA: "Please Check The Non-Disclosure Agreement",
    },
    submitHandler: function (form) {
      var url = $("#evalUpdatePassword").attr("action");
      $("#evareset").hide();
      $.ajax({
        type: "POST",
        url: url,
        data: $("#evalUpdatePassword").serialize(),
        datatype: "JSON",
        success: function (res) {
          $("#evareset").show();
          res = JSON.parse(res);
          if (res.flag == "F") {
            var msg = alertify.error("Default message");
            msg.delay(3).setContent(res.msg);
          }
          if (res.flag == "S") {
            //alert("hiiii");
            var msg = alertify.success("Default message");
            msg.delay(3).setContent(res.msg);
            msg.ondismiss = function () {
              window.location.replace(res.redirect);
            };
          }
        },
      });
    },
  });
});

function filterProjectList(subCatIds) {
  $("#example").DataTable({
    // scrollX: true,
    destroy: true,
    ajax:
      base_url +
      "evaluator/dashboard?ajax=1&self_list=" +
      self_list +
      "&subCtIds=" +
      subCatIds,
  });
}
