<?php
/*
 * 1. Использовать полный путь до файла, а не относительный
 * 2. Должна быть проверка на существование файла
 * 3. Должна быть проверка на возможность чтения файла
 * 4. Должна быть проверка на возможность записи в файл
 * 5. Использовать блокировку файла на время чтения и записи
 * 6. Использовать приведение типов к int, если файл содержит например текст
 * Проблема при параллельном использовании этого счетчика
 * */

$fullPath = __DIR__."/counter.txt"; // Full Path
$logPath = __DIR__."/log.txt"; // Full Path
$logMessage = '';

if(file_exists($fullPath)){
    $fpRead = fopen($fullPath, "r");
    // проверка файла на чтение
    if ($fpRead) {
        $locked = flock($fpRead, LOCK_SH, $waitIfLocked); // Блокирование файла для чтения
        if($locked) {
            $fileSize = filesize($fullPath) > 0 ? filesize($fullPath) : 80;
            $count = (int) fread($fpRead, $fileSize);
            flock($fpRead, LOCK_UN); // Снятие блокировки
            fclose($fpRead);

            $fpWrite = fopen($fullPath, "w");
            $locked = flock($fpWrite, LOCK_EX, $waitIfLocked); // Блокирование файла для записи
            // проверка файла на запись
            if($fpWrite){
                if($locked) {
                    fwrite($fpWrite, $count + 1);
                    fflush($fpWrite);
                    flock($fpWrite, LOCK_UN); // Снятие блокировки
                } else {
                    $logMessage .= "File blocked on write! Status - $waitIfLocked\n";
                }
                fclose($fpWrite);
            }else{
                $logMessage .= "The file is not writable\n";
                fclose($fpWrite);
            }
        }else{
            fclose($fpRead);
            $logMessage .= "File blocked on read! Status - $waitIfLocked !\n";
        }
    } else {
        $logMessage .= "The file is not readable\n";
        fclose($fpRead);
    }
}else{
    file_put_contents($fullPath, 1);
}

//логирование ошибок
if(!empty($logMessage)){
    file_put_contents($logPath, $logMessage);
}