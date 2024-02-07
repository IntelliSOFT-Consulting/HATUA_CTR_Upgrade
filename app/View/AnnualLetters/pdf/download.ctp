<div class="ctr-groups"> 
    <?php echo $AnnualLetter['AnnualLetter']["content"]; ?>
    <br>
    <?php  
        if(!empty($AnnualLetter['AnnualLetter']['qrcode'])){
        $decodedImage = base64_decode($AnnualLetter['AnnualLetter']['qrcode']);
        echo $decodedImage;}
        ?>
</div>