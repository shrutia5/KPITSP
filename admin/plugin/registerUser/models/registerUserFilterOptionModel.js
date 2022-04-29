define([
  'underscore',
  'backbone',
], function(_, Backbone) {

  var registerUserFilterOptionModel = Backbone.Model.extend({
  	idAttribute: "userID",
  	 defaults:{
        textSearch:'firstName',
        lastname:'lastName',
        textval: null,
        status:'active',
        orderBy:'firstname',
        order:'ASC',
    }
  });
  return registerUserFilterOptionModel;
});

