<script src="/inspinia/js/jquery-2.1.1.js"></script>
<script src="/js/jquery.cookie.js"></script>
<script src="/inspinia/js/bootstrap.min.js"></script>
<script src="/inspinia/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="/inspinia/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="/inspinia/js/plugins/ckeditor/ckeditor.js"></script>
<script src="/inspinia/js/inspinia.js"></script>
<script src="/inspinia/js/plugins/pace/pace.min.js"></script>
<script src="/inspinia/js/plugins/touchspin/jquery.bootstrap-touchspin.min.js"></script>
<script src="/inspinia/js/plugins/jquery-ui/jquery-ui.min.js"></script>
{{--<script src="/inspinia/js/plugins/dropzone/dropzone.js"></script>--}}
<script src="/inspinia/js/plugins/iCheck/icheck.min.js"></script>
<script>
	$( document ).ready( function(){
		$( '.i-checks' ).iCheck( {
			checkboxClass: 'icheckbox_square-green',
			radioClass   : 'iradio_square-green',
		} );

	} );
</script>
<script src="/assets/translit/js/translite.js"></script>
<script src="/inspinia/js/common.js"></script>
@if(Request::path() == 'admin/text_generator' || Request::path() == 'admin/metatags')
{{--	<script src="/inspinia/js/plugins/select2/select2.full.min.js"></script>--}}
	<script src="/inspinia/js/text_generator.js"></script>
@endif