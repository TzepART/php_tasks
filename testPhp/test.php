<?php
/*
 * 1. Использовать полный путь до файла, а не относительный
 * 2. Должна быть проверка на существование файла
 * 3. Должна быть проверка на возможность чтения файла
 * 4. Должна быть проверка на возможность записи в файл
 * 5. Использовать блокировку файла на время записи
 * 6. Использовать приведение типов к int, если файл содержит например текст
 * Проблема при параллельном использовании этого счетчика
 * */

$fullPath = __DIR__."/counter.txt"; // Full Path
$logPath = __DIR__."/log.txt"; // Full Path

//$fp = fopen($fullPath, 'c+');
//flock($fp, LOCK_SH | LOCK_EX | LOCK_NB); // Блокирование файла для записи и чтения
//$fileSize = filesize($fullPath);
//if($fileSize > 0){
//    $str = fread($fp, $fileSize);
//    $currentCount = (int) $str;
//}else{
//    $currentCount = 0;
//}
//$message = " The file is writable\n";
//fwrite($fp, (string) ($currentCount + 1));
//flock($fp, LOCK_UN | LOCK_NB); // Снятие блокировки
//fclose($fp);

$fp = fopen("/tmp/lock.txt", "r+");

if (flock($fp, LOCK_EX)) { // выполняем эксклюзивную блокировку
    ftruncate($fp, 0); // очищаем файл
    fwrite($fp, "Что-нибудь пишем сюда\n");
    fflush($fp);        // очищаем вывод перед отменой блокировки
    flock($fp, LOCK_UN); // снимаем блокировку
} else {
    echo "Не удалось получить блокировку!";
}

fclose($fp);

//if(file_exists($fullPath)){
//    if (is_readable($fullPath)) {
//        $message .= "The file is readable\n";
//        $currentCount = (int) file_get_contents($fullPath);
//        if(is_writable($fullPath)){
//
//        }else{
//            $message .= "The file is not writable\n\n";
//        }
//    } else {
//        $message .= "The file is not readable\n\n";
//    }
//
//}else{
//    file_put_contents($fullPath, 1);
//    $message .= "The file is create\n\n";
//}
$handle = fopen($fullPath, 'c+');
flock($handle, LOCK_SH | LOCK_EX | LOCK_NB); // Блокирование файла для записи и чтения
$contents = (int) fread($handle, filesize($fullPath));
fclose($handle);
file_put_contents($logPath,($contents+5)."\n",FILE_APPEND | LOCK_EX);
