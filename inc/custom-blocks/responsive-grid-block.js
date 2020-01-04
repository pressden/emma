/* This section of the code registers a new block, sets an icon and a category, and indicates what type of fields it'll include. */

(function( editor, element ) {

  var el = element.createElement;
  var registerBlockType = wp.blocks.registerBlockType;
	var Fragment = wp.element.Fragment;
  var InnerBlocks = wp.blockEditor.InnerBlocks;
	var InspectorControls = wp.blockEditor.InspectorControls;
	var PanelBody = wp.components.PanelBody;
	var PanelRow = wp.components.PanelRow;
  var SelectControl = wp.components.SelectControl;

  registerBlockType( 'custom/responsive-grid', {
    title: 'Responsive Grid',
    description: 'A block to help you easily make a responsive grid with varying column sizes available',
    icon: 'grid-view',
    category: 'layout',
		keywords: ['custom grid responsive'],

		attributes: {
			minColumnWidth: {
				type: 'string',
			},
		},

    supports: {
      align: [ 'wide', 'full' ],
      anchor: true,
      html: false,
    },

    edit: function( props ) {
			var minColumnWidth = "md";
			if( props.attributes.minColumnWidth ) {
				minColumnWidth = props.attributes.minColumnWidth;
			}

      function onChangeMinColumnWidth( newValue ) {
				props.setAttributes( { minColumnWidth: newValue } );
			}

      return (
          el(
						Fragment,
						null,
						el(
							InspectorControls,
							null,
							el(
                PanelBody,
                {},
								el(
									SelectControl,
									{
										label: 'Minimum Column Width',
										value: minColumnWidth,
										options: [
											{
												value: 'xs',
												label: 'Extra Small'
											},
											{
												value: 'sm',
												label: 'Small'
											},
											{
												value: 'md',
												label: 'Medium'
											},
											{
												value: 'lg',
												label: 'Large'
											},
											{
												value: 'xl',
												label: 'Extra Large'
											}
										],
										onChange: onChangeMinColumnWidth
									}
								),
							),
						),
						el('div', { className: props.className + " " + props.attributes.minColumnWidth },
						el( InnerBlocks ),
					),
        )
      );
    },

    save: function( props ) {
        return (
            el('div', { className: props.className + props.attributes.minColumnWidth },
                el('div', { className: 'responsive-grid__inner-container' },
                    el( InnerBlocks.Content, null )
                )
            )
					);
				}
		});
	}
)(
    window.wp.editor,
    window.wp.element
);
