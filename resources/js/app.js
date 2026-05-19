import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

const setupConfirmModal = () => {
	const modal = document.getElementById('confirm-modal');
	if (!modal) {
		return;
	}

	const titleEl = modal.querySelector('[data-confirm-title]');
	const messageEl = modal.querySelector('[data-confirm-message]');
	const confirmBtn = modal.querySelector('[data-confirm-ok]');
	const cancelBtn = modal.querySelector('[data-confirm-cancel]');
	const backdrop = modal.querySelector('[data-confirm-backdrop]');

	let pendingForm = null;

	const closeModal = () => {
		modal.classList.remove('is-open');
		modal.setAttribute('aria-hidden', 'true');
		pendingForm = null;
	};

	const openModal = (form) => {
		pendingForm = form;

		const title = form.dataset.confirmTitle || 'Please Confirm';
		const message = form.dataset.confirmMessage || 'Are you sure you want to continue?';

		if (titleEl) {
			titleEl.textContent = title;
		}
		if (messageEl) {
			messageEl.textContent = message;
		}

		modal.classList.add('is-open');
		modal.setAttribute('aria-hidden', 'false');
	};

	document.addEventListener('submit', (event) => {
		const form = event.target;
		if (!(form instanceof HTMLFormElement)) {
			return;
		}

		if (!form.matches('[data-confirm-submit]')) {
			return;
		}

		if (form.dataset.confirmed === '1') {
			form.dataset.confirmed = '0';
			return;
		}

		event.preventDefault();
		openModal(form);
	});

	confirmBtn?.addEventListener('click', () => {
		if (!pendingForm) {
			return;
		}

		const formToSubmit = pendingForm;
		formToSubmit.dataset.confirmed = '1';
		closeModal();
		HTMLFormElement.prototype.submit.call(formToSubmit);
	});

	cancelBtn?.addEventListener('click', closeModal);
	backdrop?.addEventListener('click', closeModal);

	document.addEventListener('keydown', (event) => {
		if (event.key === 'Escape' && modal.classList.contains('is-open')) {
			closeModal();
		}
	});
};

setupConfirmModal();