angular.module('seminarios', ['ui.bootstrap']).controller('TimepickerCtrl', function ($scope, $log) {

    $scope.mytime = new Date();

    $scope.hstep = 1;
    $scope.mstep = 10;

    $scope.ismeridian = false;
    $scope.toggleMode = function() {
        $scope.ismeridian = ! $scope.ismeridian;
    };

    $scope.update = function() {
        var d = new Date();
        d.setHours( 14 );
        d.setMinutes( 0 );
        $scope.mytime = d;
    };

});