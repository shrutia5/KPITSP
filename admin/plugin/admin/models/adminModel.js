define([
  'underscore',
  'backbone',
], function(_, Backbone) {

  var adminModel = Backbone.Model.extend({
    idAttribute: "adminID",
    defaults: {
        adminID:null,
        name:null,
        userName:null,
        email:null,
        password:null,
        roleID:null,
        createdDate:null,
        lastLogin:null,
        userRoleList:null,
        status:'active'
	}
  });
  return adminModel;
});

