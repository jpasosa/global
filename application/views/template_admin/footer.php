<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

			</div>
			<!-- Fin col -->
		</div>
    <!-- Fin row -->
    <!-- Fin Content -->

    <span  class="scrollup"><img src="http://www.iconpng.com/png/pictograms/arrow_up_1.png" width="100" height="100"></span>


	<?php if(isset($scripts)):?>
	<?php echo $scripts;?>
	<?php endif;?>

    <!-- Footer -->

    <div class="bs-footer" role="contentinfo" style="padding-top: 220px;">
    <div class="container">
        <div class="col-md-9" >
            <p class="text-muted credit">
                <a href="<?php echo base_url('admin/login'); ?>" target="_blank">Global Inversion</a>
                <br> Desarrollado por <a href="http://www.allytech.com/"> webalibre.com.ar</a> &copy; <?php echo date('Y');?>
            </p></div>
        <!-- <div class="col-md-3" style="float:right;">
        <img src="<?php echo PUBLIC_FOLDER;?>imagenes/img.png">
        </div> -->
    </div>

    </div>
    <!-- End Footer -->

</body>
</html>
