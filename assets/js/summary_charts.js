$(function(){
	
	let summary_chart = document.querySelector('#example_chart canvas').chart;
    
    $(window).on('load', function(){
        
        // When the document is clicked, update the chart 
        // with a random value and animate it.
        
        summary_chart.data.datasets[0].data[0] = Math.random()*10000;
        summary_chart.data.datasets[0].data[1] = Math.random()*10000;
        summary_chart.data.datasets[0].data[2] = Math.random()*10000;
        summary_chart.data.datasets[0].data[3] = Math.random()*10000;
        summary_chart.data.datasets[0].data[4] = Math.random()*10000;
        summary_chart.data.datasets[0].data[5] = Math.random()*10000;
        summary_chart.data.datasets[0].data[6] = Math.random()*10000;
        summary_chart.data.datasets[0].data[7] = Math.random()*10000;
        summary_chart.update();
    });
    
    
    
});