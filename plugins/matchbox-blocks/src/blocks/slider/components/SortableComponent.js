// src/SortableComponent.js
import React from 'react';
import { DndContext, useSensor, useSensors, PointerSensor } from '@dnd-kit/core';
import { SortableContext, arrayMove, verticalListSortingStrategy } from '@dnd-kit/sortable';
import SortableItem from './SortableItem';

export default function SortableComponent({ items, onChange }) {
	const sensors = useSensors(
		useSensor(PointerSensor, { activationConstraint: { distance: 10 } })
	);

	const handleDragEnd = (event) => {
		const { active, over } = event;
		if (active && over && active.id !== over.id) {
			const oldIndex = items.findIndex((item) => item.id === active.id);
			const newIndex = items.findIndex((item) => item.id === over.id);
			onChange(arrayMove(items, oldIndex, newIndex));
		}
	};

	return (
		<DndContext sensors={sensors} onDragEnd={handleDragEnd}>
			<SortableContext items={items} strategy={verticalListSortingStrategy}>
				{items.map((item) => (
					<SortableItem key={item.id} id={item.id} label={item.label} />
				))}
			</SortableContext>
		</DndContext>
	);
}
