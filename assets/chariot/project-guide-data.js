$(document).ready(function () {
  function sleepFor(sleepDuration, message) {
    return new Promise((resolve) => {
      setTimeout(resolve, sleepDuration);
      console.log(message);
    });
  }
  function willBeginTutorial(tutorial) {
    console.log("delegate - willBeginTutorial\n  tutorial:" + tutorial);
    return sleepFor(0, "willBeginTutorial promise resolved");
  }
  function willBeginStep(step, stepIndex, tutorial) {
    console.log(
      "delegate - willBeginStep\n  step:" +
        step +
        "\n  stepIndex:" +
        stepIndex +
        "\n  tutorial:" +
        tutorial
    );
    return sleepFor(0, "willBeginStep promise resolved");
  }
  function willShowOverlay(overlay, stepIndex, tutorial) {
    console.log(
      "delegate - willShowOverlay\n  overlay:" +
        overlay +
        "\n  stepIndex:" +
        stepIndex +
        "\n  tutorial:" +
        tutorial
    );
    return sleepFor(0, "willShowOverlay promise resolved");
  }
  function didShowOverlay(overlay, stepIndex, tutorial) {
    console.log(
      "delegate - didShowOverlay\n  overlay:" +
        overlay +
        "\n  stepIndex:" +
        stepIndex +
        "\n  tutorial:" +
        tutorial
    );
    return sleepFor(0, "didShowOverlay promise resolved");
  }
  function willRenderTooltip(tooltip, stepIndex, tutorial) {
    console.log(
      "delegate - willRenderTooltip\n  tooltip:" +
        tooltip +
        "\n  stepIndex:" +
        stepIndex +
        "\n  tutorial:" +
        tutorial
    );
    return sleepFor(0, "willRenderTooltip promise resolved");
  }
  function didRenderTooltip(tooltip, stepIndex, tutorial) {
    console.log(
      "delegate - didRenderTooltip\n  tooltip:" +
        tooltip +
        "\n  stepIndex:" +
        stepIndex +
        "\n  tutorial:" +
        tutorial
    );
    return sleepFor(0, "didRenderTooltip promise resolved");
  }
  function didFinishStep(step, stepIndex, tutorial) {
    $.ajax({
      type: "POST",
      url: base_url + "student/updateguide/student_project",
      datatype: "JSON",

      success: function (res) {
        res = JSON.parse(res);
        if (res.flag == "F") {
          var msg = alertify.error("Default message");
          msg.delay(3).setContent(res.msg);
          //  window.location.replace(res.redirect);
          // $('#password').focus();
        }
        //$('#userEmail').focus();
        if (res.flag == "S") {
          var msg = alertify.success("Default message");
          msg.delay(3).setContent(res.msg);
          msg.ondismiss = function () {
            window.location.replace(res.redirect);
          };
          //alertify.success(res.msg);
          //window.location.replace(res.redirect);
        }
      },
    });
  }
  function didFinishTutorial(tutorial, forced) {
    console.log(
      "delegate - didFinishTutorial\n  tutorial:" +
        tutorial +
        " forced:" +
        forced
    );
    return sleepFor(0, "didFinishTutorial promise resolved");
  }

  window.willBeginTutorial = willBeginTutorial;
  window.willBeginStep = willBeginStep;
  window.willShowOverlay = willShowOverlay;
  window.didShowOverlay = didShowOverlay;
  window.willRenderTooltip = willRenderTooltip;
  window.didRenderTooltip = didRenderTooltip;
  window.didFinishStep = didFinishStep;
  window.didFinishTutorial = didFinishTutorial;

  var delegate = window;
  chariot.startTutorial(
    [
      {
        selectors: "#add-max-four-members",
        tooltip: {
          className: "add-members-guide",
          position: "bottom",
          title: "Team formation",
          text:
            "You can add maximum 4 team members to your team. Refer to expertise guide during idea submission to choose your team carefully.",
        },
      },

      {
        selectors: ".chat-box-head",
        tooltip: {
          className: "chat-box-guide",
          position: "bottom",
          title: "Internal chat",
          text:
            "Use this chatbox to connect with the evaluation team from KPIT and they will help and guide you in the entire process.",
        },
      },
    ],
    delegate
  );
});
