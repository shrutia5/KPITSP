define([
  'underscore',
  'backbone',
], function(_, Backbone) {

  var helpfulResourcesModel = Backbone.Model.extend({
    idAttribute: "resourceID"
  });
  return helpfulResourcesModel;
});

