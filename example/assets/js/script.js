$(function(){
    var fileInput = $('.upload-file');
    var maxSize = fileInput.data('max-size');
    
    // Se a janela de escolha de arquivo fechar ao dar enter,
    // atualiza tamanho dos arquivos
    $('.upload-file').keydown(function(e){
        if (e.keyPress == 13){
            setTimeout(function(){
                if(fileInput.get(0).files.length){
                    var files = fileInput.get(0).files;
                    var fileSize = 0;
                    
                    for(var i=0; i < files.length; i++){
                        fileSize += files[i].size;
                    }

                    //console.log(fileInput.get(0).files);

                    $('.modal-body p').html('Tamanho: '+(fileSize/Math.pow(10,6)).toFixed(2)+' MB');
                }    
            },150);
        }
    });

    // Se a janela de escolha de arquivo fechar, atualiza tamanho dos arquivos
    $('.upload-file').focus(function(){
        setTimeout(function(){
            if(fileInput.get(0).files.length){
                var files = fileInput.get(0).files;
                var fileSize = 0;
                
                for(var i=0; i < files.length; i++){
                    fileSize += files[i].size;
                }

                //console.log(fileInput.get(0).files);

                $('.upload-file-size').html((fileSize/Math.pow(10,6)).toFixed(2)+' MB');
                if(fileSize > 2000000){
                    $('.upload-file-size').css('color', 'red');
                }
                else{
                    $('.upload-file-size').css('color', 'green');
                }
            }
            else{
                $('.upload-file-size').html('0 MB');
                $('.upload-file-size').css('color', 'green');
            }
        },150);
        
    });

    $('#anuncio_form').submit(function(e){
        if(fileInput.get(0).files.length){
            var fileSize = fileInput.get(0).files[0].size; // in bytes
            if(fileSize>maxSize){
                console.log(maxSize);
                console.log(typeof maxSize);
                alert('Erro! O tamanho dos arquivos é maior do que ' + maxSize/Math.pow(10,6) + ' MB');
                return false;
            }
        }
        
    });
});