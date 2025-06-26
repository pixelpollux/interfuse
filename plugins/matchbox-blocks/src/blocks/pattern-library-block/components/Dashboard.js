import { useState } from '@wordpress/element';
import { Modal } from '@wordpress/components';
import { __ } from '@wordpress/i18n';

function Dashboard() {
	const [isModalOpen, setIsModalOpen] = useState(() => {
		const isOpen = localStorage.getItem('matchbox-pattern-modal');

		if ('yes' === isOpen) {
			return true;
		} else if ('no' === isOpen) {
			return false;
		} else if (null === isOpen) {
			localStorage.setItem('matchbox-pattern-modal', 'yes');
			return true;
		}
	});

	const openModal = () => {
		setIsModalOpen(true);
	};

	const closeModal = () => {
		setIsModalOpen(false);
	};

	return (
		<>
			{isModalOpen ? (
				<Modal
					className="matchbox-pattern-modal"
					title="Matchbox Pattern Library"
					onRequestClose={closeModal}
				>
					<div className="matchbox-modal-container">
						{__(
							'The Matchbox Patterns will appear here.',
							'matchbox',
						)}
					</div>
				</Modal>
			) : null}
		</>
	);
}

export default Dashboard;
