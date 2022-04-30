define([
  'underscore',
  'backbone',
], function(_, Backbone) {

  var stateMasterFilterOptionModel = Backbone.Model.extend({
  	idAttribute: "stateID",
  	 defaults:{
       code:'stateCode',
        textSearch:'stateName',
        textval: null,
        codeval:null,
        status:'active',
        orderBy:'stateName',
        order:'ASC',
    }
  });
  return stateMasterFilterOptionModel;
});

