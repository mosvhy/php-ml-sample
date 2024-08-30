<?php
$samples = [];
$files = glob("./sample" . "/*");
foreach ($files as $file) {
    if (is_file($file)) {
        $samples[] = "sample/" . basename($file);
    }
}
$receipts = json_decode(file_get_contents("./result/receipt.json"));
$non_receipts = json_decode(file_get_contents("./result/non_receipt.json"));
?>

<style>
    body {
        background: black
    }

    div {
        margin: 0px 20px;
        padding: 0px;
        width: 100px;
        height: 100px;
        display: inline-block;
        background-size: 100% 100%;
        background-repeat: no-repeat;
    }

    img {
        width: 100px;
        height: 100px;
    }
</style>
<section id="root"></section>
<script>
    var non_receipts = <?= json_encode($non_receipts); ?>;
    var samples = [];
    for (let i = 1; i <= <?= count($samples) ?>; i++) {
        samples.push(`sample/xx_sample${i}.jpeg`);
    }
    for (const sample of samples) {
        var name = sample.replace('sample/', '');
        var div = document.createElement('div');
        var label = document.createElement('label');

        var red = '';
        if (non_receipts.includes(sample)) red = 'border: 1px solid red';

        var span = document.createElement('span');
        span.setAttribute('style', 'color:red;');
        span.innerHTML = '&times; - ';

        if (red !== '') label.appendChild(span);
        var span = document.createElement('span');
        span.innerText = name;
        label.appendChild(span);

        label.setAttribute('style', 'background:black;color:white;margin-top:-24px;position:absolute;');
        div.appendChild(label);
        div.setAttribute('style', `background-image:url(sample/${name});margin-top:24px;${red}`);
        document.getElementById('root').appendChild(div);
    }
</script>