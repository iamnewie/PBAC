<?php
if (extension_loaded("pthreads")) {
        echo "Using pthreads\n";
} else  print_r(get_loaded_extensions());


class MyThread extends Thread {
    public function run(){
        //do something time consuming
    }
}

$t = new MyThread();
if($t->start()){
    while($t->isRunning()){
        echo ".";
        usleep(100);
    }
    $t->join();
}

?>