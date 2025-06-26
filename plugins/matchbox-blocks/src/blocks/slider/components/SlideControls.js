import { Toolbar, ToolbarButton } from '@wordpress/components';
import { plus, chevronLeft, chevronRight } from '@wordpress/icons';

export default function SlideControls({
	onAdd,
	onPrev,
	onNext,
	showAdd = true,
	showNav = true,
}) {
	return (
		<Toolbar label="Slider Controls">
			{showAdd && onAdd && (
				<ToolbarButton
					icon={plus}
					label="Add Slide"
					onClick={onAdd}
				/>
			)}
			{showNav && (
				<>
					<ToolbarButton
						icon={chevronLeft}
						label="Previous Slide"
						onClick={onPrev}
					/>
					<ToolbarButton
						icon={chevronRight}
						label="Next Slide"
						onClick={onNext}
					/>
				</>
			)}
		</Toolbar>
	);
}
