angular.module('userApp.services', []).factory('User', function($resource) {
  return $resource('http://localhost:8000/api/usuarios/:id', { id: '@_id' }, {
    update: {
      method: 'PUT'
    }
  });
});