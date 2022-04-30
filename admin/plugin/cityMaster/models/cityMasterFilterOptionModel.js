define([
  'underscore',
  'backbone',
], function(_, Backbone) {

  var cityMasterFilterOptionModel = Backbone.Model.extend({
  	idAttribute: "cityID",
  	 defaults:{
        textSearch:'cityName',
        stateid:'stateID',
        textval: null,
        stateval:null,
        codeval:null,
        status:'active',
        orderBy:'cityName',
        order:'ASC',
    }
  });
  return cityMasterFilterOptionModel;
});

