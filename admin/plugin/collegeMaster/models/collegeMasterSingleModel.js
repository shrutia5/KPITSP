define([
  'underscore',
  'backbone',
], function(_, Backbone) {

  var collegeMasterSingleModel = Backbone.Model.extend({
    idAttribute: "collegeeID",
     defaults: {
      collegeeID:null,
      stateID:null,
      cityID:null,
      collegeeName:null,
      createdBy:null,
      modifiedBy:null,
      createdDate:null,
      modifiedDate:null,
      isParent:'no',
      status:'active',
    },
  	urlRoot:function(){
      return APIPATH+'collegeMaster/'
    },
    parse : function(response) {
        return response.data[0];
      }
  });
  return collegeMasterSingleModel;
});
