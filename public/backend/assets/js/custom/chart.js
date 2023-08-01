var SampleChartClass;

(function($){
    $(document).ready(function(){

        var labels = Object.keys(ptypeData);
        var data = Object.values(ptypeData);

        var schedLabels = Object.keys(pschedData);
        var schedData = Object.values(pschedData);

        var barChart = document.getElementById('myBarChart');
        BarChartClass.ChartData(barChart, 'bar', labels, data);

        var pieChart = document.getElementById('myPieChart');
        PieChartClass.ChartData(pieChart, 'pie', schedLabels, schedData);

    });

    BarChartClass = {

        ChartData:function(barChart, type, labels, data){
            new Chart(barChart, {
                type: type,
                data: {
                  labels: labels,
                  datasets: [{
                    label: '# of Properties',
                    data: data,
                    borderWidth: 1
                  }]
                },
                options: {
                  layout: {
                    padding: 20
                  },
                  scales: {
                    y: {
                      beginAtZero: true
                    }
                  }
                }
              });
          }

    }

    PieChartClass = {

      ChartData:function(pieChart, type, labels, data){
          new Chart(pieChart, {
              type: type,
              data: {
                labels: labels,
                datasets: [{
                  label: '# of Schedules',
                  data: data,
                  borderWidth: 1
                }]
              },
              options: {
                layout: {
                  padding: 20
                },
                scales: {
                  y: {
                    beginAtZero: true
                  }
                }
              }
            });
        }

    }

})(jQuery);