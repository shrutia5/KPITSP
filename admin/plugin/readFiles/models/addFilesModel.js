define([
  'underscore',
  'backbone',
], function(_, Backbone) {

  var menuPagesModel = Backbone.Model.extend({
    defaults:{
        fileList:[],
        folderPath:null,
    },
    urlRoot:function(){
      return APIPATH+'addFilesInFolder/'
    },
    parse : function(response) {
        return response.data;
      }
  });
  return menuPagesModel;
});

