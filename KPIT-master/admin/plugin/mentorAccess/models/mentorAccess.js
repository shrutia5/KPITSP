define([
  'underscore',
  'backbone',
], function(_, Backbone) {

  var mentorAccess = Backbone.Model.extend({
    idAttribute: "adminID",
     defaults: {
        accessID:null,
        menuName:null,
        projectList:null,
        add:'no',
        edit:'no',
        view:'no',
        delete:'no',
    },
    urlRoot:function(){
      return APIPATH+'mentorAccessList/'
    },
    parse : function(response) {
        return response.data[0];
      }
  });
  return mentorAccess;
});
