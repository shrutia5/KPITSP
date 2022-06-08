define([
  'underscore',
  'backbone',
], function(_, Backbone) {

  var stateMasterModel = Backbone.Model.extend({
    idAttribute: "stateID"
  });
  return stateMasterModel;
});

