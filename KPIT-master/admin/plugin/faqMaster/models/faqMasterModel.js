define([
  'underscore',
  'backbone',
], function(_, Backbone) {

  var faqMasterModel = Backbone.Model.extend({
    idAttribute: "faqID"
  });
  return faqMasterModel;
});

