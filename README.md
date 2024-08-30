# PHP-ML Image Classification

A simple project using PHP-ML to classify payment receipt images.

## Project Structure

The project follows this folder structure:

```
dataset/
├── non_receipts/
│   └── *.jpeg        # Non-receipt images
├── receipts/
│   └── *.jpeg        # Receipt images
sample/
└── *.jpeg            # Images to classify
```

### Image Placement

- **Receipt Images**: Place images of receipts in the `dataset/receipts/` directory.
- **Non-Receipt Images**: Place images that are not receipts in the `dataset/non_receipts/` directory.
- **Sample Images**: Place the images you want to classify in the `sample/` directory.

### Image Format

- All images should be in `.jpeg` format.

## Memory Requirements

To run the scripts in this project, a minimum memory limit of **512MB** is required. You can set this in your PHP configuration or directly in the script using:

```php
ini_set('memory_limit', '512M');
```

## Installation

To get started with the project, follow these steps:

1. **Install Dependencies**:
   Use Composer to install the required libraries:

   ```bash
   composer install
   ```

2. **Create Required Directories**:

   - **For Unix-like Systems (Linux, macOS)**:
     ```bash
     mkdir -p dataset/receipts dataset/non_receipts sample
     ```

   - **For Windows**:
     ```bash
     mkdir dataset\receipts dataset\non_receipts sample
     ```

   This will ensure that the necessary folders for storing images are created.

## Usage

### 1. Train the Model

To train the classifier with the images in the `dataset` folder, run:

```bash
php training.php
```

### 2. Classify a Sample Image

To classify an image in the `sample` folder, run:

```bash
php classify.php
```

### 3. Preview Differences (Optional)

To preview the differences between classified images, start a local PHP server:

```bash
php -S 127.0.0.1:8000
```

## Additional Notes

- Ensure all images are in `.jpeg` format before adding them to their respective directories.
- The trained model will be saved after running the training script, and can be used later for classification.

---

This version is structured to be clear and concise, providing all the necessary information in a well-organized manner.