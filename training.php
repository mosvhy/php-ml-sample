<?php
ini_set('memory_limit', '512M');

require 'vendor/autoload.php';
require 'ImageFeatures.php';

use Phpml\Classification\KNearestNeighbors;
use Phpml\ModelManager;

function createModel()
{
    $modelManager = new ModelManager();
    function loadDataset($folderPath, $label)
    {
        $dataset = [];
        $files = scandir($folderPath);
        foreach ($files as $file) {
            if ($file !== '.' && $file !== '..' && $file !== '.gitignore') {
                $filePath = $folderPath . '/' . $file;
                $features = ImageFeatures::extractFeatures($filePath);
                $dataset[] = [$features, $label];
            }
        }
        return $dataset;
    }

    // Load datasets
    $receiptsDataset = loadDataset('dataset/receipts', 'receipt');
    $nonReceiptsDataset = loadDataset('dataset/non_receipts', 'non_receipt');

    $dataset = array_merge($receiptsDataset, $nonReceiptsDataset);
    $features = array_column($dataset, 0);
    $labels = array_column($dataset, 1);

    // Train the classifier
    $classifier = new KNearestNeighbors();
    $classifier->train($features, $labels);

    // Save the trained model (optional)
    $modelManager->saveToFile($classifier, 'receipt_classifier.model');
}

createModel();