define([
  'underscore',
  'backbone',
], function(_, Backbone) {

  var cityMasterSingleModel = Backbone.Model.extend({
    idAttribute: "cityID",
     defaults: {
      cityID:null,
      stateID:null,
      cityName:null,
      createdBy:null,
      modifiedBy:null,
      createdDate:null,
      modifiedDate:null,
      isParent:'no',
      status:'active',
    },
  	urlRoot:function(){
      return APIPATH+'cityMaster/'
    },
    parse : function(response) {
        return response.data[0];
      }
  });
  return cityMasterSingleModel;
});
