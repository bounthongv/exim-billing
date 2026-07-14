  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<?php
if (!defined('IN_CB')) { die('You are not allowed to access to this page.'); }
?>
<style>
.ttb{ width:805px; }

</style>
            <div class="output">
                <section class="output">
                    <h3>
                
     <button type="button" class="btn btn-info" onclick="window.location.href='../../index.php?gp_id=<?=filter_var($_GET['gp_id'], FILTER_SANITIZE_STRING); ?>'" ><i class="fa fa-arrow-circle-left"></i> &nbsp; Back</button>&nbsp;&nbsp;&nbsp;
                    
     <button type="button" class="btn btn-success" onclick="javascript:Clickheretoprint()" ><i class="fa fa-print"></i> &nbsp; Print</button>      
                    </h3>
                    
                    <?php
                        $finalRequest = '';
                        foreach (getImageKeys() as $key => $value) {
                            $finalRequest .= '&' . $key . '=' . urlencode($value);
                        }
                        if (strlen($finalRequest) > 0) {
                            $finalRequest[0] = '?';
                        }
                    ?>
                    <div id="imageOutput" class="ttb" >
                   
						<?php
						$N=$ncode;
						for($i=0; $i < $N; $i++)
						{
						?>
                        <?php if ($imageKeys['text'] !== '') { ?><img style="margin: 0px 48px 28px 16px; width:134px;  " src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" /><?php }
                        else { ?>Fill the form to generate a barcode.<?php } }?>
                        
                    </div>
                </section>
            </div>
        </form>

        <div class="footer">
            <footer>
            All Rights Reserved &copy; <?php date_default_timezone_set('UTC'); echo date('Y'); ?> <a href="http://www.barcodephp.com" target="_blank">Barcode Generator</a>
            <br /><?php echo $code; ?> PHP5-v<?php echo $codeVersion; ?>
            </footer>
        </div>
    </body>
</html>