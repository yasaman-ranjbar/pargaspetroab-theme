<?php
/**
 * Accessible B2B Technical Inquiry & Quotation Modal Component
 *
 * @package PargasPetroAb
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div id="pargas-inquiry-modal" class="pargas-modal" aria-hidden="true" role="dialog" aria-labelledby="pargas-modal-title" aria-modal="true">
	<div class="pargas-modal-overlay" id="pargas-modal-overlay" tabindex="-1"></div>
	<div class="pargas-modal-dialog">
		<div class="pargas-modal-content">
			<div class="pargas-modal-header">
				<h2 id="pargas-modal-title" class="pargas-modal-title">
					<?php esc_html_e( 'Request Engineering Quotation & Technical Proposal', 'pargaspetroab' ); ?>
				</h2>
				<button type="button" class="pargas-modal-close" id="pargas-modal-close-btn" aria-label="<?php esc_attr_e( 'Close quote inquiry dialog', 'pargaspetroab' ); ?>">
					&times;
				</button>
			</div>

			<div class="pargas-modal-body">
				<p class="pargas-modal-intro">
					<?php esc_html_e( 'Submit your water or wastewater treatment project specifications. Our technical engineering sales team will review your requirements and provide a comprehensive proposal within 24 business hours.', 'pargaspetroab' ); ?>
				</p>

				<form id="pargas-b2b-inquiry-form" class="pargas-form" method="post" action="">
					<input type="hidden" name="action" value="pargas_submit_inquiry" />
					<input type="hidden" name="nonce" value="<?php echo esc_attr( wp_create_nonce( 'pargas_frontend_nonce' ) ); ?>" />
					<!-- Anti-spam honeypot field -->
					<div style="display: none !important;" aria-hidden="true">
						<label for="pargas_hp_field">Leave empty</label>
						<input type="text" id="pargas_hp_field" name="pargas_hp" tabindex="-1" autocomplete="off" />
					</div>

					<div class="pargas-form-row">
						<div class="pargas-form-field">
							<label for="pargas_inq_name">
								<?php esc_html_e( 'Contact Person Name *', 'pargaspetroab' ); ?>
							</label>
							<input type="text" id="pargas_inq_name" name="name" required placeholder="<?php esc_attr_e( 'Eng. / Dr. / Name', 'pargaspetroab' ); ?>" />
						</div>

						<div class="pargas-form-field">
							<label for="pargas_inq_company">
								<?php esc_html_e( 'Company / Organization / Plant *', 'pargaspetroab' ); ?>
							</label>
							<input type="text" id="pargas_inq_company" name="company" required placeholder="<?php esc_attr_e( 'e.g. Petrochemical Co. / Municipal Plant', 'pargaspetroab' ); ?>" />
						</div>
					</div>

					<div class="pargas-form-row">
						<div class="pargas-form-field">
							<label for="pargas_inq_phone">
								<?php esc_html_e( 'Phone / Mobile *', 'pargaspetroab' ); ?>
							</label>
							<input type="tel" id="pargas_inq_phone" name="phone" required placeholder="<?php esc_attr_e( 'e.g. +98 912 000 0000', 'pargaspetroab' ); ?>" dir="ltr" />
						</div>

						<div class="pargas-form-field">
							<label for="pargas_inq_email">
								<?php esc_html_e( 'Business Email *', 'pargaspetroab' ); ?>
							</label>
							<input type="email" id="pargas_inq_email" name="email" required placeholder="<?php esc_attr_e( 'procurement@company.com', 'pargaspetroab' ); ?>" dir="ltr" />
						</div>
					</div>

					<div class="pargas-form-field">
						<label for="pargas_inq_product">
							<?php esc_html_e( 'Target Equipment or System *', 'pargaspetroab' ); ?>
						</label>
						<input type="text" id="pargas_inq_product" name="product" value="" placeholder="<?php esc_attr_e( 'e.g. DAF Unit 100 m³/hr, MBBR Package, RO Plant', 'pargaspetroab' ); ?>" />
					</div>

					<div class="pargas-form-field">
						<label for="pargas_inq_message">
							<?php esc_html_e( 'Project Specifications & Engineering Notes *', 'pargaspetroab' ); ?>
						</label>
						<textarea id="pargas_inq_message" name="message" rows="4" required placeholder="<?php esc_attr_e( 'Please describe inflow capacity, wastewater type (industrial, sanitary, chemical), effluent requirements, site location, etc.', 'pargaspetroab' ); ?>"></textarea>
					</div>

					<div class="pargas-modal-feedback" id="pargas-inquiry-feedback" style="display: none;" role="status"></div>

					<div class="pargas-modal-footer">
						<button type="button" class="pargas-btn pargas-btn-outline" id="pargas-modal-cancel-btn">
							<?php esc_html_e( 'Cancel', 'pargaspetroab' ); ?>
						</button>
						<button type="submit" class="pargas-btn pargas-btn-primary" id="pargas-inquiry-submit-btn">
							<?php esc_html_e( 'Transmit Inquiry', 'pargaspetroab' ); ?>
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
