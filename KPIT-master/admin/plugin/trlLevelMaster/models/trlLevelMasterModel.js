define([
  'underscore',
  'backbone',
], function(_, Backbone) {

  var trlLevelMasterModel = Backbone.Model.extend({
    idAttribute: "id"
  });
  return trlLevelMasterModel;
});

