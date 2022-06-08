define([
  'underscore',
  'backbone',
], function(_, Backbone) {

  var faqMasterFilterOptionModel = Backbone.Model.extend({
  	idAttribute: "faqID",
  	 defaults:{
        textSearch:'status',
        textval: null,
        status:'active,inactive',
        orderBy:'faqID',
        order:'ASC',
    }
  });
  return faqMasterFilterOptionModel;
});

