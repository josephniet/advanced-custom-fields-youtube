'use strict';

     // Declare app level module which depends on filters, and services
    angular.module('myApp', [
      'ngSanitize',
    ]).run(function($document, $rootScope, $q, $window){
        var tag = $document[0].createElement('script');
        tag.src = "https://www.youtube.com/iframe_api";
        var firstScriptTag = $document[0].getElementsByTagName( 'script' )[0];
        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
        $rootScope.youtubeReady = $q.defer();
        $window.onYouTubePlayerAPIReady = function() {
            $rootScope.youtubeReady.resolve();
            //$rootScope.$broadcast( 'onYouTubePlayerAPIReady' );
        };
    })
    .controller('MainCtrl', ['$scope', '$rootScope', '$http', 'APIKey', 'data', function($scope, $rootScope, $http) {
        function _notifyParent(key, data, height){
            
        };
        $scope.r = false;
        
         $scope.fetch = $rootScope.youtubeReady.promise.then(function(id){
            var baseURL = 'https://www.googleapis.com/youtube/v3',
                resource = '/videos?',
                parts = 'part=' + encodeURIComponent( 'id,contentDetails,player,snippet' );
            var url = baseURL + resource + parts + '&id=' + id + '&key=' + APIKey;
            $http({method: 'GET', url: url}).success(function(data, status, headers, config) {
                console.log('data!', data);
                $scope.r = data.items[0];
            }).
            error(function(data, status, headers, config) {
              // called asynchronously if an error occurs
              // or server returns response with an error status.
            });
          })
         }
    }])

