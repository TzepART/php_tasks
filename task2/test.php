<?php
/*
 * 1. Использовать полный путь до файла, а не относительный
 * 2. Должна быть проверка на существование файла
 * 3. Должна быть проверка на возможность чтения и записи в файл
 * 4. Использовать блокировку файла на время чтения и записи
 * 5. Использовать приведение типов к int, если файл содержит например текст
 * Проблема при параллельном использовании этого счетчика
 * */

$fullPath = __DIR__."/counter.txt"; // Full Path
$logPath = __DIR__."/log.txt"; // Full Path
$logMessage = '';

if(file_exists($fullPath)){
    $fp = fopen($fullPath,"a+");
    // проверка файла на чтение и на запись
    if ($fp) {
        $locked = flock($fp,LOCK_EX); // Блокирование файла для чтения и записи
        if($locked) {
            $fileSize = filesize($fullPath) > 0 ? filesize($fullPath) : 100;
            $count=fread($fp,$fileSize);
            @$count++;
            ftruncate($fp,0);//предварительно очистим файл
            fwrite($fp,$count);
            fflush($fp);
            flock($fp,LOCK_UN);
            fclose($fp);
        }else{
            $logMessage .= "File blocked on read and write!\n";
            fclose($fp);
        }
    } else {
        $logMessage .= "The file is not available\n";
    }
}else{
    file_put_contents($fullPath, 1);
}

//логирование ошибок
if(!empty($logMessage)){
    file_put_contents($logPath, $logMessage, FILE_APPEND);
}