@extends('back-end.layout.app')
@section('title')
Dashboard
@endsection
@section('content')
@component('back-end.layout.header', ['nav' => 'Dashboard', 'Nonsearch' => 'nonsearch'])
@endcomponent

@include('back-end.home-sections.statistics')
@include('back-end.home-sections.users-highchart')
@include('back-end.home-sections.videos-barchart')
@include('back-end.home-sections.tables')

@endsection

@push('js')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" integrity="sha512-d9xgZrVZpmmQlfonhQUvTR7lMPtO7NkZMkA0ABN3PHCbKA5nqylQ/yWlFAyY6hYgdF1Qh6nYiuADWwKB4C2WSw==" crossorigin="anonymous"></script>

<script>
	$(function(){
		var newData = new Date();
		var year = newData.getFullYear();
		var videos = <?php echo json_encode($videosCountChart); ?>;
		var barcanvas = $('#barchart');
		var barchart = new Chart(barcanvas, {
			type: 'bar',
			data:{
				labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
				datasets: [
					{
						label: 'New Video Growth, ' + year,
						data: videos,
						backgroundColor: ['#DAF7A6', '#FFC300', '#FF5733', '#C70039', '#900C3F', '#581845', '#1B4F72', 'purple', '#0B5345', '#424949', '#7E5109', 'silver']
					}
				]
			},
			options:{
				scales:{
					yAxes:[{
						ticks:{
							beginAtZero: true
						}
					}]
				}
			}
		});
	});
</script>

<script>
	var newData = new Date();
	var year = newData.getFullYear();

	var datas = <?php echo json_encode($usersCountChart); ?>

	Highcharts.chart('chart-container', {
		title:{
			text: "New User Growth, " + year 
		},
		subtitle:{
			text: "Source: Senior Step"
		},
		xAxis:{
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		},
		yAxis:{
			title:{
				text: 'Number Of New User'
			}
		},
		legend:{
			layout: 'vertical',
			align: 'right',
			verticalAlign: 'middle'
		},
		plotOptions:{
			series:{
				allowPointSelect: true
			}
		},
		series:[{
			name: 'New User',
			data: datas
		}],
		responsive:{
			rules:[{
				condition:{
					maxWidth:500
				},
				chartOptions:{
					legend:{
						layout:'horizontal',
						align: 'center',
						verticalAlign: 'bottom'
					}
				}
			}]
		}
	});
</script>
@endpush