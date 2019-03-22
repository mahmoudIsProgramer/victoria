///////menu////////////////////////
function openNav() {
    document.getElementById("mySidebar").style.width = "250px";
    document.getElementById("main").style.marginLeft = "250px";
}

function closeNav() {
    document.getElementById("mySidebar").style.width = "0";
    document.getElementById("main").style.marginLeft= "0";
}
/////////////////////////////////////
///grade classes display/////////////
  $(".grade-descrep").change(function(){
    $(".grade-classes").slideToggle(200);
  });
////////////////////////////////////////
//bar chart///

var ctx = document.getElementById("myChart").getContext("2d");
var myChart = new Chart(ctx, {
    type: 'bar',
    
    data: {
        labels: ["American"],
        datasets: [{
          label: 'American',
            data: [80,100],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                
            ],
            borderColor: [
                'rgba(255,99,132,1)',
               
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});
///////////////////////////////////////////////////////
/////level/////////
var ctx = document.getElementById("myChartLevel").getContext("2d");
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["Play", "Kids", "Grades"],
        datasets: [{
            label: 'Levels',
            data: [20, 90, 50,100],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});
/////////////////////////////////////////////////////////////
///////grades/////////////
var ctx = document.getElementById("myChartGrades").getContext("2d");
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["Grade1", "Grade2", "Grade3", "Grade4", "Grade5", "Grade6","Grade7", "Grade8", "Grade9", "Grade10", "Grade11", "Grade12"],
        datasets: [{
            label: 'Grades',
            data: [12, 19, 30, 50, 20, 30,10,45,22,61,88,45,100],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});

























