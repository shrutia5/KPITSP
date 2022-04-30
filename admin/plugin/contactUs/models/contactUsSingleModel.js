define([
  'underscore',
  'backbone',
], function(_, Backbone) {

  var contactUsSingleModel = Backbone.Model.extend({
    idAttribute: "contactUsID",
     defaults: {
        contactUsID:null,
        enquryType:null,
        fullName:null,
        email:null,
        contactNo:null,
        message:null,
        createdBy:null,
        modifiedBy:null,
        createdDate:null,
        modifiedDate:null,
        status:null,
    },
  	urlRoot:function(){
      return APIPATH+'contactUs/'
    },
    parse : function(response) {
        return response.data[0];
      }
  });
  return contactUsSingleModel;
});
