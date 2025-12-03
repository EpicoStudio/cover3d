/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import {
	useBlockProps,
	InspectorControls,
	MediaUpload,
	MediaUploadCheck,
} from '@wordpress/block-editor';
import {
	PanelBody,
	TextControl,
	SelectControl,
	Button,
	BaseControl,
	ColorPicker,
	Popover,
	ToggleControl,
} from '@wordpress/components';
import { useState } from '@wordpress/element';
import ServerSideRender from '@wordpress/server-side-render';

/**
 * Internal dependencies
 */
import './editor.scss';

/**
 * Color picker control component
 */
const ColorPickerControl = ( { label, value, onChange } ) => {
	const [ isOpen, setIsOpen ] = useState( false );

	return (
		<BaseControl label={ label } __nextHasNoMarginBottom>
			<div className="cover3d-color-picker-wrapper">
				<button
					type="button"
					className="cover3d-color-picker-button"
					style={ { backgroundColor: value } }
					onClick={ () => setIsOpen( ! isOpen ) }
					aria-label={ `${ label }: ${ value }` }
					aria-expanded={ isOpen }
				/>
				{ isOpen && (
					<Popover
						placement="left-start"
						onClose={ () => setIsOpen( false ) }
					>
						<ColorPicker
							color={ value }
							onChange={ onChange }
							enableAlpha
						/>
					</Popover>
				) }
			</div>
		</BaseControl>
	);
};

/**
 * Link control component
 */
const LinkControl = ( { value, onChange } ) => {
	const { url = '', opensInNewTab = false } = value || {};

	return (
		<>
			<TextControl
				label={ __( 'Book cover link', 'cover3d' ) }
				help={ __(
					'Add an optional link to the book (to download, buy, or whatever). Adding a link will trigger the hover animation to show the back cover.',
					'cover3d'
				) }
				value={ url }
				onChange={ ( newUrl ) =>
					onChange( { ...value, url: newUrl || '' } )
				}
				type="url"
				__next40pxDefaultSize
				__nextHasNoMarginBottom
			/>
			<ToggleControl
				label={ __( 'Open in new tab', 'cover3d' ) }
				checked={ opensInNewTab }
				onChange={ ( newValue ) =>
					onChange( { ...value, opensInNewTab: newValue } )
				}
				__nextHasNoMarginBottom
			/>
		</>
	);
};

/**
 * Edit component
 */
export default function Edit( { attributes, setAttributes } ) {
	const {
		bookCoverLink,
		bookSize,
		backCoverText,
		backCoverIconType,
		backCoverColor,
		backCoverBkgColor,
		bookCoverImageId,
		bookCoverImageAlt,
	} = attributes;

	const blockProps = useBlockProps( { className: 'book-cover' } );

	const onSelectImage = ( media ) => {
		setAttributes( {
			bookCoverImageId: media.id,
			bookCoverImageAlt: media.alt || '',
		} );
	};

	const onRemoveImage = () => {
		setAttributes( {
			bookCoverImageId: 0,
			bookCoverImageAlt: '',
		} );
	};

	return (
		<>
			<InspectorControls>
				<PanelBody
					title={ __( 'Cover image', 'cover3d' ) }
					initialOpen={ true }
				>
					<MediaUploadCheck>
						<MediaUpload
							onSelect={ onSelectImage }
							allowedTypes={ [ 'image' ] }
							value={ bookCoverImageId }
							render={ ( { open } ) => (
								<div className="cover3d-image-control">
									{ bookCoverImageId ? (
										<>
											<Button
												onClick={ open }
												variant="secondary"
												className="cover3d-image-button"
											>
												{ __(
													'Replace image',
													'cover3d'
												) }
											</Button>
											<Button
												onClick={ onRemoveImage }
												variant="tertiary"
												isDestructive
											>
												{ __(
													'Remove image',
													'cover3d'
												) }
											</Button>
										</>
									) : (
										<Button onClick={ open } variant="secondary">
											{ __( 'Select cover image', 'cover3d' ) }
										</Button>
									) }
								</div>
							) }
						/>
					</MediaUploadCheck>
					{ bookCoverImageId > 0 && (
						<TextControl
							label={ __( 'Alt text', 'cover3d' ) }
							value={ bookCoverImageAlt }
							onChange={ ( value ) =>
								setAttributes( { bookCoverImageAlt: value } )
							}
							help={ __(
								'Describe the book cover image for accessibility.',
								'cover3d'
							) }
							__next40pxDefaultSize
							__nextHasNoMarginBottom
						/>
					) }
				</PanelBody>

				<PanelBody
					title={ __( 'Block settings', 'cover3d' ) }
					initialOpen={ true }
				>
					<LinkControl
						value={ bookCoverLink }
						onChange={ ( value ) =>
							setAttributes( { bookCoverLink: value } )
						}
					/>

					<SelectControl
						label={ __( 'Book size', 'cover3d' ) }
						value={ bookSize }
						onChange={ ( value ) =>
							setAttributes( { bookSize: value } )
						}
						options={ [
							{ value: 'big', label: __( 'Big', 'cover3d' ) },
							{
								value: 'medium',
								label: __( 'Medium', 'cover3d' ),
							},
							{ value: 'small', label: __( 'Small', 'cover3d' ) },
						] }
						__next40pxDefaultSize
						__nextHasNoMarginBottom
					/>

					<TextControl
						label={ __( 'Back cover text', 'cover3d' ) }
						value={ backCoverText }
						onChange={ ( value ) =>
							setAttributes( { backCoverText: value } )
						}
						help={ __(
							'Enter the short text that will appear on the back cover on hover (only displayed with linked covers and for large and medium sizes).',
							'cover3d'
						) }
						__next40pxDefaultSize
						__nextHasNoMarginBottom
					/>

					<SelectControl
						label={ __( 'Back cover icon', 'cover3d' ) }
						value={ backCoverIconType }
						onChange={ ( value ) =>
							setAttributes( { backCoverIconType: value } )
						}
						options={ [
							{
								value: 'download',
								label: __( 'Download', 'cover3d' ),
							},
							{ value: 'buy', label: __( 'Buy', 'cover3d' ) },
						] }
						__next40pxDefaultSize
						__nextHasNoMarginBottom
					/>

					<ColorPickerControl
						label={ __( 'Back cover color', 'cover3d' ) }
						value={ backCoverColor }
						onChange={ ( value ) =>
							setAttributes( { backCoverColor: value } )
						}
					/>

					<ColorPickerControl
						label={ __( 'Back cover background', 'cover3d' ) }
						value={ backCoverBkgColor }
						onChange={ ( value ) =>
							setAttributes( { backCoverBkgColor: value } )
						}
					/>
				</PanelBody>
			</InspectorControls>

			<div { ...blockProps }>
				<ServerSideRender
					block="cover3d/book"
					attributes={ attributes }
					httpMethod="POST"
				/>
			</div>
		</>
	);
}
