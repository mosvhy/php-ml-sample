<?php
ini_set('memory_limit', '512M');

require 'vendor/autoload.php';
require 'ImageFeatures.php';

use Phpml\ModelManager;

function classify() {
    $modelManager = new ModelManager();
    // Load the model (optional)
    $classifier = $modelManager->restoreFromFile('receipt_classifier.model');
    // Predict
    $imagePaths = [];
    $files = glob("./sample" . "/*");
    foreach ($files as $file) {
        if (is_file($file) && basename($file) !== '.gitignore') {
            $imagePaths[] = 'sample/'.basename($file);
        }
    }
    function ms(){
        $microtime = microtime(true);
        $milliseconds = ($microtime - floor($microtime)) * 1000;
        $milliseconds = round($milliseconds);
        return $milliseconds;
    }
    $receipt = [];
    $non_receipt = [];
    foreach ($imagePaths as $imagePath) {
        // echo '['.date('H:i:s')  . '.'. ms();
        $features = ImageFeatures::extractFeatures($imagePath);
        
        $prediction = $classifier->predict($features);
        if ($prediction == 'receipt') $receipt[] = $imagePath;
        else if ($prediction == 'non_receipt') $non_receipt[] = $imagePath;
        // echo " - ".date('H:i:s') . '.'. ms().']';
        // echo "[$prediction]: $imagePath" . PHP_EOL;
    }
    $fp = fopen("result/receipt.json", 'w');
    fwrite($fp, json_encode($receipt));
    fclose($fp);
    $fp = fopen("result/non_receipt.json", 'w');
    fwrite($fp, json_encode($non_receipt));
    fclose($fp);
}

// predict current sample with current model
classify();