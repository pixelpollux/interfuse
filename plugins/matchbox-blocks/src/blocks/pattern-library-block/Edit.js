/**
 * External dependencies.
 */
import { useBlockProps } from '@wordpress/block-editor';
import { __ } from '@wordpress/i18n';

/**
 * Internal dependencies.
 */
import Dashboard from './components/Dashboard';
import './editor.scss';

export default function Edit() {
	return (
		<div {...useBlockProps()}>
			<Dashboard />
			<h1>
				{__(
					'Hello from the Matchbox Pattern Library',
					'matchbox',
				)}
			</h1>
		</div>
	);
}
