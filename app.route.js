var app = angular.module('myApp', ['ngRoute', 'ngMaterial', 'ngStorage']);

app.config(function($routeProvider){
	$routeProvider
	.when("/home",
		{
			templateUrl:"partials/home.html",
			controller:"homeCtrl"
		}
	     )
	.when("/login",
		{
			templateUrl:"partials/login.html",
			controller:"loginCtrl"
		}
         )
    .when("/search",
		{
			templateUrl:"partials/Search.html",
			controller:"searchCtrl"
		}
	     )
	.otherwise(
		{
			redirectTo:"/home"
		}
	);
});

app.factory('AuthService', function(){
    var user ={
        username:'default',
        admin: 0
    };
    
    user.isLoggedIn = function(){
		if(user.username != 'default')
			return true;
		else
			return false;
    };
    
    user.isAdmin = function(){
		//console.log(user);
		if(user.admin==1)
			return true;
		else
			return false;
    };

    return user;
});

app.run(['$rootScope', '$location', 'AuthService', function ($rootScope, $location, AuthService) {
    $rootScope.$on('$routeChangeStart', function (event, next, current) {

        if (!AuthService.isLoggedIn()) {
            console.log('No User Logged in!');
            $location.path('/login');
		}
    });
}]);

app.controller('homeCtrl',function($scope,$location){
	$scope.gotoLogin = function () {
		$location.path('/login');
	};
});

app.controller('loginCtrl', function($scope,$location,$http,$localStorage, AuthService){
	$scope.login = function(){
		$http.post(
            "ajax/login.php",
            { 'username':$scope.username, 'password':$scope.password}
        ).success(function(data){
            if(data==null){
                alert('Wrong username or password! Try again.')
            }
            else
            {
				console.log(data);
				AuthService.username = data[0].username;
				AuthService.admin = data[0].admin;
                console.log(AuthService);
				$scope.$storage = $localStorage.$default({user:AuthService});
				$location.path('/search');
            }

        });
	}; 
});

app.controller("searchCtrl", function($scope, $http) {
    $scope.initSearch = function(){
        $http.get(
            "api/initialSearch.php"
        ).success(function(data){
            $scope.crimeList = data;
            console.log($scope.crimeList);
        });
    };

    $scope.search = function(){
        if($scope.keyword == null)
            alert("Please input a field");
        else{
            $http.post(
                "api/getCrimeData.php",
                {'keyword':$scope.keyword}
            ).success(function(data){
                $scope.crimeList = data;
                console.log($scope.crimeList);
            });
        }
    };
});
