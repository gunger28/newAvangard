
window.onload = () => {
    if(getOptions()[0] != undefined){
        drawGraph();
    
    }

    console.log(getOptions());
};

function getOptions(){
let options = [];
option_divs = document.querySelectorAll(".conv");
option_divs.forEach(element => {
    options.push(element.textContent);
});

console.log(options[0]);
return options;
}

function drawGraph(){
params = getOptions();
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawConversion);
    google.charts.setOnLoadCallback(drawSystems);
    google.charts.setOnLoadCallback(drawAmountUsers);
    
    function drawConversion() {
    
      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Topping');
      data.addColumn('number', 'Slices');
      data.addRows([
            [params[0],parseInt(params[1])],
            [params[2],parseInt(params[3])]

    ]);
    
      var options = {'title':'Отношение: Посетители/заказы',
      "is3D": true,
                     'width':'100%',
                     height: '100%'
                     };
      var chart = new google.visualization.PieChart(document.getElementById('conversion'));
      chart.draw(data, options);
    }

    function drawSystems() {
    
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
              [params[4],parseInt(params[5])],
              [params[6],parseInt(params[7])],
              [params[8],parseInt(params[9])]
  
      ]);
      
        var options = {'title':'Системы',
        
        pieHole: 0.4,
                       'width':'100%',
                      height: '100%'};
        var chart = new google.visualization.PieChart(document.getElementById('systems'));
        chart.draw(data, options);
      }



      function drawAmountUsers() {
    
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
              [params[0],parseInt(params[1])],
              [params[2],parseInt(params[3])]
  
      ]);
      
        var options = {'title':'Отношение: Посетители/заказы',
        is3D: true,
        pieHole: 0.4,
                       'width':'100%',
                       height: '100%'};
        var chart = new google.visualization.PieChart(document.getElementById('amount_users'));
        chart.draw(data, options);
      }
    

};

