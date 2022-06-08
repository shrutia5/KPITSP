define([
  'underscore',
  'backbone',
], function(_, Backbone) {

  var trlQuestionsModel = Backbone.Model.extend({
    idAttribute: "faqID"
  });
  return trlQuestionsModel;
});

