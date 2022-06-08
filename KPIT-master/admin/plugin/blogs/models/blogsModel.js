define([
  'underscore',
  'backbone',
], function(_, Backbone) {

  var blogsModel = Backbone.Model.extend({
    idAttribute: "blogID"
  });
  return blogsModel;
});

