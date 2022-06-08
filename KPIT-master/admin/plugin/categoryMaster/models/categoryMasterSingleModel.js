define([
  'underscore',
  'backbone',
], function(_, Backbone) {

  var categoryMasterSingleModel = Backbone.Model.extend({
    idAttribute: "categoryID",
     defaults: {
        categoryID:null,
        categoryName:null,
        createdBy:null,
        modifiedBy:null,
        createdDate:null,
        modifiedDate:null,
        categoryList:null,
        parentID:null,
        isParent:'no',
        status:'active',
    },
  	urlRoot:function(){
      return APIPATH+'categoryMaster/'
    },
    parse : function(response) {
        return response.data[0];
      }
  });
  return categoryMasterSingleModel;
});
