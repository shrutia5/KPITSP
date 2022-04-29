define([
  'underscore',
  'backbone',
], function(_, Backbone) {

  var faqMasterSingleModel = Backbone.Model.extend({
    idAttribute: "faqID",
     defaults: {
        faqID:null,
        faqQuestion:null,
        faqAnswer:null,
        isPublish:null,
        askedByName:null,
        askedByEmail:null,
        isEmailSend:null,
        createdBy:null,
        modifiedBy:null,
        createdDate:null,
        modifiedDate:null,
        status:null,
    },
  	urlRoot:function(){
      return APIPATH+'faqMaster/'
    },
    parse : function(response) {
        return response.data[0];
      }
  });
  return faqMasterSingleModel;
});
