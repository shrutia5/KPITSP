define([
  'underscore',
  'backbone',
], function(_, Backbone) {

  var categoryMasterModel = Backbone.Model.extend({
    idAttribute: "categoryID"
  });
  return categoryMasterModel;
});

