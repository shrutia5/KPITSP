define([
  'underscore',
  'backbone',
], function(_, Backbone) {

  var singleAccGroupModel = Backbone.Model.extend({
    idAttribute: "accGroupID",
     defaults: {
        accGroupID:null,
        accGroupName:null,
        subGroupYesNo:null,
        mainGroupID:null,
        scheduleNo:null,
        createdBy:null,
        modifiedBy:null,
        createdDate:null,
        modifiedDate:null,
        status:'active',
    },
  	urlRoot:function(){
      return APIPATH+'accGroupMaster/'
    },
    parse : function(response) {
        return response.data[0];
      }
  });
  return singleAccGroupModel;
});
