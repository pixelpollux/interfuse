// src/SortableItem.js
import React from 'react';
import { useSortable } from '@dnd-kit/sortable';
import { CSS } from '@dnd-kit/utilities';
import { Dashicon } from '@wordpress/components';

export default function SortableItem({ id, label }) {
	const { attributes, listeners, setNodeRef, transform, transition } =
		useSortable({ id });
	const style = {
		transform: CSS.Transform.toString(transform),
		transition,
		padding: '8px',
		border: '1px solid #ccc',
		marginBottom: '4px',
		background: '#fff',
		display: 'flex',
		alignItems: 'center',
		cursor: 'grab',
	};

	return (
		<div ref={setNodeRef} style={style} {...attributes} {...listeners}>
			<span>{label}</span>
			<Dashicon icon="move" style={{ marginLeft: 'auto' }} />
		</div>
	);
}
