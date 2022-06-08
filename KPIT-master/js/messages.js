$(document).ready(function () {
  $("#sendMsg").click(function () {
    var sendid = $("#senderId").val();
    var recid = $("#recId").val();
    var getmsg = $("#messagetxt").val().trim();
    if (getmsg != "") {
      $.ajax({
        type: "POST",
        url: base_url + "messageSend/",
        data: { message: getmsg, project_id: $("#projectid").val() },
        datatype: "JSON",
        beforeSend: function (request) {
          $("#saveuser").html("<span>Sending..</span>");
        },
        success: function (res) {
          res = JSON.parse(res);
          if (res.flag == "F") alert(res.msg);

          if (res.flag == "S") {
            var msg =
              '<div class="row"><div class="col-md-10 col-10 p-2"><div class="left-chat"><p class="msg-p p-2">' +
              getmsg +
              '</p></div><span class="time-txt">Today, ' +
              res.msg +
              '</span></div><div class="col-md-2 col-2 p-0"><p class="right-txt">' +
              $("#sender_initials").val() +
              "</p></div></div>";
            //'<li class="sender"><div class="d-flex"><div class="message">'+getmsg+'</div><div class="icon-name"></div></div><span class="time">Now</span></li>';
            $(".conversations").append(msg);
            $("#messagetxt").val("");
            $(".messageout")
              .find(".body")
              .animate(
                {
                  scrollTop: $(".messageout")
                    .find(".body")
                    .prop("scrollHeight"),
                },
                1000
              );
          }
          setTimeout(function () {
            $("#saveuser").html("Send");
          }, 3000);
        },
      });
    }
  });
  $(".messageOpen").click(function () {
    // $(".messageout").find(".body").toggleClass("active");
    $(".messageout")
      .find(".body")
      .animate(
        { scrollTop: $(".messageout").find(".body").prop("scrollHeight") },
        1000
      );
    var sendid = $("#senderId").val();
    var recid = $("#recId").val();
    $.ajax({
      type: "POST",
      url: base_url + "readmessages/" + sendid + "/" + recid,
      datatype: "JSON",
      beforeSend: function (request) {
        $("#saveuser").html("<span>Sending..</span>");
      },
      success: function (res) {
        res = JSON.parse(res);
        if (res.flag == "F") alert(res.msg);

        if (res.flag == "S") {
          $(".unreadCount").remove();
        }
      },
    });
  });

  if ($(window).width() < 768) {
    $("#mobile-chatbox-body").addClass("active");
    $("#message-arrow-down-icon").removeClass("bxs-chevron-down");
  }
});
