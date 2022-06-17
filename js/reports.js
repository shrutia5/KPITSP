

=======
$(document).ready(function(){
  
  $("body").on("click","#excel",function(e){
    $("#report_type").val($(e.currentTarget).val());
    //$("#reportFilter").attr("target","_blank");
    $("#reportFilter").submit();
  });
  $("body").on("click","#pdf",function(e){
    $("#report_type").val($(e.currentTarget).val());
    $("#reportFilter").attr("target","_blank");
    $("#reportFilter").submit();
  });

  $("body").on("click","#filter",function(e){
    $("#report_type").val('');
    $("#reportFilter").attr("target","_self");
    $("#reportFilter").submit();
  });
  
  $("body").on("change",".dropChange",function(e){
    $("#reportFilter").submit();
  });

});

>>>>>>> b590bc205f44aee9bc2d135d8f46191a7647d65b
try{
const ctx = document.getElementById('year').getContext('2d');
const data = {
    labels: [
      '2022',
      '2023',
      '2024',
      '2025',
      '2026',
    ],
    datasets: [{
      label: 'Year wise Registration',
      data: [300, 50, 100,522,66],
      backgroundColor: [
        'rgb(255, 99, 132)',
        'rgb(54, 162, 235)',
        'rgb(255, 205, 86)',
        'rgb(200, 35, 89)',
        'rgb(156, 200, 36)'

      ],
      hoverOffset: 4
    }]
  };
  console.log(ctx);
  if(ctx != undefined){
    const myChart = new Chart(ctx, {
        type: 'doughnut',
        data: data,
        options: {
            responsive: true,
            plugins: {
            legend: {
                position: 'top',
            },
            title: {
                display: true,
                text: 'Chart.js Doughnut Chart'
            }
            }
        },
    });
  }
}catch(e){
    console.log("chat error",e);
}

try{
    const ctx = document.getElementById('gender').getContext('2d');
    const data = {
        labels: lableGender,
        datasets: [{
          label: 'Year wise Registration',
          data: [300, 50, 100,522,66],
          backgroundColor: [
            'rgb(255, 99, 132)',
            'rgb(54, 162, 235)',
            'rgb(255, 205, 86)',
            'rgb(200, 35, 89)',
            'rgb(156, 200, 36)'
    
          ],
          hoverOffset: 4
        }]
      };
      console.log(ctx);
      if(ctx != undefined){
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: {
                responsive: true,
                plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: ''
                }
                }
            },
        });
      }
    }catch(e){
        console.log("chat error",e);
    }
    try{
        const ctx = document.getElementById('statData').getContext('2d');

        const data = {
            labels: ['w1','w2'],
            datasets: [
                {
                    label: 'Dataset 1',
                    data: [10,22],
                    backgroundColor:['rgb(255, 99, 132)'],
                },
                {
                    label: 'Dataset 1',
                    data: [10,22],
                    backgroundColor:['rgb(54, 162, 235)'],
                },
            ]
          };
          console.log(ctx);
=======
       // var daat = JSON.parse(datastat);
        const data = {
            labels: dataLabel,
            datasets: [
                {
                    label: 'Users',
                    data: datastat,
                    backgroundColor:['rgb(255, 99, 132)'],
                },
                {
                    label: 'Projects',
                    data: dataProject,
                    backgroundColor:['rgb(54, 162, 235)'],
                },
                
            ]
          };
>>>>>>> b590bc205f44aee9bc2d135d8f46191a7647d65b
          if(ctx != undefined){
            const myChart = new Chart(ctx, {
                type: 'bar',
                data: data,
                options: {

                    responsive: true,
                    plugins: {
                    legend:false,
                    title: {
                        display: true,
                        text: 'Statstics'
=======
                    scales: {
                      y: {
                        suggestedMin: 50,
                        suggestedMax: 100
                      }
                    },
                    responsive: true,
                    plugins: {
                    legend:true,
                    title: {
                        display: true,
                        text: 'Weekwise User register and project submission'
>>>>>>> b590bc205f44aee9bc2d135d8f46191a7647d65b
                    }
                    }
                },
            });
          }
        }catch(e){
            console.log("chat error",e);
        }

    