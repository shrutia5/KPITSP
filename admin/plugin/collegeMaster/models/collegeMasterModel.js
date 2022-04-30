define([
  'underscore',
  'backbone',
], function(_, Backbone) {

  var collegeMasterModel = Backbone.Model.extend({
    idAttribute: "collegeID"
  });
  return collegeMasterModel;
});

