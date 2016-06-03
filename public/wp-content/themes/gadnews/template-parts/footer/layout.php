<?php
/**
 * The template for displaying the default footer layout.
 *
 * @package gadnews
 */

?>
<div class="footer-area-wrap invert">
	<div class="container">
		<?php do_action( 'gadnews_render_widget_area', 'footer-area' ); ?>
	</div>
</div>

<?php /*
<div class="footer-container invert">
	<div class="container">
		<div <?php echo gadnews_get_container_classes( array( 'site-info' ) ); ?>>
			<div class="site-info__flex">
				<div class="site-info__mid-box"><?php
					gadnews_footer_copyright();
				?></div>
			</div>
		</div><!-- .site-info -->
	</div>
</div><!-- .container -->
*/ ?>

<style type="text/css">
	.wca-footer-mid {
    display: inline-block;
    width: 567px;
}
.wca-logo-white {
    display: inline-block;
    width: 105px;
    height: 20px;
    background-image: url('//lojavirtual.digital/image/catalog/webca/logo_nb_white.png');
    background-size: 105px 20px;
    font-size: 1px;
}

</style>

<footer style="padding-top: 30px; background-color: #f6ae3b; color: #FFFFFF; padding-bottom: 10px; font-size: 12px;">
  <div class="container">
    <div class="wca-footer-mid">
      <p>Loja Virtual .digital - WebCA Internet © 2011 - 2016</p> 
    </div>
    <div class="wca-footer-mid" style="text-align: right;">
      <div class="wca-logo-white">&nbsp;</div>
    </div>

    <p>Webca Serviços de Internet e tecnologia / CNPJ: 13.391.967/0001&shy;-93 / CCM : 4.248.789-7<br>Em São Paulo no Ipiranga: Rua Silva Bueno, 83 - São Paulo, SP - 04208&shy;-050, na Vila Mariana: Rua Embuaçu, 625, Sala 6 - São Paulo - SP - 04118-080<br>Atendimento ao cliente 11 2376-0583 ou via e-mail contato@lojavirtual.digital</p>
    
    <p>&nbsp;</p>
    

  </div>
</footer>