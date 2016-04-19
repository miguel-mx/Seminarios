angular.module('seminarios', ['ui.bootstrap']);

var DatepickerCtrl = function ($scope) {
    $scope.today = function() {
        $scope.dt = new Date();

    };

    //$scope.today();

    //$scope.param = new Date($scope.param);

    $scope.clear = function () {
        $scope.dt = null;
    };

    // Disable weekend selection
    //$scope.disabled = function(date, mode) {
    //  return ( mode === 'day' && ( date.getDay() === 0 || date.getDay() === 6 ) );
    //};

    $scope.toggleMin = function() {
        //$scope.minDate = $scope.minDate ? null : new Date();
        $scope.minDate = new Date('01-01-2016');
    };
    $scope.toggleMin();

    $scope.open = function($event) {
        $event.preventDefault();
        $event.stopPropagation();

        $scope.opened = true;
    };

    $scope.dateOptions = {
        formatYear: 'yy',
        startingDay: 1
    };

    $scope.initDate = new Date();
    $scope.formats = ['dd-MM-yyyy', 'shortDate'];
    $scope.format = $scope.formats[0];

};