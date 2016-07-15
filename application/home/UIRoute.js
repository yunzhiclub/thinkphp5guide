var app = angular.module('demo', ['ui.router']);

app.config(['$stateProvider', '$urlRouterProvider', function($stateProvider, $urlRouterProvider) {
    $urlRouterProvider.otherwise('/shows');

    $stateProvider
        .state('shows', {
            url: '/shows',
            templateUrl: 'tpls/shows.html',
            controller: 'ShowsController'

        })
        .state('shows.detail', {
            url: '/detail',
            templateUrl: 'tpls/detail.html',
            controller: 'ShowsDetailController'
        });
}]);
app.controller('ShowsController', ['$scope', function($scope) {
    $scope.shows = ["A", "Set", "Of", "Shows"];
}]);
app.controller('ShowsDetailController', ['$scope', function($scope) {
    $scope.things = ["A", "Set", "Of", "Things"];
}]);

