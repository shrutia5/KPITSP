define([
  'underscore',
  'backbone',
], function(_, Backbone) {

  var pagesMenuMasterFilterOptionModel = Backbone.Model.extend({
  	idAttribute: "menuID",
  	 defaults:{
        textSearch:'',
        textval: null,
        getAll: "Y",
        status:'active,inactive',
        orderBy:'',
        order:'ASC',
    }
  });
  return pagesMenuMasterFilterOptionModel;
});

