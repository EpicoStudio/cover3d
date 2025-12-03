/**
 * WordPress dependencies
 */
import { registerBlockType } from '@wordpress/blocks';
import { __ } from '@wordpress/i18n';

/**
 * Internal dependencies
 */
import Edit from './edit';
import metadata from './block.json';

/**
 * Styles
 */
import './style.scss';


/**
 * Block icon
 */
const icon = (
	<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
		<path d="m10.212 17.714-2.82 2.743h6.121l2.82-2.743h-6.121zM10.212 13.371l-2.82-2.742h6.121l2.82 2.742h-6.121zM6.81 13.606l2.82 2.743v-2.412l-2.82-2.743v2.412zM16.914 16.914v-2.743h-6.461v2.743h6.461zM10.453 3.543h6.461v2.743h-6.461V3.543zM7.392 0h6.121l2.82 2.743h-6.121L7.392 0zM6.81 2.977 9.63 5.72V3.309L6.81.566v2.411zM10.212 7.086h6.121l-2.82 2.743H7.392l2.82-2.743zM16.914 18.28l-2.819 2.743v2.411l2.819-2.743V18.28zM6.81 24h6.462v-2.743H6.81V24z" />
	</svg>
);

/**
 * Register block
 */
registerBlockType( metadata.name, {
	icon,
	edit: Edit,
	save: () => null,
} );
