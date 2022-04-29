define([
  'underscore',
  'backbone',
], function(_, Backbone) {

  var trlQuestionsSingleModel = Backbone.Model.extend({
    idAttribute: "trlQuestionID",
     defaults: {
        trlQuestionID:null,
        qName:null,
        ansGuide:null,
        ansType:null,
        isRequired:null,
        qGuide:null,
        trlLevelID:null,
        status:"active",
        qoptions:null,
        isdel:null,
        fileSize:null,
        uploadType:null,
        minLength:null,
        maxLength:null,
        options:null,
    },
  	urlRoot:function(){
      return APIPATH+'trlQuestions/'
    },
    parse : function(response) {
        return response.data[0];
      }
  });
  return trlQuestionsSingleModel;
});
