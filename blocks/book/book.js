( function ( blocks, element, blockEditor ) {
    const el = element.createElement,
        registerBlockType = blocks.registerBlockType,
        ServerSideRender = PgServerSideRender,
        InspectorControls = blockEditor.InspectorControls,
        useBlockProps = blockEditor.useBlockProps;
        
    const {__} = wp.i18n;
    const {ColorPicker, TextControl, ToggleControl, SelectControl, Panel, PanelBody, Disabled, TextareaControl, BaseControl} = wp.components;
    const {useSelect} = wp.data;
    const {RawHTML, Fragment} = element;
   
    const {InnerBlocks, URLInputButton, RichText} = wp.blockEditor;
    const useInnerBlocksProps = blockEditor.useInnerBlocksProps || blockEditor.__experimentalUseInnerBlocksProps;
    
    const propOrDefault = function(val, prop, field) {
        if(block.attributes[prop] && (val === null || val === '')) {
            return field ? block.attributes[prop].default[field] : block.attributes[prop].default;
        }
        return val;
    }
    
    const block = registerBlockType( 'cover3d/book', {
        apiVersion: 3,
        title: '3D Book Cover',
        description: __( 'A 3D book cover animated on hover.', 'cover3d' ),
        icon: el('svg', { viewBox: '0 0 24 24', xmlns: 'http://www.w3.org/2000/svg', style: { strokeLinecap: 'round',strokeLinejoin: 'round',strokeMiterlimit: '1.5',fill: 'none',stroke: '#000',strokeWidth: '1px' } }, [el('path', { d: 'M10.358 3.792v3.283h6.567V3.792h-6.567zM7.075 10.358l3.283-3.283h6.567l-3.283 3.283H7.075zM7.075.509l3.283 3.283h6.567L13.642.509H7.075z' }), el('path', { d: 'M10.358 7.075 7.075 3.792V.509l3.283 3.283v3.283zM10.358 13.642v3.283h6.567v-3.283h-6.567z' }), el('path', { d: 'm7.075 20.208 3.283-3.283h6.567l-3.283 3.283H7.075zM7.075 10.358l3.283 3.284h6.567l-3.283-3.284H7.075z' }), el('path', { d: 'm10.358 16.925-3.283-3.283v-3.284l3.283 3.284v3.283zM13.642 23.491v-3.283l3.283-3.283v3.283l-3.283 3.283zM7.075 20.208v3.283h6.567v-3.283H7.075z' })]),
        category: 'media',
        keywords: [ __('book', 'cover3d'), __('cover', 'cover3d'), __('3D', 'cover3d'), __('animated', 'cover3d'), __('hover', 'cover3d'), __('lead magnet', 'cover3d') ],
        supports: {color: {background: false,text: false,gradients: false,link: false,},typography: {fontSize: false,},anchor: false,align: false,},
        attributes: {
            book_cover_link: {
                type: 'object',
                default: {post_id: 0, url: '', title: '', 'post_type': null},
            },
            book_size: {
                type: 'string',
                default: 'big',
            },
            back_cover_text: {
                type: 'string',
                default: __( 'Download', 'cover3d' ),
            },
            back_cover_icon_type: {
                type: 'string',
                default: 'download',
            },
            back_cover_color: {
                type: 'string',
                default: '#ffffff',
            },
            back_cover_bkg_color: {
                type: 'string',
                default: '#0049ff',
            },
            book_cover_img: {
                type: 'object',
                default: {id: 0, url: (pg_project_data_cover3d ? pg_project_data_cover3d.url : '') + 'assets/cover.png', size: '', svg: '', alt: null},
            }
        },
        example: { attributes: { book_cover_link: {post_id: 0, url: '#void', title: '', 'post_type': null}, book_size: 'big', back_cover_text: __( 'Buy', 'cover3d' ), back_cover_icon_type: 'download', back_cover_color: '', back_cover_bkg_color: '', book_cover_img: {id: 0, url: (pg_project_data_cover3d ? pg_project_data_cover3d.url : '') + 'assets/cover.png', size: '', svg: '', alt: null} } },

        edit: function (props) {
            const blockProps = useBlockProps({ className: 'book-cover' });
            const setAttributes = props.setAttributes;

            props.book_cover_img = useSelect(function (select) {
                return {
                    book_cover_img: props.attributes.book_cover_img.id ? select('core').getMedia(props.attributes.book_cover_img.id) : undefined
                };
            }, [props.attributes.book_cover_img]).book_cover_img;

            const innerBlocksProps = null;

            const children = React.Children.toArray(props.children);

            const childrenWithKeys = children.map((child, index) => {
                return React.cloneElement(child, { key: index });
            });

            return React.createElement(
                React.Fragment,
                null,
                React.createElement(ServerSideRender, {
                    block: 'cover3d/book',
                    httpMethod: 'POST',
                    attributes: props.attributes,
                    innerBlocksProps: innerBlocksProps,
                    blockProps: blockProps
                }),
                childrenWithKeys,
                React.createElement(
                    InspectorControls,
                    null,
                    [
                        pgMediaImageControl('book_cover_img', setAttributes, props, 'medium', false, __('Book cover image', 'cover3d'), __('Add your book cover image.', 'cover3d')),
                        React.createElement(
                            Panel,
                            null,
                            React.createElement(
                                PanelBody,
                                {
                                    title: __('Block properties', 'cover3d')
                                },
                                [
                                    pgUrlControl('book_cover_link', setAttributes, props, __('Book cover link', 'cover3d'), __('Add an optional link to the book (to download or buy). Adding a link will trigger the hover animation to show the back cover.', 'cover3d'), null),
                                    React.createElement(SelectControl, {
                                        value: props.attributes.book_size,
                                        label: __('Book size', 'cover3d'),
                                        onChange: function (val) { setAttributes({ book_size: val }) },
                                        options: [
                                            { value: '', label: '-' },
                                            { value: 'big', label: __('Big', 'cover3d') },
                                            { value: 'medium', label: __('Medium', 'cover3d') },
                                            { value: 'small', label: __('Small', 'cover3d') }
                                        ]
                                    }),
                                    React.createElement(TextControl, {
                                        value: props.attributes.back_cover_text,
                                        help: __('Enter the short text that will appear on the back cover on hover (only displayed with linked covers and for large and medium sizes).', 'cover3d'),
                                        label: __('Back cover text', 'cover3d'),
                                        onChange: function (val) { setAttributes({ back_cover_text: val }) },
                                        type: 'text'
                                    }),
                                    React.createElement(SelectControl, {
                                        value: props.attributes.back_cover_icon_type,
                                        label: __('Back cover icon', 'cover3d'),
                                        onChange: function (val) { setAttributes({ back_cover_icon_type: val }) },
                                        options: [
                                            { value: '', label: '-' },
                                            { value: 'download', label: __('Download', 'cover3d') },
                                            { value: 'buy', label: __('Buy', 'cover3d') }
                                        ]
                                    }),
                                    pgColorControl('back_cover_color', setAttributes, props, __('Back cover color', 'cover3d'), ''),
                                    pgColorControl('back_cover_bkg_color', setAttributes, props, __('Back cover background', 'cover3d'), ''),
                                ]                            )
                        )
                    ]
                )
            );
        },

        save: function(props) {
            return null;
        }                        

    } );
} )(
    window.wp.blocks,
    window.wp.element,
    window.wp.blockEditor
);                        
