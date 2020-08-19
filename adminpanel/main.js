function validateFiles(options) {
    var result = [],
        file;

    // Перебираем файлы
    options.$files.each(function(index, $file) {
        // Выбран ли файл
        if (!$file.files.length) {
            result.push({index: index, errorCode: 'no_file'});
            // Остальные проверки не имеют смысла, переходим к следующему файлу
            return;
        }
        file = $file.files[0];
        // Проверяем тип файла
        if (options.types.indexOf(file.type) === -1) {
            result.push({index: index, name: file.name, errorCode: 'wrong_type'});
        }
    });

    return result;
}

//Отправка категории в inserter.php
$(function(){
    $('#f1').on('submit', function(e){
        e.preventDefault();
        var $that = $(this),
        formData = new FormData($that.get(0)); // создаем новый экземпляр объекта и передаем ему нашу форму (*)
        for (key of formData.keys()) {
            console.log(`${key}: ${formData.get(key)}`);
        }
        $.ajax({
            url         : 'inserter.php',
            type        : 'POST', // важно!
            data        : formData,
            cache       : false,
            // dataType    : 'json',
            contentType: false, // важно - убираем форматирование данных по умолчанию
            processData: false, // важно - убираем преобразование строк по умолчанию
            
            success: function(otvet, respond, status, jqXHR ){

                console.log(otvet);
                var found = otvet.match(/\brepeat\b/i);
                if(found !== null){
                    $('#bigCatRepeat').fadeIn(500);
                }
                else
                {
                    $('#bigCatRepeat').fadeOut(200);
                    $('input[type="text"]', $that).val('');
                    $('select', $that).val('1');
                    $('.divConfirme').fadeIn(1000);
                    $('.divConfirme').delay(2000).fadeOut(1000);
                }
                
                },
                // функция ошибки ответа сервера
                error: function( jqXHR, status, errorThrown ){
                console.log( 'ОШИБКА AJAX запроса: ' + status, jqXHR );
                $('input[type="text"]', $that).val('');

                $('.divConfirme').fadeIn(1000);
                $('.divConfirme').delay(2000).fadeOut(1000);
            }
                
        });
    })
})

// Отправка подкатегории в inserter.php
$(function(){
    $('#f2').on('submit', function(e){
        e.preventDefault();
        var $that = $(this),
        formData = new FormData($that.get(0)); // создаем новый экземпляр объекта и передаем ему нашу форму (*)
        for (key of formData.keys()) {
            console.log(`${key}: ${formData.get(key)}`);
        }
        $.ajax({
            url         : 'inserter.php',
            type        : 'POST', // важно!
            data        :formData,
            cache       : false,
            // dataType    : 'json',
            contentType: false, // важно - убираем форматирование данных по умолчанию
            processData: false, // важно - убираем преобразование строк по умолчанию
            
            success: function(otvet, respond, status, jqXHR ){
                console.log(otvet);
                var found = otvet.match(/\brepeat\b/i);
                if(found !== null){
                    $('#CatRepeat').fadeIn(500);
                }
                else
                {
                    $('#CatRepeat').fadeOut(200);
                    $('input[type="text"]', $that).val('');
                    $('select', $that).val('1');
                    $('.divConfirme').fadeIn(1000);
                    $('.divConfirme').delay(2000).fadeOut(1000);
                }
                },
                // функция ошибки ответа сервера
                error: function( jqXHR, status, errorThrown ){
                console.log( 'ОШИБКА AJAX запроса: ' + status, jqXHR );
                $('input[type="text"]', $that).val('');
                $('select', $that).val('1');

                $('.divConfirme').fadeIn(1000);
                $('.divConfirme').delay(2000).fadeOut(1000);
            }
        });
    })
})

// Отправка файлов в inserter.php
$(function(){
    $('#f3').on('submit', function(e){
        e.preventDefault();

        // получаем картинку
        var $zipsite = $('#img-work-card'),
            formdata = new FormData,
            validationErrors = validateFiles({
                $files: $zipsite,
                types: ['image/jpeg', 'image/jpg', 'image/png']
            });
        
        // Проверяем получена ли картинка
        var imgcheck = 0;
        if (validationErrors.length) {
            console.log('client validation errors: ', validationErrors);
            // если картинка не получена, выводим уведомление ставим флаг в 1
            $('#imgErrNote').fadeIn(500);
            imgcheck = 1;
        }

        // получаем архив
        var $preview = $('#file-work-card'),
            formdata = new FormData,
            validationErrors = validateFiles({
                $files: $preview,
                types: ['application/x-zip-compressed']
            });

        // проверяем получен ли архив
        var zipcheck = 0;
        if (validationErrors.length) {
            console.log('client validation errors: ', validationErrors);
            // если архив не получен, выводим уведомление ставим флаг в 1
            $('#zipErrNote').fadeIn(500);
            zipcheck = 1;
        }

        // если было выведено уведомление об ошибке, убираем его
        if(imgcheck == 0){
            $('#imgErrNote').fadeOut(200);
        }
        if(zipcheck == 0){
            $('#zipErrNote').fadeOut(200);
        }

        // если у нас хоть что-то не загружено, прекращаем работу функции
        if (imgcheck == 1 || zipcheck == 1){
            return false;
        }

        var $that = $(this),
        formData = new FormData($that.get(0)); // создаем новый экземпляр объекта и передаем ему нашу форму (*)
        for (key of formData.keys()) {
            console.log(`${key}: ${formData.get(key)}`);
        }
        $.ajax({
            url         : 'inserter.php',
            type        : 'POST',
            data: formData,
            cache       : false,
            // dataType    : 'json',
            contentType: false, // убираем форматирование данных по умолчанию
            processData: false, // убираем преобразование строк по умолчанию
            
            success: function( respond, status, jqXHR ){

                // ОК - файлы загружены
                if( typeof respond.error === 'undefined' ){
                    // выведем пути загруженных файлов в блок '.ajax-reply'
                    var files_path = respond.files;
                    var html = '';
                    $.each( files_path, function( key, val ){
                        html += val +'<br>';
                    } )
                    

                    $('.ajax-reply').html( html );
                }
                // ошибка
                else {
                    console.log('ОШИБКА: ' + respond.data );
                }
                console.log('Success');
                $('input[type="text"], input[type="file"]', $that).val('');
                $('select', $that).val('1');
                $('.divConfirme').fadeIn(1000);
                $('.divConfirme').delay(2000).fadeOut(1000);
                },
                // функция ошибки ответа сервера
                error: function( jqXHR, status, errorThrown ){
                console.log( 'ОШИБКА AJAX запроса: ' + status, jqXHR );
                $('input[type="text"], input[type="file"]', $that).val('');
                $('select', $that).val('1');

                $('.divConfirme').fadeIn(1000);
                $('.divConfirme').delay(2000).fadeOut(1000);
            }  
        });
    });
});