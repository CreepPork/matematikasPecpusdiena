require('./extensions/Chart.bundle.min');

$(document).ready(function () {
    $.get("/charts/data", function(data)
    {
        // Set our primary variables for time chart
        var classes = data.map(a => a.class);

        // Time chart data (messy af)
        var timesTeam1 = data.map(a => a.timeTeam1);
        var timesTeam2 = data.map(a => a.timeTeam2);
        timesTeam1 = timesTeam1.filter(a => a.replace('-1', '0'));
        timesTeam2 = timesTeam2.filter(a => a.replace('-1', '0'));
        var timesTeam1New = [];
        var timesTeam2New = [];
        timesTeam1.forEach(function(element) {
            if (element === '-1')
            {
                timesTeam1New.push(element.replace('-1', '0'));
            }
            else
            {
                timesTeam1New.push(element.replace(':', '.'));
            }
        }, this);
        timesTeam2.forEach(function(element) {
            if (element === '-1')
            {
                timesTeam2New.push(element.replace('-1', '0'));
            }
            else
            {
                timesTeam2New.push(element.replace(':', '.'));
            }
        }, this);
        
        // Time chart
        var timeChartElement = document.getElementById('timeChart').getContext('2d');
        var timeChart = new Chart (timeChartElement, {
            type: 'line',
            data: {
                labels: classes,
                datasets: [{
                    label: '1. komanda',
                    data: timesTeam1New,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)'
                    ],
                    borderWidth: 1
                },
                {
                    label: '2. komanda',
                    data: timesTeam2New,
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.2)'
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        },
                        scaleLabel: {
                            display: true,
                            labelString: 'Laiks (mm.ss)'
                        }
                    }],
                    xAxes: [{
                        scaleLabel: {
                            display: true,
                            labelString: 'Klase'
                        }
                    }]
                }
            }
        }); 
    }, "json");
});