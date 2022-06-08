define([
  'underscore',
  'backbone',
], function(_, Backbone) {

  var infoSettingsModel = Backbone.Model.extend({
    idAttribute: "infoID",
     defaults: {
        infoID:null,
        companyName:null,
        email:null,
        fromEmail:null,
        fromName:null,
        createdBy:null,
        modifiedBy:null,
        createdDate:null,
        modifiedDate:null,
    },
  	urlRoot:function(){
      return APIPATH+'infoSettingsList'
    },
    parse : function(response) {
        return response.data[0];
      }
  });
  return infoSettingsModel;
});
