define([
  'underscore',
  'backbone',
], function(_, Backbone) {

  var collegeMasterFilterOptionModel = Backbone.Model.extend({
  	idAttribute: "collegeID",
  	 defaults:{
        textSearch:'collegeName',
        stateid:'stateID',
        cityid:'cityID',
        textval: null,
        stateval:null,
        cityval:null,
        codeval:null,
        status:'active',
        orderBy:'collegeName',
        order:'ASC',
    }
  });
  return collegeMasterFilterOptionModel;
});

