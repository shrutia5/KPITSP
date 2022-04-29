"use strict";
var formDataString = "";
var currentStep = 1;
var currentPhase = 1;
var currentProjectID = "";
$(document).ready(function() {  
    // Auto save project data
    setInterval(function(){
        autoSaveData();
    }, 5000);
    setTimeout(function(){
        $("#autosave-msg").show();
        setTimeout(function(){ $("#autosave-msg").hide(); }, 5000);
    }, 3000);
    $("#autosave-msg").click(function(){
        $("#autosave-msg").hide();
    })
    var numItems = $('.ideaSubmission').length;
    currentStep = $("#currentStep").val();
    currentPhase = $("#currentPhase").val();
    if(currentPhase > 1){
        $("input[name='patentFiled']").change(function(){
            if($(this).val()==1){
                $(".patent-dependent").removeClass("hide");
            }else{
                $(".patent-dependent").addClass("hide");
            }
        })
    }
    if(currentStep > numItems){
        currentStep = numItems;
    }
    formDataString = $("#ideaform_"+currentStep).serialize();
    $(".ideaSubmission").hide();
    $(".section_"+currentStep).show();
    $("#prevbtn").attr("data-secID",currentStep);
    $("#nextbtn").attr("data-secID",currentStep);
    $(".submission-tab").removeClass("active");
    $("#"+$(".section_"+currentStep).attr("data-tab")).addClass("active");
    try{
        if(typeof($("#projectID").val()) !="undefined"){
            currentProjectID = $("#projectID").val();
            setFileUpload();
        }
    }catch(ex){

    }
    
    $(".submission-tab").click(function(){
        if(!$(this).hasClass("active")){
            
            if(currentStep>1){
                $(".submission-tab").removeClass("active");
                $(this).addClass("active");
                $(".ideaSubmission").hide();
                var cId = $(this).attr("id");
                console.log("S:"+cId);
                if(cId == "st-1"){
                    $("#prevbtn").attr("disabled","disabled");
                    $(".preNxtBtn").attr("data-secID",1);
                    $(".section_1").show();
                }else
                {
                    $("#prevbtn").removeAttr("disabled");
                    if(cId == "st-2"){
                        $(".section_2").show();
                        $(".preNxtBtn").attr("data-secID",2);
                    }else{
                        if(cId == "st-3"){
                            $("#section_attachemt").show();
                            $(".preNxtBtn").attr("data-secID", numItems);
                        }else{
                            $(".section_"+(numItems-1)).show();
                            $(".preNxtBtn").attr("data-secID", (numItems -1));
                        }
                    }
                }
            }
            var secID = $(".preNxtBtn").attr("data-secID");
            formDataString = $("#ideaform_"+secID).serialize();
        }
    });
    // alert("sdfsdfsdfsdfsf");
    $(".getsubcategory").on("change",function(e){
        var valuetxt = $(e.currentTarget).val(); 
        var url = $(e.currentTarget).attr("data-action");
        $.ajax({
            type: "POST",
            url: url,
            data: {cateID:valuetxt}, // serializes the form's elements.
            datatype:'JSON',
            beforeSend: function(request) {
            //$("#save").html("<span>SENDING..</span>");
            },
            success:function(res){
                res = JSON.parse(res);
            if(res.flag == "F")
            {
                $('#subCategory').find('option').remove().end().append('<option value="">Select Sub Category</option>');
            }   // alert(res.msg);
            if(res.flag == "S"){
                // console.log(opt)
                if(res.data!="")
                {
                    var optdata=""
                    res.data.forEach(function(opt){
                        optdata+="<option value='"+opt.sub_cat_id+"'>"+opt.sub_cat_name+"</option>"
                    })
                    $('#subCategory').append(optdata);
                }else{
                    $('#subCategory').find('option').remove().end().append('<option value="">Select</option>');

                }
            }
            }
        });
    });
    function saveProjectAndGetID(){
        // var url = $(e.currentTarget).attr("data-action");
        var projectName = $("#projectName").val();
        //console.log(projectName);return;
        var category = $("#categoryName").val();
        //console.log(category);return;
        var suCategory = $("#subCategory").val();
        var projectDiscription = $("#projectDiscription").val();
        //console.log(projectDiscription);return;
        var projectID = "";
        var methodt="POST";
        if($('#projectID').length && $("#projectID").val()!=""){
           projectID = $("#projectID").val();
        }
        $.ajax({
            type: methodt,
            url: base_url+"student/saveProject",
            data: {
                projectName:projectName,
                category:category,
                suCategory:suCategory,
                projectDiscription:projectDiscription,
                projectID:projectID,
            }, // serializes the form's elements.
            datatype:'JSON',
            beforeSend: function(request) {
                // $("#save").html("<span>SENDING..</span>");
            },
            success:function(res){
                res = JSON.parse(res);
                if(res.flag == "F")
                {}  // alert(res.msg);
                if(res.flag == "S"){
                    if(res.data!="")
                    {
                        if(methodt=="POST")
                        {
                            if(currentProjectID==""){
                                currentProjectID = res.data;
                                setFileUpload();
                            }
                            
                            var hideeninput=""
                            hideeninput+="<input type='hidden' name='projectID' id='projectID' value='"+res.data+"'/>";
                            $('.trlforms').append(hideeninput);
                        }
                    }
                }
                setTimeout(function(){
                    // $("#save").html("");
                }, 3000);
            }
        });
    }
    $("#ideaform_1").validate({
        rules: {
            field: {
                required: true
              },
            projectName: {
                required: true,
                minlength:3,
                normalizer: function(value) {
                    return $.trim(value);
                  }
            },
            categoryName: {
                required: true,
            },
            subCategory: {
                required: true,
            },
            projectDiscription: {
                required: true,
                minlength: 250,
                maxlength: 1000,
                normalizer: function(value) {
                    return $.trim(value);
                  }
            },
            
            
        },
        messages: {
            projectName: "Enter Project name",
            categoryName: "Select category",
            subCategory: "Select sub-category",
            projectDiscription: 
            {
                required:"Please Enter Project Description",
                minlength:"Minimum 250 characters",
                maxlength:"Maximum 1000 characters",
            }
          }
    })
$(".frm-prototype").validate({
    rules:{
        technicalDescription:{
            required: true,
            minlength: 250,
            maxlength: 1000,
        },
        keywords:{
            required: true,
            minlength: 250,
            maxlength: 1000,
        },
        patentFiled:{
            required: true,
        },
        patentStatus:{
            required: true,
        },
        patentApplicationNumber:{
            required: true,
        },
    },
    messages:{
        technicalDescription: 
            {
                required:"Enter Technical Description",
                minlength:"Minimum 250 characters Required",
                maxlength:"Maximum 1000 characters Required",
            },
        keywords: 
            {
                required:"Enter Keyword Description",
                minlength:"Minimum 250 characters Required",
                maxlength:"Maximum 1000 characters Required",
            },
        patentFiled:"Please Select Patent Filed",
        patentStatus:"Please Select Patent Status",
        patentApplicationNumber:"Please Select Patent Application Number",
    }
})
    //$(".ideaSubmission").hide();
    //$(".section_1").show();
    if(currentStep == 1)
    $("#prevbtn").attr("disabled","disabled");

    $(".preNxtBtn").on("click",function(){
        var btnType = $(this).attr("id");
        //console.log(btnType);return;
        var secID = $(this).attr("data-secID");
        //console.log(secID);return;
        
        //console.log(numItems);return;
        if(btnType=="nextbtn")
        {
            if(secID==1)          
            {
                if(!$("#ideaform_1").valid()){return;}
                if(confirm('Do you want to proceed with submission?'))
                {
                    saveProjectAndGetID();
                    
                    secID=++secID;
                    currentStep = secID;
                    if(secID <=(numItems)){
                        $(".submission-tab").removeClass("active");
                        $("#st-2").addClass("active");
                        $(".ideaSubmission").hide();
                        $(".section_"+secID).show();
                        $("#prevbtn").attr("data-secID",secID);
                        $("#prevbtn").removeAttr("disabled");
                        $(this).attr("data-secID",secID);
                        $('.trl-page').scrollTop(0);
                        $('.full-left').scrollTop(0);
                        formDataString = $("#ideaform_"+secID).serialize();
                    }else if(secID ==(numItems+1)){
                        $(this).attr("disabled","disabled");
                        // $("#saveideaform").submit();
                    }
                }else {return;}
            }else
            {
                if(currentPhase > 1 && (numItems-1) == secID){
                    console.log("Save Prototype");
                    if(!$(".frm-prototype").valid()){return;}
                    $.ajax({
                        type: "POST",
                        url: base_url+"student/savePrototypeDetails",
                        data:$("#ideaform_"+secID).serialize()+"&sectionId="+secID, // serializes the form's elements.
                        datatype:'JSON',
                        beforeSend: function(request) {
                         $("#saveuser").html("<span>Sending..</span>");
                       },
                       success:function(res){
                        res = JSON.parse(res);
                        $(".error").remove();
                         if(res.flag == "F")
                         {
                            this.flag==res.flag;
                            res.data.forEach(function(err){
                                var error="";
                                error+="<p class='error'>"+err.message+"</p>";
                                $("#qdiv_"+err.qid).find('p').remove();
                                $("#qdiv_"+err.qid).append(error);
                                
                            })
                        }
                        if(res.flag == "S"){
                            $(".submission-tab").removeClass("active");
                            $("#st-3").addClass("active");
                            $(".ideaSubmission").hide();
                            $("#section_attachemt").show();
                            secID++;
                            $("#prevbtn").attr("data-secID",secID);
                            $("#nextbtn").attr("data-secID",secID);
                            $('.trl-page').scrollTop(0);
                            $('.full-left').scrollTop(0);
                            formDataString = $("#ideaform_"+secID).serialize();
                        }
                       }
                    });
                    return;
                }
                //  Attachment tab
                if(secID == numItems){
                    //location.href = base_url+"/student/dashboard";
                    // alert("success");
                    //location.href = base_url+"student/final";
                    var hasEmptyFile = false;
                    $(".file-error").remove();
                    $(".file-required").each(function(){
                        if(!$(this).hasClass('hide')){
                            $(this).append('<p class="error file-error">Please upload this field</p>');
                            hasEmptyFile = true;
                            return false;
                        }
                    });


                    if(hasEmptyFile==false){
                        location.href = base_url+"student/final";
                    }
                    return;
                }

                $.ajax({
                    type: "POST",
                    url: base_url+"student/saveideaProject",
                    data:$("#ideaform_"+secID).serialize()+"&sectionId="+secID, // serializes the form's elements.
                    datatype:'JSON',
                    beforeSend: function(request) {
                     $("#saveuser").html("<span>Sending..</span>");
                   },
                   success:function(res){
                    $(".error").remove();
                    res = JSON.parse(res);
                     if(res.flag == "F")
                     {
                        this.flag==res.flag;
                        res.data.forEach(function(err){
                            var error="";
                            error+="<p class='error'>"+err.message+"</p>";
                            $("#qdiv_"+err.qid).find('p').remove();
                            $("#qdiv_"+err.qid).append(error);
                            
                        })
                    }
                    if(res.flag == "S"){

                        secID=++secID;
                        if(secID >numItems){
                            location.href = base_url+"/student/dashboard";
                        }
                        if(secID <=(numItems)){
                            $(".ideaSubmission").hide();
                            $(".section_"+secID).show();
                            $("#prevbtn").attr("data-secID",secID);
                            $("#prevbtn").removeAttr("disabled");
                            $("#nextbtn").attr("data-secID",secID);
                            $(".submission-tab").removeClass("active");
                            $("#"+$(".section_"+secID).attr("data-tab")).addClass("active");
                            $('.trl-page').scrollTop(0);
                            $('.full-left').scrollTop(0);
                            formDataString = $("#ideaform_"+secID).serialize();
                        }else if(secID ==(numItems+1)){
                            $(this).attr("disabled","disabled");
                        }

                        
                     }
                    /* setTimeout(function(){
                         $("#saveuser").html("Send");
                     }, 3000);*/
                   }
                });
                
            }
        }else if(btnType=="prevbtn")
        {
            $('.trl-page').scrollTop(0);
            $('.full-left').scrollTop(0);
            $(".submission-tab").removeClass("active");
            if(secID >=1){
                secID=--secID;
                $(".ideaSubmission").hide();
                $(".section_"+secID).show();
                $(this).attr("data-secID",secID);
                $(this).removeAttr("disabled");
                $('#nextbtn').removeAttr("disabled");
                $("#nextbtn").attr("data-secID",secID);

                
                $("#"+$(".section_"+secID).attr("data-tab")).addClass("active");
            }
            if(secID ==1){
                $("#st-1").addClass("active");
                $(this).attr("disabled","disabled");
            }
        }
        formDataString = $("#ideaform_"+secID).serialize();
    });
    /*$(".loadfile").on("change",function(e){
        var filedata= e.currentTarget.files[0];
        var name= $(e.currentTarget).attr("name");
        var identifier = $(e.currentTarget).attr("id");
        var projectID= $("#projectID").val();
        var form_data = new FormData();
        form_data.append("file", filedata);
        form_data.append("name", name);
        form_data.append("projectID", projectID);
        console.log(name);
        return;    
            $.ajax({
                type: "POST",
                url: base_url+"student/saveideafiles",
                data:form_data,
                processData:false,
                contentType:false,
                cache:false,
                async:false,
                beforeSend: function(request) {
                    $("#"+identifier).parent().find('.error').remove();
                 //$("#saveuser").html("<span>Sending..</span>");
               },
               success:function(res){
                res = JSON.parse(res);
                res.data.forEach(function(err){
                    if(res.flag == "F")
                    {
                        $("#qdiv_"+err.qid).find('.error').remove();
                        $("#qdiv_"+err.qid).find('p').remove();
                        $("#qdiv_"+err.qid).append(err.message);
                    }
                    if(res.flag == "S"){
                        //alert(res.message);
                        if(res.type !=null && res.type =="file"){
                            
                            $("#trlQuestion_"+err.qid).addClass("hide");
                            $("#qdiv_"+err.qid).append(err.message);
                        }
                        $("#qdiv_"+err.qid).find('.error').remove();
                    }
                });
                
               }
              });

    });*/

    function getfiledetails(projectID, fieldName){
        console.log("Gettong File P:"+projectID+" F:"+fieldName)

        $.ajax({
            type: "POST",
            url: base_url+"student/getideafile",
            data:{"projectID":projectID,"name":fieldName},
            datatype:'JSON',
            beforeSend: function(request) {
            //$("#save").html("<span>SENDING..</span>");
            },
            success:function(res){
                res = JSON.parse(res);
                if(res.flag == "S"){
                    var questionIDDetails = fieldName.split("_");
                    var _questionID = questionIDDetails[1];
                    $(".tlfile_"+_questionID).remove();
                    var ff= fieldName.split("_");
                    $(".attfile_"+ff[1]).remove();
                    $("#qdiv_"+_questionID).append(res.message);
                }
                
                if(res.flag == "F")
                {
                   
                }
            }
        });
        
    }

    function setFileUpload(){
        if(currentProjectID !=""){
            console.log("D"+currentProjectID)
            $(".loadfile").each(function(){
                var elementID = $(this).attr("id");
                var fileSize = $(this).attr("data-flesize");
                var fileType = $(this).attr("data-uploadtype").split("|");
                var questionIDDetails = elementID.split("_");
                var _questionID = questionIDDetails[1];
                
                var name= $(this).attr("name");
                console.log("UP:"+currentProjectID);
        
                $("#"+elementID).RealTimeUpload({
                    text:'Choose '+fileType,
                    maxFiles: 10,
                    maxFileSize: fileSize,
                    uploadButton:false,
                    data:{"name":name, "projectID":currentProjectID},
                    notification:false,
                    autoUpload: true,
                    extension: fileType,
                    thumbnails: false,
                    element:elementID,
                    onSucess:function(){
                        console.log("Hide"+_questionID);
                        if(_questionID == "prototypeProgressVideo" ){
                            $("#qdiv_prototypeProgressVideo2").removeClass('hide');
                        }
                        $("#qdiv_"+_questionID+" .file-input").addClass('hide');
                        
                        getfiledetails(currentProjectID, elementID);
                    }
                });
            });
        }
    }

    function autoSaveData(){
        
        var secID = $("#nextbtn").attr("data-secID");
        var cFormData = $("#ideaform_"+secID).serialize();

        // Return from attachments
        if(secID==numItems){
            return;
        }
        
        if(formDataString != cFormData){
            
            if(secID ==1){
                if(!$("#ideaform_1").valid()){return;}

                var projectName = $("#projectName").val();
                var category = $("#categoryName").val();
                var suCategory = $("#subCategory").val();
                var projectDiscription = $("#projectDiscription").val();
                var projectID = "";
                var methodt="POST";
                if($('#projectID').length && $("#projectID").val()!=""){
                    projectID = $("#projectID").val();
                }
                
                $.ajax({
                    type: "POST",
                    url: base_url+"student/saveProject",
                    data: {
                        projectName:projectName,
                        category:category,
                        suCategory:suCategory,
                        projectDiscription:projectDiscription,
                        projectID:projectID,
                    },
                    datatype:'JSON',
                    beforeSend: function(request) {
                        // $("#save").html("<span>SENDING..</span>");
                    },
                    success:function(res){
                        res = JSON.parse(res);
                        if(res.flag == "S"){
                            console.log(res)
                            if(res.data!="")
                            {
                                    var hideeninput = "<input type='hidden' name='projectID' id='projectID' value='"+res.data+"'/>";
                                    $('.trlforms').append(hideeninput);
                            }
                        }
                    }
                });
            }else{
                console.log("numItems"+numItems + " : "+ secID)
                if(currentPhase > 1 && (numItems-1) == secID){
                    $.ajax({
                        type: "POST",
                        url: base_url+"student/savePrototypeDetails",
                        data:$("#ideaform_"+secID).serialize()+"&sectionId="+secID, // serializes the form's elements.
                        datatype:'JSON',
                        beforeSend: function(request) {
                         $("#saveuser").html("<span>Sending..</span>");
                       },
                       success:function(res){
                       }
                    });
                }else{

                    $.ajax({
                        type: "POST",
                        url: base_url+"student/saveideaProject",
                        data:$("#ideaform_"+secID).serialize()+ "&autosave=1", // serializes the form's elements.
                        datatype:'JSON',/*
                        beforeSend: function(request) {
                         $("#saveuser").html("<span>Sending..</span>");
                       },*/
                       success:function(res){
                        res = JSON.parse(res);
                       }
                    });
                }
            }

            formDataString = cFormData;

        }else{
            console.log("Unchanged");
        }
    }

    $("body").on("click",".removeTlFiles",function(e){
        var id = $(this).attr("data-trlqansid");
        var questionID = $(this).attr("data-questionID");
        if(confirm('Do you want to delete?'))
        {
            $.ajax({
                type: "POST",
                url: base_url+"student/removeTlFiles",
                data: {id:id,questionID:questionID}, // serializes the form's elements.
                datatype:'JSON',
                beforeSend: function(request) {
                //$("#save").html("<span>SENDING..</span>");
                },
                success:function(res){
                    if(res !=''){
                        res = JSON.parse(res);
                        if(res.flag == "F")
                        {
                            
                        }
                        if(res.flag == "S"){
                            $("#qdiv_"+questionID+" .file-input").removeClass("hide");
                            $(".tlfile_"+questionID).remove();
                            $("#qdiv_"+questionID+" .RTU-uploadItemsList").attr("data-upload",0);
                            $("#qdiv_"+questionID+" .RTU-uploadItem").remove();
                        }
                    }
                }
            });
        }

    });

    $("body").on("click",".removeAttFiles",function(e){
        var fileType = $(this).attr("data-field");
        //alert(fileType);return;
        if(confirm('Do you want to delete?'))
        {
        
            $.ajax({
                type: "POST",
                url: base_url+"student/removeAttFiles",
                data: {type:fileType}, // serializes the form's elements.
                datatype:'JSON',
                beforeSend: function(request) {
                //$("#save").html("<span>SENDING..</span>");
                },
                success:function(res){
                    res = JSON.parse(res);
                    if(res.flag == "F")
                    {
                        alertify.error(res.msg);
                    }
                    if(res.flag == "S"){
                        $("#qdiv_"+fileType+" .file-input").removeClass("hide");
                        $(".attfile_"+fileType).remove();
                        $("#qdiv_"+fileType+" .RTU-uploadItemsList").attr("data-upload",0);
                        $("#qdiv_"+fileType+" .RTU-uploadItem").remove();
                        // Hide second input of prototype video
                        if(fileType == "prototypeProgressVideo"){
                            console.log("D:"+$("#qdiv_prototypeProgressVideo2 .file-input").hasClass("hide"))
                            if(!$("#qdiv_prototypeProgressVideo2 .file-input").hasClass("hide")){
                                $("#qdiv_prototypeProgressVideo2").addClass("hide");
                            }
                        }
                        if(fileType == "prototypeProgressVideo2"){
                            if(!$("#qdiv_prototypeProgressVideo .file-input").hasClass("hide")){
                                $("#qdiv_prototypeProgressVideo2").addClass("hide");
                            }
                        }
                    }
                }
            });
        }

    });


    $(".changeCategory").on("change",function(e){
        //alert("hiiii"); return;
        var valuetxt = $(e.currentTarget).val(); 
        // alert(valuetxt);
        var url = $(e.currentTarget).attr("data-action");
        //alert(url);return;
        $.ajax({
            type: "POST",
            url: url,
            data: {categoryID:valuetxt}, // serializes the form's elements.
            datatype:'JSON',
            beforeSend: function(request) {
            },
            success:function(res){
            res = JSON.parse(res);
            $('#subCategory').find('option').remove().end().append('<option value=""> --Select Sub category--</option>');
            if(res.flag == "F")
            {
                
            }   // alert(res.msg);
            if(res.flag == "S"){
                if(res.data!="")
                {
                    //$('#subCategory').append("<option value='"+sub_cat_id+"'>"+sub_cat_name+"</option>");
                    res.data.forEach(function(opt){
                        //$('#subCategory').html(opt.sub_cat_name);
                     $('#subCategory').append("<option value='"+opt.sub_cat_id+"'>"+opt.sub_cat_name+"</option>");
                    })
                }
                
            }
            setTimeout(function(){
                 $("#save").html("");
            }, 3000);
            }
        });
    });

});