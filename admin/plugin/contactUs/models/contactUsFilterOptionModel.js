define([
  'underscore',
  'backbone',
], function(_, Backbone) {

  var contactUsFilterOptionModel = Backbone.Model.extend({
  	idAttribute: "contactUsID",
  	 defaults:{
        textSearch:'status',
        textval: null,
        status:'active',
        orderBy:'contactUsID',
        order:'DESC',
    }
  });
  return contactUsFilterOptionModel;
});

