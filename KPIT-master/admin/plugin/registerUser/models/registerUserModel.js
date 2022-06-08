define([
  'underscore',
  'backbone',
], function(_, Backbone) {

  var registerUserModel = Backbone.Model.extend({
    idAttribute: "userID"
  });
  return registerUserModel;
});

