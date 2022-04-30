define([
  'underscore',
  'backbone',
], function(_, Backbone) {

  var categoryMasterFilterOptionModel = Backbone.Model.extend({
  	idAttribute: "categoryID",
  	 defaults:{
        textSearch:'categoryName',
        textval: null,
        status:'active',
        orderBy:'categoryName',
        order:'ASC',
    }
  });
  return categoryMasterFilterOptionModel;
});

