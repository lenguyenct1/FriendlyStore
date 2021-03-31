@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Thống kê doanh thu  trong tuần
    </div>
   
     <div id="chartContainer" style="height: 300px; width: 100%;"></div>
     
      <button id="printChart"  class="btn btn-info">In biểu đồ</button> 
 
  
  </div>
  
</div>
<script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
  animationEnabled: true,
  theme: "light2", // "light1", "light2", "dark1", "dark2"
  title:{
    text: "Doanh thu trong tuần"
  },
   exportEnabled: true,
  axisY: {
    title: "Doanh thu"
  },
  data: [{        
    type: "column",  
    showInLegend: true, 
    legendMarkerColor: "grey",
    legendText: "Ngày",
    dataPoints: [      
     <?php
   foreach($stats as $rows)
   {
    echo "{label:'{$rows->date}',y:{$rows->value} },";
   }
   ?>
    ]
  }]
});
chart.render();
document.getElementById("printChart").addEventListener("click",function(){
      chart.print();
    }); 
}
</script>
@endsection