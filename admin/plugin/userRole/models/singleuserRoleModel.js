define([
  'underscore',
  'backbone',
], function(_, Backbone) {

  var singleuserRoleModel = Backbone.Model.extend({
    idAttribute: "roleID",
     defaults: {
        roleID:null,
        roleName:null,
        createdBy:null,
        modifiedBy:null,
        createdDate:null,
        modifiedDate:null,
        status:'active',
    },
  	urlRoot:function(){
      return APIPATH+'userRoleMaster/'
    },
    parse : function(response) {
        return response.data[0];
      }
  });
  return singleuserRoleModel;
});
