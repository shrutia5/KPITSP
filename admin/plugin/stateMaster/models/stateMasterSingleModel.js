define([
  'underscore',
  'backbone',
], function(_, Backbone) {

  var stateMasterSingleModel = Backbone.Model.extend({
    idAttribute: "stateID",
     defaults: {
      stateID:null,
      stateCode:null,
      stateName:null,
        createdBy:null,
        modifiedBy:null,
        createdDate:null,
        modifiedDate:null,
        stateList:null,
        parentID:null,
        isParent:'no',
        status:'active',
    },
  	urlRoot:function(){
      return APIPATH+'stateMaster/'
    },
    parse : function(response) {
        return response.data[0];
      }
  });
  return stateMasterSingleModel;
});
