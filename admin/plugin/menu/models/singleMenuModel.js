define([
  'underscore',
  'backbone',
], function(_, Backbone) {

  var singleMenuModel = Backbone.Model.extend({
    idAttribute: "menuID",
     defaults: {
        menuID:null,
        menuName:null,
        menuLink:null,
        isParent:"no",
        isClick:"no",
        menuIndex:999,
        parentID:null,
        createdBy:null,
        modifiedBy:null,
        createdDate:null,
        modifiedDate:null,
        status:'active',
    },
  	urlRoot:function(){
      return APIPATH+'menuMaster/'
    },
    parse : function(response) {
        return response.data[0];
      }
  });
  return singleMenuModel;
});
