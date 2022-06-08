define([
  'underscore',
  'backbone',
], function(_, Backbone) {

  var ourclientsMasterSingleModel = Backbone.Model.extend({
    idAttribute: "clientsID",
     defaults: {
        clientsID:null,
        clientsname:null,
        clientImage:null,
        clientImageUP:null,
        link:null,
        modifiedBy:null,
        createdDate:null,
        modifiedDate:null,
        categoryList:null,
        categoryID:null,
        status:'active',
    },
  	urlRoot:function(){
      return APIPATH+ 'ourclientssave'
    },
    parse : function(response) {
        return response.data[0];
      }
  });
  return ourclientsMasterSingleModel;
});
