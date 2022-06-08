define([
  'underscore',
  'backbone',
], function(_, Backbone) {

  var emailMasterSingleModel = Backbone.Model.extend({
    idAttribute: "tempID",
     defaults: {
        tempID:null,
        tempUniqueID:null,
        tempName:null,
        subject:null,
        emailContent:null,
        smsContent:null,
        createdBy:null,
        modifiedBy:null,
        createdDate:null,
        modifiedDate:null,
        status:'active',
    },
  	urlRoot:function(){
      return APIPATH+'emailMaster/'
    },
    parse : function(response) {
        return response.data[0];
      }
  });
  return emailMasterSingleModel;
});
