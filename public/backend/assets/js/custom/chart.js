var SampleChartClass;

(function ($) {
  $(document).ready(function () {

    var labels = Object.keys(ptypeData);
    var data = Object.values(ptypeData);

    var schedLabels = Object.keys(pschedData);
    var schedData = Object.values(pschedData);

    var wishLabels = Object.keys(pWishData);
    var wishData = Object.values(pWishData);

    var doughnutChart = document.getElementById('myDoughnutChart');
    DoughnutChartClass.ChartData(doughnutChart, 'doughnut', labels, data);

    var pieChart = document.getElementById('myPieChart');
    PieChartClass.ChartData(pieChart, 'pie', schedLabels, schedData);

    var barChart = document.getElementById('myBarChart');
    BarChartClass.ChartData(barChart, 'bar', wishLabels, wishData);

  });

  DoughnutChartClass = {

    getRandomColor: function (alpha) {
      alpha = alpha || 0.55;
      const randomColor = `rgba(${Math.floor(Math.random() * 256)}, ${Math.floor(Math.random() * 256)}, ${Math.floor(Math.random() * 256)}, ${alpha})`;
      return randomColor;
    },

    ChartData: function (doughnutChart, type, labels, data) {

      const colors = data.map(() => this.getRandomColor());
      new Chart(doughnutChart, {
        type: type,
        data: {
          labels: labels,
          datasets: [{
            label: '# of Properties',
            data: data,
            borderWidth: 1,
            backgroundColor: colors,
          }]
        },
        options: {
          layout: {
            padding: 20
          },
          plugins: {
            legend: {
                labels: {
                    color: 'white'
                }
            }
          }
        }
      });
    }

  }

  PieChartClass = {

    ChartData: function (pieChart, type, labels, data) {
      new Chart(pieChart, {
        type: type,
        data: {
          labels: labels,
          datasets: [{
            label: '# of Schedules',
            data: data,
            borderWidth: 1,
          }]
        },
        options: {
          layout: {
            padding: 20
          },
          plugins: {
            legend: {
                labels: {
                    color: 'white'
                }
            }
          }
        }
      });
    }

  }

  BarChartClass = {

    getRandomColor: function (alpha) {
      alpha = alpha || 0.55;
      const randomColor = `rgba(${Math.floor(Math.random() * 256)}, ${Math.floor(Math.random() * 256)}, ${Math.floor(Math.random() * 256)}, ${alpha})`;
      return randomColor;
    },

    ChartData: function (barChart, type, wishLabels, wishData) {

      const colors = wishData.map(() => this.getRandomColor());
      new Chart(barChart, {
        type: type,
        data: {
          labels: wishLabels,
          datasets: [{
            label: '# of Wish',
            data: wishData,
            borderWidth: 1,
            backgroundColor: colors,
            borderColor: 'rgb(255,255,255)',
          }]
        },
        options: {
          layout: {
            padding: 20
          },
          scales: {
            y: {
              ticks: {
                color: 'white'
              },
              beginAtZero: true,
              grid: {
                color: 'rgba(129, 177, 199, 0.5)'
              },
            },
            x: {
              ticks: {
                color: 'white'
              },
              grid: {
                color: 'rgba(129, 177, 199, 0.5)'
              },
            }
          },
          indexAxis: 'y',
          plugins: {
            legend: {
                labels: {
                    color: 'white'
                }
            }
          }
        }
      });
    }

  }

})(jQuery);