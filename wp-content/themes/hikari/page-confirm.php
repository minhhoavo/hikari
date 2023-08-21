<?php get_header(); ?>
<main class="p-contact">
<?php custom_breadcrumbs(); ?>
	<div class="c-headpage">
		<div class="l-container2">
			<h2 class="c-title">お問い合わせ内容確認</h2>
		</div>
	</div>
	<div class="p-contact__content c-confirm">
		<div class="l-container">
			<p class="notice">以下の内容を送信してもよろしいですか？</p>
			<?php echo do_shortcode('[mwform_formkey key="149"]'); ?>
		</div>		
	</div>
</main>
<?php get_footer(); ?>