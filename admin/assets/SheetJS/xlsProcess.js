/**
 * xlsProcess js
 * v1.0.0
 * MIT license
 */
 /*! =========================================================
 * xlsProcess.js
 *
 * Maintainers:
 *      Kiran Malave
 *          - skype: @kiran.malave
 *
 * =========================================================
 */
(function($){
	$.fn.xlsprocess = function(options){
         var XLSX2OJ = options.XLSX2;
        var global_wb;
		var settings = $.extend({},$.fn.xlsprocess.defaults,options),filelist=[];
        var onSucess = settings.onSucess;
        uploadbuttonhandeller = function(fileobj){
            if(fileobj.files.length > 0 )
                $("#"+settings.uploadButtonID).removeAttr("disabled");
            else
                $("#"+settings.uploadButtonID).attr("disabled",true);
                
        }
    	var process_wb = (function() {
        var OUT = options.out;
        var HTMLOUT = options.htmlout;
        var get_format = function() {
            return options.format;
        /*var radios = document.getElementsByName( "format" );
        return function() {
          for(var i = 0; i < radios.length; ++i) if(radios[i].checked || radios.length === 1) return radios[i].value;
        };*/
        };

        var to_json = function to_json(workbook) {
        var result = {};
        workbook.SheetNames.forEach(function(sheetName) {
          var roa = XLSX2OJ.utils.sheet_to_json(workbook.Sheets[sheetName],{raw:false,defval:'',header:0,blankrows:false});
          if(roa.length) result[sheetName] = roa;
        });
        renderJsonDetails = JSON.stringify(result, 2, 2);
        if ($.isFunction(onSucess)){
            onSucess.call(this,renderJsonDetails); 
        }
        //return JSON.stringify(result, 2, 2);
      };

      var to_csv = function to_csv(workbook) {
        var result = [];
        workbook.SheetNames.forEach(function(sheetName) {
          var csv = XLSX2OJ.utils.sheet_to_csv(workbook.Sheets[sheetName]);
          if(csv.length){
            result.push("SHEET: " + sheetName);
            result.push("");
            result.push(csv);
          }
        });
        if ($.isFunction(onSucess)){
            onSucess.call(this,result.join("\n")); 
        }
        //return result.join("\n");

      };

      var to_fmla = function to_fmla(workbook) {
        var result = [];
        workbook.SheetNames.forEach(function(sheetName) {
          var formulae = XLSX2OJ.utils.get_formulae(workbook.Sheets[sheetName]);
          if(formulae.length){
            result.push("SHEET: " + sheetName);
            result.push("");
            result.push(formulae.join("\n"));
          }
        });
        if ($.isFunction(onSucess)){
            onSucess.call(this,result.join("\n")); 
        }
        //return result.join("\n");
      };

      var to_html = function to_html(workbook) {
        //HTMLOUT.empty();
        var html ="";
        workbook.SheetNames.forEach(function(sheetName) {
          var htmlstr = XLSX2OJ.write(workbook, {sheet:sheetName, type:'string', bookType:'html'});
          html += htmlstr;
        });
        if ($.isFunction(onSucess)){
            onSucess.call(this,html); 
        }
        //return "";
      };

      return function process_wb(wb) {
        global_wb = wb;
        var output = "";
        switch(get_format()) {
          case "form": output = to_fmla(wb); break;
          case "html": output = to_html(wb); break;
          case "json": output = to_json(wb); break;
          default: output = to_csv(wb);
        }
        OUT.html(output);
        if(typeof console !== 'undefined') console.log("output", new Date());
      };
    })();
          var drop = options.drop; //document.getElementById('drop');
          
          function handleDrop(e) {
            e.stopPropagation();
            e.preventDefault();
            do_file(e.dataTransfer.files);
          }

          function handleDragover(e) {
            e.stopPropagation();
            e.preventDefault();
            e.dataTransfer.dropEffect = 'copy';
          }

            var setfmt = window.setfmt = function setfmt() { if(global_wb) process_wb(global_wb); };

            var b64it = window.b64it = (function(){
                var tarea = document.getElementById('b64data');
                return function b64it()
                {
                    if(typeof console !== 'undefined') console.log("onload", new Date());
                    var wb = X.read(tarea.value, {type:'base64', WTF:false});
                    process_wb(wb);
                };
            })();


          (function() {
            var drop = options.dropID;
            if(typeof(drop) !=='undefined'){
                
                if(!drop.addEventListener) return;
                function handleDrop(e) {
                    e.stopPropagation();
                    e.preventDefault();
                    do_file(e.dataTransfer.files);
                }

                function handleDragover(e) {
                    e.stopPropagation();
                    e.preventDefault();
                    e.dataTransfer.dropEffect = 'copy';
                }

                drop.addEventListener('dragenter', handleDragover, false);
                drop.addEventListener('dragover', handleDragover, false);
                drop.addEventListener('drop', handleDrop, false);
            }
        })();
          

        var do_file = (function() {
          var rABS = typeof FileReader !== "undefined" && (FileReader.prototype||{}).readAsBinaryString;
          var domrabs = options.userabs;//document.getElementsByName("userabs")[0];
          if(!rABS) domrabs.disabled = !(domrabs.checked = false);

          var use_worker = false && typeof Worker !== 'undefined';
          var domwork = options.useworker; //document.getElementsByName("useworker")[0];
          if(!use_worker) domwork.disabled = !(domwork.checked = false);

          var xw = function xw(data, cb) {
            var worker = new Worker(XW.worker);
            worker.onmessage = function(e) {
              switch(e.data.t) {
                case 'ready': break;
                case 'e': console.error(e.data.d); break;
                case XW.msg: cb(JSON.parse(e.data.d)); break;
              }
            };
            worker.postMessage({d:data,b:rABS?'binary':'array'});
          };

          return function do_file(files) {
            rABS = domrabs.checked;
            use_worker = domwork.checked;
            var f = files[0];
            var reader = new FileReader();
            reader.onload = function(e) {
              if(typeof console !== 'undefined') console.log("onload", new Date(), rABS, use_worker);
              var data = e.target.result;
              if(!rABS) data = new Uint8Array(data);
              if(use_worker) xw(data, process_wb);
              else process_wb(XLSX2OJ.read(data, {type: rABS ? 'binary' : 'array'}));
            };
            if(rABS) reader.readAsBinaryString(f);
            else reader.readAsArrayBuffer(f);
          };
        })();  
        
        onFilesSelected = function(){
            globalFile = this;
            uploadbuttonhandeller(this);
        }
        $("#"+settings.uploadButtonID).on('click',function(){
            
            if(typeof(globalFile) == "undefined"){
              alert("Please select file to process");
              return false;
            }
            var filetype = true;
            console.log(settings.fileTypes);
             Array.prototype.forEach.call(globalFile.files,function(file,index) {
              var fileExt = file.name;
               fileExt = fileExt.substring(fileExt.lastIndexOf('.'));
              if(settings.fileTypes.indexOf(fileExt) < 0){
                     filetype = true;   
              }
              else{ filetype = false;}
            });
            if(!filetype){
              alert("Unsupported file format");
              return false;
            }
            do_file(globalFile.files);
        });
        this.on('change',onFilesSelected);
        return this.each(function(e){
    	});
    };
	$.fn.xlsprocess.defaults = {
		    out:'',
        htmlout:'uploadImages',
        format:'json', //form,html,json
        XLSX2:'',
        dropID:'',
        userabs:true, // Use readAsBinaryString: (when available)
        useworker:true, // Use Web Workers: (when available)
        uploadButtonID:'',
		    fileTypes:['xls'],
		onFilesSelected : function(settings){},
        onsucess : function(){},
	};
})(jQuery);