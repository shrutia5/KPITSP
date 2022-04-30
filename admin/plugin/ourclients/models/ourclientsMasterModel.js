define([
  'underscore',
  'backbone',
], function(_, Backbone) {

  var ourclientsMasterModel = Backbone.Model.extend({
    idAttribute: "clientsID"
  });
  return ourclientsMasterModel;
});

