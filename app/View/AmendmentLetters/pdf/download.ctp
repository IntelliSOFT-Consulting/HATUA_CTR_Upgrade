<div class="ctr-groups"> 
    <?php echo $AmendmentLetter['AmendmentLetter']["content"]; ?>
    <br>
    <?php  
        if(!empty($AmendmentLetter['AmendmentLetter']['qrcode'])){
        $decodedImage = base64_decode($AmendmentLetter['AmendmentLetter']['qrcode']);
        echo $decodedImage;}
        ?>
</div>