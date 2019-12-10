/* globals Chart:false, feather:false */

$(document).ready(function() {
  (function () {
    'use strict'

      console.log('Requesting JSON');
      $.ajax({
        url: '/todoapp/db/top-five.php', 
        dataType: 'json',
        cache: false,
        success: function(users) {
          console.log('JSON received');
          let labels = [];
          let data = [];
          users.forEach(user => {
            labels.push(user.fullname);
            data.push(user.count_todos);
          });

          // Line Chart
          let lctx = $('#lineChart')
          // eslint-disable-next-line no-unused-vars
          let lineChart = new Chart(lctx, {
            type: 'line',
            data: {
              labels,
              datasets: [{
                data,
                lineTension: 0,
                backgroundColor: 'transparent',
                borderColor: '#007bff',
                borderWidth: 4,
                pointBackgroundColor: '#007bff'
              }]
            },
            options: {
              scales: {
                yAxes: [{
                  ticks: {
                    beginAtZero: false
                  }
                }]
              },
              legend: {
                display: false
              }
            }
          })
          
          // Bar Chart
          let ctx = $('#barChart')
          // eslint-disable-next-line no-unused-vars
          let barChart = new Chart(ctx, {
            type: 'bar',
            data: {
              labels,
              datasets: [{
                data,
                lineTension: 0,
                backgroundColor: 'transparent',
                borderColor: '#007bff',
                borderWidth: 4,
                pointBackgroundColor: '#007bff'
              }]
            },
            options: {
              scales: {
                yAxes: [{
                  ticks: {
                    beginAtZero: false
                  }
                }]
              },
              legend: {
                display: false
              }
            }
          })
        }
      });
      
  
    //feather.replace()
  
    
  }())
  
  
});