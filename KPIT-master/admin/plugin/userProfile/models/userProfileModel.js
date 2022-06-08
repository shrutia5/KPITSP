define([
  'underscore',
  'backbone',
], function(_, Backbone) {

  var infoSettingsModel = Backbone.Model.extend({
    idAttribute: "adminID",
     defaults: {
        adminID:null,
        name:null,
        userName:null,
        email:null,
        password:null,
        address:null,
        contactNo:null,
        whatsappNo:null,
        dateOfBirth:null,
        eyeIcon:"fa fa-eye-slash",
        inputType:"password"   ,
        createdBy:null,
        modifiedBy:null,
        createdDate:null,
        modifiedDate:null,
    },
  	urlRoot:function(){

      return APIPATH+'addadmin/'
    },
    parse : function(response) {
        return response.data[0];
      }
  });
  return infoSettingsModel;
});
