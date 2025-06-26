import {
	Card,
	CardBody,
	Button,
} from '@wordpress/components';
import {
	plus,
	chevronLeft,
	chevronRight,
} from '@wordpress/icons';
import { useDispatch, useSelect } from '@wordpress/data';
import { store as blockEditorStore } from '@wordpress/block-editor';

export default function SlideHeader({
	clientId,
	title = 'Slider',
	activeIndex = 0,
	total = 1,
	onAdd,
	onPrev,
	onNext,
}) {
	const { selectBlock } = useDispatch(blockEditorStore);

	const isSelected = useSelect(
		(select) =>
			select(blockEditorStore).isBlockSelected(clientId),
		[clientId],
	);

	const handleClick = () => {
		if (!isSelected) {
			selectBlock(clientId);
		}
	};

	return (
		<Card
			onClick={handleClick}
			className="matchbox-slider-header__card"
			style={{ cursor: 'pointer' }}
		>
			<CardBody className="matchbox-slider-header">
				<div className="matchbox-slider-header__top">
					{onAdd && (
						<Button
							icon={plus}
							isPrimary
							onClick={(e) => {
								e.stopPropagation(); // Prevent triggering block selection
								onAdd();
							}}
							className="matchbox-slider-header__button add"
						>
							Add Slide
						</Button>
					)}
				</div>

				<p className="matchbox-slider-header__count">
					Editing slide {activeIndex + 1} of {total}
				</p>

				<div className="matchbox-slider-header__button-wrapper">
					<Button
						icon={chevronLeft}
						onClick={(e) => {
							e.stopPropagation();
							onPrev();
						}}
						variant="secondary"
						className="matchbox-slider-header__button prev"
					>
						Previous
					</Button>
					<Button
						icon={chevronRight}
						onClick={(e) => {
							e.stopPropagation();
							onNext();
						}}
						variant="secondary"
						className="matchbox-slider-header__button next"
					>
						Next
					</Button>
				</div>
			</CardBody>
		</Card>
	);
}
