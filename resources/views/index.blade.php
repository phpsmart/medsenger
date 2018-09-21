<!doctype html>
<html ng-app="myApp">
<head>
	<meta charset="utf-8" />

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

	<!-- Angular JS 1.6.9 -->
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
</head>
<body>
	<style>
		.font-weight {
			font-weight: 450;
		}
	</style>
	
	<script>		
		var app = angular.module('myApp', []);
		
		app.controller('GetBillboardController', function($scope, $http, $interval) {
			$scope.response={};
			
			$http.get("/index").then(function (response) {
					$scope.names = response.data.records;
					//console.log(response.data.records);
			});
			
			$interval(function () {	
				$http.get("/index").then(function (response) {
					$scope.names = response.data.records;
					console.log(response);
					//console.log(response.data.records);
					//console.log(response.data._debug);
				});

				$scope.theTime = new Date().toLocaleTimeString();

			}, 3000);			
		});
		
		app.controller('UpdateBillboardController', function ($scope, $http) {
			$scope.response={};
			
			$scope.save = function (answer, answerForm) {
				if (answerForm.$valid) {
					$http.post("/update", answer).then(function (response) {
						$scope.response = response.data;
						console.log(response.data);
						$scope.answer.message = '';
					});						
				}
			};
		});
	</script>

    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
        <h5 class="my-0 mr-md-auto font-weight-normal"> </h5>

		<div class="demo-navbar-user nav-item dropdown">
			<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
				<span class="d-inline-flex flex-lg-row-reverse align-items-center align-middle">
					<span class="px-1 mr-lg-2 ml-2 ml-lg-0">

					</span>
				</span>
			</a>
			<div class="dropdown-menu dropdown-menu-right">
				<a href="/" class="dropdown-item">
					<i class="ion ion-ios-person text-lightest"></i> &nbsp; Сайт</a>
				<a href="/" class="dropdown-item">
					<i class="ion ion-ios-mail text-lightest"></i> &nbsp; Авторизация</a>
				<a href="/" class="dropdown-item">
					<i class="ion ion-md-settings text-lightest"></i> &nbsp; Регистрация</a>
				<div class="dropdown-divider"></div>
				<a href="/" class="dropdown-item">
					<i class="ion ion-ios-log-out text-danger"></i> &nbsp; Выйти</a>
			</div>
		</div>
    </div>
	
	<div class="container">
		<div class="text-left">
			<h2>Доска объявлений</h2>
			<p class="lead">

			</p>
		</div>
	</div>
	
	<div class="container">
		<div class="row">          
			<div class="col-md-6">
				<form ng-controller="UpdateBillboardController" name="answerForm" class="needs-validation">
					<div class="row">
						<div class="col-md-12">
							<label for="answerText">Введите текст объявления </label>
							<input id="answerText" ng-model="answer.message" required class="form-control" />
							<br>
							<input ng-click="save(answer, answerForm)" class="btn btn-success btn-lg " type="submit" value="Сохранить">
						</div>
					</div>
				</form>
			</div>
		</div>
		<hr class="mb-12">
	</div>

	<div class="container">	
		<div class="row">
			<div ng-controller="GetBillboardController" class="col-md-12">
				<table class="table table-striped table-borderless table-hover table-sm">
					<tr>
						<th>id</th>
						<th>IP-адрес клиента</th>
						<th>Дата</th>
						<th>Объявление</th>
					</tr>
					<tr ng-repeat="x in names">
						<td> @{{ x.id }}</td>
						<td> @{{ x.remote_addr }}</td>
						<td> @{{ x.create_at }}</td>
						<td> <span class="font-weight">@{{ x.name }}</span></td>

					</tr>
				</table>
			</div>
		</div>
	</div>
	
	<hr class="mb-12">
	
	<div class="container">
      <footer class="my-5 text-muted text-center text-small">
        <p class="mb-1">© <?php echo date('Y'); ?> Доска объявлений</p>

      </footer>
    </div>
</body>
</html>
