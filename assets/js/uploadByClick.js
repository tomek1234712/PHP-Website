jQuery( document ).ready(function($){
    $(".upload-blocks .myUploadArea").live("click",function(){
        $(this).parent("div").find('input[type=file]').click();
    });
    $('input[name="uploadbyclick"]').live("change",function(){
            var file = this.files[0];
            var Area = $(this).parent();
            name = file.name;
            size = file.size;
            type = file.type;

            if(file.name.length < 1) {

            }
            else if(file.size > 6000000) { // 6000000 == 6MB
                alert("Plik jest za duży. Załaduj plik mniejszy niż 6MB." );
            }
            else { 
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '/wp-content/themes/kerris/ajax/uploadFile.php');
                xhr.onload = function() {
                    jQuery(Area).removeClass('loadingnow');
                    jQuery(Area).addClass('fileset');
                    jQuery(Area).find('.result').html(this.responseText);
                    var filename = jQuery(Area).find('.fileName').attr("data-text");
                    jQuery(Area).find(".title").text(filename);
                };
                xhr.onerror = function() {
                    jQuery(Area).find('.result').html(this.responseText);
                };
                xhr.upload.onprogress = function(event) {
    
                }
                xhr.upload.onloadstart = function(event) {
                    jQuery(Area).addClass('loadingnow');
                }

                // prepare FormData
                var formData = new FormData();  
                formData.append('myfile', file); 
                xhr.send(formData);
            }
    });
});