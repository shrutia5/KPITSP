define([
  'underscore',
  'backbone',
], function(_, Backbone) {

  var contactUsModel = Backbone.Model.extend({
    idAttribute: "contactUsID"
  });
  return contactUsModel;
});

