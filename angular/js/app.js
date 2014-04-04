'use strict';

     // Declare app level module which depends on filters, and services
    angular.module('myApp', [
      'ngSanitize',
      'ntYoutubeFetch'
    ]);
    
    angular.module('ntYoutubeFetch', [
    ])
    .run(function($document, $rootScope, $q, $window){
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
    .value('ntYoutubeConfig', {
        data : null,
        APIKey : 'AIzaSyBUi36u48h1eFld14jwUajKKpiI61UMyDM'
    })
    .controller('ntYoutubeFetch', ['$scope', '$rootScope', '$http', '$timeout', 'ntYoutubeConfig', function($scope, $rootScope, $http, $timeout, ntYoutubeConfig) {
        window.ntYoutubeFetch = $scope;
        $scope.getHeight = function(){
            return $('#myApp').height();
        };
        $scope.r = ntYoutubeConfig.data;//initialize;
        $scope.APIKey = ntYoutubeConfig.APIKey;
        $scope.update = {
            data : function(data){
                $scope.r = data;
            },
            APIKey : function(key){
                $scope.APIKey = key;
            }
        };
        $scope.$watch('r', function(val){
           // if (!val) return;
            $timeout(function(){
                if (typeof $scope.callback === "function"){
                   $scope.callback(val);
                }
            }, 500);
        });      
        
         $scope.fetch = function(id){
            $rootScope.youtubeReady.promise.then(function(){
                var baseURL = 'https://www.googleapis.com/youtube/v3',
                    resource = '/videos?',
                    parts = 'part=' + encodeURIComponent( 'id,contentDetails,player,snippet' ),
                    url = baseURL + resource + parts + '&id=' + id + '&key=' + $scope.APIKey;
                $http({method: 'GET', url: url}).success(function(data, status, headers, config) {
                    //console.log('data!', data);
                    $scope.r = data.items[0];
                }).
                error(function(data, status, headers, config) {
                  // called asynchronously if an error occurs
                  // or server returns response with an error status.
                });
            });
          };
    }]);

