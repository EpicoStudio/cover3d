
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
        apiVersion: 2,
        title: '3D Book Cover',
        description: 'A 3D book cover animated on hover.',
        icon: el('svg', { xmlns: 'http://www.w3.org/2000/svg', viewBox: '0 0 24 24' }, el('path', { d: 'M21 4H7C5.89543 4 5 4.89543 5 6C5 7.10457 5.89543 8 7 8H21V21C21 21.5523 20.5523 22 20 22H7C4.79086 22 3 20.2091 3 18V6C3 3.79086 4.79086 2 7 2H20C20.5523 2 21 2.44772 21 3V4ZM5 18C5 19.1046 5.89543 20 7 20H19V10H7C6.27143 10 5.58835 9.80521 5 9.46487V18ZM20 7H7C6.44772 7 6 6.55228 6 6C6 5.44772 6.44772 5 7 5H20V7Z' })),
        category: 'media',
        keywords: [ __('book'), __('cover'), __('3D'), __('animated'), __('hover'), __('lead magnet') ],
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
                default: 'Download',
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
        example: { attributes: { book_cover_link: {post_id: 0, url: '#void', title: '', 'post_type': null}, book_size: 'big', back_cover_text: 'Comprar', back_cover_icon_type: 'download', back_cover_color: '', back_cover_bkg_color: '', book_cover_img: {id: 0, url: (pg_project_data_cover3d ? pg_project_data_cover3d.url : '') + 'assets/cover.png', size: '', svg: '', alt: null} } },
        edit: function ( props ) {
            const blockProps = useBlockProps({ className: 'book-cover' });
            const setAttributes = props.setAttributes; 
            
            props.book_cover_img = useSelect(function( select ) {
                return {
                    book_cover_img: props.attributes.book_cover_img.id ? select('core').getMedia(props.attributes.book_cover_img.id) : undefined
                };
            }, [props.attributes.book_cover_img] ).book_cover_img;
            
            
            const innerBlocksProps = null;
            
            
            return el(Fragment, {}, [
                
                        el( ServerSideRender, {
                            block: 'cover3d/book',
                            httpMethod: 'POST',
                            attributes: props.attributes,
                            innerBlocksProps: innerBlocksProps,
                            blockProps: blockProps
                        } ),                        
                
                    el( InspectorControls, {},
                        [
                            
                        pgMediaImageControl('book_cover_img', setAttributes, props, 'medium', false, 'Book cover image', 'Add your book cover image.' ),
                                        
                            el(Panel, {},
                                el(PanelBody, {
                                    title: __('Block properties')
                                }, [
                                    
                                    pgUrlControl('book_cover_link', setAttributes, props, 'Book cover link', 'Add an optional link to the book (to download, buy, or whatever). Adding a link will trigger the hover animation to show the back cover.', null ),
                                    el(SelectControl, {
                                        value: props.attributes.book_size,
                                        label: __( 'Book size' ),
                                        onChange: function(val) { setAttributes({book_size: val}) },
                                        options: [
                                            { value: '', label: '-' },
                                            { value: 'big', label: 'Big' },
                                            { value: 'medium', label: 'Medium' },
                                            { value: 'small', label: 'Small' }
                                        ]
                                    }),
                                    el(TextControl, {
                                        value: props.attributes.back_cover_text,
                                        help: __( 'Enter the short text that will appear on the back cover on hover (only displayed with linked covers and for large and medium sizes).' ),
                                        label: __( 'Back cover text' ),
                                        onChange: function(val) { setAttributes({back_cover_text: val}) },
                                        type: 'text'
                                    }),
                                    el(SelectControl, {
                                        value: props.attributes.back_cover_icon_type,
                                        label: __( 'Back cover icon' ),
                                        onChange: function(val) { setAttributes({back_cover_icon_type: val}) },
                                        options: [
                                            { value: '', label: '-' },
                                            { value: 'download', label: 'Download' },
                                            { value: 'buy', label: 'Buy' }
                                        ]
                                    }),
                                    pgColorControl('back_cover_color', setAttributes, props, 'Back cover color', ''),

                                    pgColorControl('back_cover_bkg_color', setAttributes, props, 'Back cover background', ''),
    
                                ])
                            )
                        ]
                    )                            

            ]);
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
