$(document).ready(function () {
  if (typeof DataTable === "function") {
    $("#incubatorFinalist").DataTable({
      scrollX: true,
    });
  }
  if (typeof DataTable === "function") {
    $("#incubatorSparkle2020").DataTable();
  }
  if (typeof DataTable === "function") {
    $("#incubatorSparkle2019").DataTable();
  }
  $(".incubateSelect").on("click", function (e) {
    e.preventDefault();
    var incubateId = $(this).attr("data-id");
    validateStatus(incubateId, "Remove");
  });
  $(".incubateRemove").on("click", function (e) {
    e.preventDefault();
    var incubateId = $(this).attr("data-id");
    validateStatus(incubateId, "Select");
  });
  $(".invoFilter").on("change", function (e) {
    var status = $(this).val();
    window.open(base_url + "incubator/dashboard" + "?type=" + status, "_self");
  });
  //$('#example').DataTable();
});

function validateStatus(incubateId, incubate) {
  $.ajax({
    type: "POST",
    url: base_url + "incubateStatus",
    data: { incubateAction: incubate, incubateId: incubateId },
    datatype: "JSON",
    beforeSend: function (request) {},
    success: function (res) {
      res = JSON.parse(res);
      if (res.flag == "F") {
        var msg = alertify.error("Default message");
        msg.delay(3).setContent(res.msg);
        setTimeout(function () {
          location.reload();
        }, 3000);
      } else {
        if (incubate == "Remove") {
          alertify.confirm(
            "",
            "Are you sure want to add this project from the list of your selection?",
            function () {
              $.ajax({
                type: "POST",
                url: base_url + "incubateAction",
                data: { incubateAction: incubate, incubateId: incubateId },
                datatype: "JSON",
                beforeSend: function (request) {},
                success: function (res) {
                  location.reload();
                },
              });
            },
            function () {}
          );
        } else {
          alertify.confirm(
            "",
            "Are you sure want to remove this project from the list of your selection?",
            function () {
              $.ajax({
                type: "POST",
                url: base_url + "incubateAction",
                data: { incubateAction: incubate, incubateId: incubateId },
                datatype: "JSON",
                beforeSend: function (request) {},
                success: function (res) {
                  location.reload();
                },
              });
            },
            function () {}
          );
        }
      }
    },
  });
}
