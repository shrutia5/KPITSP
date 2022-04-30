define([
  'underscore',
  'backbone',
], function(_, Backbone) {

  var cityMasterModel = Backbone.Model.extend({
    idAttribute: "cityID"
  });
  return cityMasterModel;
});

