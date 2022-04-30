define([
  'underscore',
  'backbone',
], function(_, Backbone) {

  var trlQuestionsFilterOptionModel = Backbone.Model.extend({
  	idAttribute: "faqID",
  	 defaults:{
        textSearch:'status',
        textval: null,
        status:'active',
        orderBy:'faqID',
        order:'ASC',
    }
  });
  return trlQuestionsFilterOptionModel;
});

