define([
  'underscore',
  'backbone',
], function(_, Backbone) {

  var singleregisterUserModel = Backbone.Model.extend({
    idAttribute: "roleID",
     defaults: {
        userID:null,
        firstname:null,
        lastName:null,
        email:null,
        password:null,
        phoneNumber:null,
        userType:null,
        gender:null,
        ref1FirstName:null,
        ref1LastName:null,
        ref1Email:null,
        ref1ConcatNo:null,
        ref1Designation:null,
        ref2FirstName:null,
        ref2LastName:null,
        ref2Email:null,
        ref2ContactNo:null,
        ref2Designation:null,
        createdBy:null,
        modifiedBy:null,
        createdDate:null,
        modifiedDate:null,
        status:'active',
    },
  	urlRoot:function(){
      return APIPATH+'registerUserMaster/'
    },
    parse : function(response) {
        return response.data[0];
      }
  });
  return singleregisterUserModel;
});
