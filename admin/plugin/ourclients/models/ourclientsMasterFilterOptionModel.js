define([
  'underscore',
  'backbone',
], function(_, Backbone) {

  var ourclientsMasterFilterOptionModel = Backbone.Model.extend({
  	idAttribute: "clientsID",
  	 defaults:{
        textSearch:'clientsname',
        textval: null,
        status:'active',
        orderBy:'createdDate',
        order:'DESC',
    }
  });
  return ourclientsMasterFilterOptionModel;
});

