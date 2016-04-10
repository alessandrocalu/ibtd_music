<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script>
    function voltar() {
        window.location = '<?php echo  base_url("index.php/".$controller);  ?>';
    }

<?php 
if (isset($mensagem)){
?>

    $(document).ready(function() {
    	
            $('#retorno_modal').html('<div class="alert alert-danger"> <?php echo $mensagem; ?> </div>');
        
    });

<?php 
}
?>	
</script>