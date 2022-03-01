		<!-- Vendor js -->
		<script src="<?= base_url() ?>assets/js/vendor.min.js"></script>

		<!-- knob plugin -->
		<script src="<?= base_url() ?>assets/libs/jquery-knob/jquery.knob.min.js"></script>

		<?php if ($this->uri->segment(1) == 'dashboard') : ?>
			<!--Morris Chart-->
			<script src="<?= base_url() ?>assets/libs/morris-js/morris.min.js"></script>
			<script src="<?= base_url() ?>assets/libs/raphael/raphael.min.js"></script>
			<!-- Dashboard init js-->
			<script src="<?= base_url() ?>assets/js/pages/dashboard.init.js"></script>
		<?php endif ?>


		<!-- third party js -->
		<script src="<?= base_url() ?>assets/libs/datatables/jquery.dataTables.min.js"></script>
		<script src="<?= base_url() ?>assets/libs/datatables/dataTables.bootstrap4.js"></script>
		<script src="<?= base_url() ?>assets/libs/datatables/dataTables.responsive.min.js"></script>
		<script src="<?= base_url() ?>assets/libs/datatables/responsive.bootstrap4.min.js"></script>
		<script src="<?= base_url() ?>assets/libs/datatables/dataTables.buttons.min.js"></script>
		<script src="<?= base_url() ?>assets/libs/datatables/buttons.bootstrap4.min.js"></script>
		<script src="<?= base_url() ?>assets/libs/datatables/buttons.html5.min.js"></script>
		<script src="<?= base_url() ?>assets/libs/datatables/buttons.flash.min.js"></script>
		<script src="<?= base_url() ?>assets/libs/datatables/buttons.print.min.js"></script>
		<script src="<?= base_url() ?>assets/libs/datatables/dataTables.keyTable.min.js"></script>
		<script src="<?= base_url() ?>assets/libs/datatables/dataTables.select.min.js"></script>
		<script src="<?= base_url() ?>assets/libs/pdfmake/vfs_fonts.js"></script>
		<!-- third party js ends -->

		<!-- Plugins Js -->
		<script src="<?= base_url() ?>assets/libs/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
		<script src="<?= base_url() ?>assets/libs/switchery/switchery.min.js"></script>
		<script src="<?= base_url() ?>assets/libs/multiselect/jquery.multi-select.js"></script>
		<script src="<?= base_url() ?>assets/libs/jquery-quicksearch/jquery.quicksearch.min.js"></script>

		<script src="<?= base_url() ?>assets/libs/select2/select2.min.js"></script>
		<script src="<?= base_url() ?>assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
		<script src="<?= base_url() ?>assets/libs/jquery-mask-plugin/jquery.mask.min.js"></script>
		<script src="<?= base_url() ?>assets/libs/moment/moment.js"></script>
		<script src="<?= base_url() ?>assets/libs/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
		<script src="<?= base_url() ?>assets/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.js"></script>
		<script src="<?= base_url() ?>assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
		<script src="<?= base_url() ?>assets/libs/bootstrap-daterangepicker/daterangepicker.js"></script>
		<script src="<?= base_url() ?>assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>

		<!-- dropify js -->
		<script src="<?= base_url() ?>assets/libs/dropify/dropify.min.js"></script>

		<!-- form-upload init -->
		<script src="<?= base_url() ?>assets/js/pages/form-fileupload.init.js"></script>

		<!-- Datatables init -->
		<script src="<?= base_url() ?>assets/js/pages/datatables.init.js"></script>
		<!-- Init js-->
		<script src="<?= base_url() ?>assets/js/pages/form-advanced.init.js"></script>

		<?php if ($this->uri->segment(2) == 'pencatatan_meteran' || $this->uri->segment(2) == 'periode_tagihan') : ?>
			<!-- Responsive Table js -->
			<script src="<?= site_url() ?>assets/libs/rwd-table/rwd-table.min.js"></script>
			<script src="<?= site_url() ?>assets/js/pages/responsive-table.init.js"></script>
		<?php endif ?>

		<!-- App js -->
		<script src="<?= base_url() ?>assets/js/app.min.js"></script>
		<!-- custome js -->
		<script src="<?= base_url() ?>assets/js/currency.js"></script>
		<!-- Modal-Effect -->
		<script src="<?= base_url() ?>assets/libs/custombox/custombox.min.js"></script>
		<!-- append script -->
		<!-- auto close -->
		<script>
			$(document).ready(function() {
				window.setTimeout(function() {
					$(".alert").fadeTo(500, 0).slideUp(500, function() {
						$(this).remove();
					});
				}, 10000);
			});
		</script>


		<script type="text/javascript">
			jQuery(document).delegate('a.add-record', 'click', function(e) {
				e.preventDefault();
				var base_unit = $('#unit_id').find(":selected").text();
				var content = jQuery('#sample_table tr'),
					size = jQuery('#tbl_posts >tbody >tr').length + 1,
					element = null,
					element = content.clone();

				element.attr('id', 'rec-' + size);
				element.find('.bu').html(base_unit);
				element.find('.delete-record').attr('data-id', size);
				element.appendTo('#tbl_posts_body');
				element.find('.sn').html(size);
				$("input[data-type='currency']").on({
					keyup: function() {
						formatCurrency($(this));
					},
					blur: function() {
						formatCurrency($(this), "blur");
					}
				});
			});
		</script>
		<script>
			jQuery(document).delegate('a.delete-record', 'click', function(e) {
				e.preventDefault();
				var didConfirm = confirm("Apakah Anda yakin untuk menghapus baris ?");
				if (didConfirm == true) {
					var id = jQuery(this).attr('data-id');
					var targetDiv = jQuery(this).attr('targetDiv');
					jQuery('#rec-' + id).remove();

					//regnerate index number on table
					$('#tbl_posts_body tr').each(function(index) {
						//alert(index);
						$(this).find('span.sn').html(index + 1);
					});
					return true;
				} else {
					return false;
				}
			});
		</script>
		<!-- bootstrap validation -->
		<script>
			(function() {
				'use strict';
				window.addEventListener('load', function() {
					// Fetch all the forms we want to apply custom Bootstrap validation styles to
					var forms = document.getElementsByClassName('needs-validation');
					// Loop over them and prevent submission
					var validation = Array.prototype.filter.call(forms, function(form) {
						form.addEventListener('submit', function(event) {
							if (form.checkValidity() === false) {
								event.preventDefault();
								event.stopPropagation();
							}
							form.classList.add('was-validated');
						}, false);
					});
				}, false);
			})();
		</script>

		<script>
			function myFunction() {
				var input, filter, table, tr, td, i, txtValue;
				input = document.getElementById("nama_pelanggan");
				filter = input.value.toUpperCase();
				table = document.getElementById("TableSearch");
				tr = table.getElementsByTagName("tr");
				for (i = 0; i < tr.length; i++) {
					td = tr[i].getElementsByTagName("td")[2];
					if (td) {
						txtValue = td.textContent || td.innerText;
						if (txtValue.toUpperCase().indexOf(filter) > -1) {
							tr[i].style.display = "";
						} else {
							tr[i].style.display = "none";
						}
					}
				}
			}
		</script>
		</body>

		</html>
