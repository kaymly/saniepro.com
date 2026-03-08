if (typeof jQuery !== 'undefined') {
	jQuery(function($) {
		window.MwcCheckoutLocalPickupHandler = class MwcCheckoutLocalPickupHandler {
			constructor() {
				this.addEventListeners();
			}

			addEventListeners() {
				$(document.body).on('updated_checkout', () => this.onUpdatedCheckout());
				$(document.body).on('updated_cart_totals', () => this.onUpdatedCheckout());
			}

			onUpdatedCheckout() {
				this.updateReferences();

				const localPickupIsChecked = this.localPickupOptionRadioButton.is(':checked');

				this.locationsWrapper.toggle(localPickupIsChecked);
				this.locationsTitle.toggle(localPickupIsChecked);
			}

			updateReferences() {
				this.locationsWrapper = $('.mwc-commerce-local-pickup-locations-wrapper');
				this.locationsTitle = $('.mwc-commerce-local-pickup-locations-title');
				this.localPickupOptionRadioButton = $(this.locationsWrapper.parent().find('input[type=radio]')[0]);
			}
		};

		new MwcCheckoutLocalPickupHandler();
	});
}
