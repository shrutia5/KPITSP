$(document).ready(function () {
  $("body").on("click", "#excel", function (e) {
    $("#report_type").val($(e.currentTarget).val());
    //$("#reportFilter").attr("target","_blank");
    $("#reportFilter").submit();
  });
  $("body").on("click", "#pdf", function (e) {
    $("#report_type").val($(e.currentTarget).val());
    $("#reportFilter").attr("target", "_blank");
    $("#reportFilter").submit();
  });

  $("body").on("click", "#filter", function (e) {
    $("#report_type").val("");
    $("#reportFilter").attr("target", "_self");
    $("#reportFilter").submit();
  });

  $("body").on("change", ".dropChange", function (e) {
    $("#report_type").val("");
    $("#reportFilter").attr("target","_self");
    $("#reportFilter").submit();
  });
});

try {
  const ctx = document.getElementById("year").getContext("2d");
  const data = {
    labels: ["2022", "2023", "2024", "2025", "2026"],
    datasets: [
      {
        label: "Year wise Registration",
        data: [300, 50, 100, 522, 66],
        backgroundColor: [
          "rgb(255, 99, 132)",
          "rgb(54, 162, 235)",
          "rgb(255, 205, 86)",
          "rgb(200, 35, 89)",
          "rgb(156, 200, 36)",
        ],
        hoverOffset: 4,
      },
    ],
  };
  console.log(ctx);
  if (ctx != undefined) {
    const myChart = new Chart(ctx, {
      type: "doughnut",
      data: data,
      options: {
        responsive: true,
        plugins: {
          legend: {
            position: "top",
          },
          title: {
            display: true,
            text: "Chart.js Doughnut Chart",
          },
        },
      },
    });
  }
} catch (e) {
  console.log("chat error", e);
}

try {
  const ctx = document.getElementById("year").getContext("2d");
  const data = {
    labels: lableYears,
    datasets: [
      {
        label: "Year wise Registration",
        data: [300, 50, 100, 522, 66],
        backgroundColor: [
          "rgb(255, 99, 132)",
          "rgb(54, 162, 235)",
          "rgb(255, 205, 86)",
          "rgb(200, 35, 89)",
          "rgb(156, 200, 36)",
        ],
        hoverOffset: 4,
      },
    ],
  };
  console.log(ctx);
  if (ctx != undefined) {
    const myChart = new Chart(ctx, {
      type: "bar",
      data: data,
      options: {
        responsive: true,
        plugins: {
          legend: {
            position: "top",
          },
          title: {
            display: true,
            text: "",
          },
        },
      },
    });
  }
} catch (e) {
  console.log("chat error", e);
}
try {
  const ctx = document.getElementById("statData").getContext("2d");
  // var daat = JSON.parse(datastat);
  const data = {
    labels: dataLabel,
    datasets: [
      {
        label: "Users",
        data: datastat,
        backgroundColor: ["rgb(255, 99, 132)"],
      },
      {
        label: "Projects",
        data: dataProject,
        backgroundColor: ["rgb(54, 162, 235)"],
      },
    ],
  };
  if (ctx != undefined) {
    const myChart = new Chart(ctx, {
      type: "bar",
      data: data,
      options: {
        scales: {
          y: {
            suggestedMin: 50,
            suggestedMax: 100,
          },
        },
        responsive: true,
        plugins: {
          legend: true,
          title: {
            display: true,
            text: "Weekwise user registration and project submissions",
          },
        },
      },
    });
  }
} catch (e) {
  console.log("chat error", e);
}

try {
  const ctx = document.getElementById("gender").getContext("2d");
  // var daat = JSON.parse(datastat);
  const data = {
    labels: dataLabel,
    datasets: [
      {
        label: "Male",
        data: dataMale,
        backgroundColor: ["rgb(54, 162, 235)"],
      },
      {
        label: "Female",
        data: dataFemale,
        backgroundColor: ["rgb(255, 99, 132)"],
      },
      {
        label: "Other",
        data: dataOther,
        backgroundColor: ["rgb(185, 38, 183)"],
      },
    ],
  };
  if (ctx != undefined) {
    const myChart = new Chart(ctx, {
      type: "bar",
      data: data,
      options: {
        scales: {
          y: {
            suggestedMin: 10,
            suggestedMax: 100,
          },
        },
        responsive: true,
        plugins: {
          legend: true,
          title: {
            display: true,
            text: "Gender wise project submission",
          },
        },
      },
    });
  }
} catch (e) {
  console.log("chat error", e);
}
