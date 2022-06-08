define([
  'underscore',
  'backbone',
], function(_, Backbone) {

  var emailMasterFilterOptionModel = Backbone.Model.extend({
  	idAttribute: "tempID",
  	 defaults:{
        textSearch:'tempName',
        textval: null,
        status:'active',
        orderBy:'tempName',
        order:'ASC',
    }
  });
  return emailMasterFilterOptionModel;
});

