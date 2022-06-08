
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
                    }
                    }
                },
            });
          }
        }catch(e){
            console.log("chat error",e);
        }

    