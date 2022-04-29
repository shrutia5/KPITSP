define([
  'underscore',
  'backbone',
], function(_, Backbone) {

  var helpfulResourcesFilterOptionModel = Backbone.Model.extend({
  	idAttribute: "resourceID",
  	 defaults:{
        textSearch:'status',
        textval: null,
        status:'active',
        orderBy:'createdDate',
        order:'DESC',
    }
  });
  return helpfulResourcesFilterOptionModel;
});

