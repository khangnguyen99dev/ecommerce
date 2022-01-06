@extends('back-end.layouts.master')

@section('title')
	Trang Chủ
@endsection

@section('content')

<div class="row">

	<!-- Area Chart -->
	<div class="col-xl-12 col-lg-12">
		<div class="card shadow mb-4">
			<!-- Card Header - Dropdown -->
			
			<div
				class="card-header  align-items-center justify-content-between">
				<!-- <h6 class="m-0 font-weight-bold text-primary">Earnings Overview</h6> -->
				<div class="row">
					@csrf
					<input type="date" id="from-date" class="form-control col-xl-2 col-lg-2 mr-2" placeholder="Từ ngày"></p>
					<input type="date" id="to-date" class="form-control col-xl-2 col-lg-2 mr-2" placeholder="Đến ngày"></p>
					<button class="form-control btn btn-small btn-primary col-xl-2 col-lg-2 js-order-chart" id="js-order-chart">Xác nhận</button>
					<select class="form-control col-xl-2 col-lg-2 select-staticical" style="margin-left: auto">
						<option>-- Chọn --</option>
						<option value="7day">7 ngày qua</option>
						<option value="lastMonth">Tháng trước</option>
						<option value="thisMonth">Tháng này</option>
						<option value="currentYear" id="currentYear">Năm hiện tại</option>
					</select>
				</div>
			</div>
			<!-- Card Body -->
			<div class="card-body">
				<div class="chart-area">

					<div id="myAreaChart"></div>

				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
    $(function() {
		$.ajax({
			type: 'POST',
			url: "/staticical",
			success: (data)=>{
				$('#myAreaChart').html('');
				let chart = new Morris.Line({
					element: 'myAreaChart',
					xkey: 'date',
					ykeys: ['money'],
					labels: ['Tổng tiền']
				});		
				chart.setData(data);	
			}
		})        
    })
	$(document).on('click', '.js-order-chart', function (e) {
		let from_date = $('#from-date').val();
		let to_date = $('#to-date').val();
		$.ajax({
			type: 'GET',
			url: "/filterDate",
			data: {
				from_date:from_date,
				to_date:to_date,
			},
			success: (data) => {
				console.log(data)
				$('#myAreaChart').html('');
				let chart = new Morris.Line({
					element: 'myAreaChart',
					xkey: 'date',
					ykeys: ['money'],
					labels: ['Tổng tiền']
				});		
				chart.setData(data);	
			}
		})
	})


	$(document).on('change', '.select-staticical', function (e) {
		let select = $(this).val();
		$.ajax({
			type: 'POST',
			url: "/staticical",
			data: {
				'select':select
			},
			success: (data)=>{
				$('#myAreaChart').html('');
				let chart = new Morris.Line({
					element: 'myAreaChart',
					xkey: 'date',
					ykeys: ['money'],
					labels: ['Tổng tiền']
				});		
				chart.setData(data);	
			}
		})
	})
</script>
@endsection