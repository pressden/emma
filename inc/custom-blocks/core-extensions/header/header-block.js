var el = wp.element.createElement;
var SelectControl = wp.components.SelectControl;

var updateBlock = 'core/heading';

function blockSettings( props, name ) {
  if( updateBlock == name ){
    props.attributes.fontSize = {
      type: 'string',
      default: '',
    };
  }
  return props;
}
wp.hooks.addFilter( 'blocks.registerBlockType', 'heading-block/add-font-size', blockSettings );

var blockEdit = wp.compose.createHigherOrderComponent( function( BlockEdit ) {
  return function( props ) {
    if( updateBlock != props.name ) {
      return el(
        wp.element.Fragment,
        {},
        el(
          BlockEdit,
          props
        )
      );
    }

    var fontSize = props.attributes.fontSize;

    function onChangeFontSize( newValue ) {
      props.setAttributes( { fontSize: newValue } );

      if( newValue != '' ) {
        props.setAttributes( { className: 'has-' + newValue + '-font-size' } );
      } else {
        props.setAttributes( { className: '' } );
      }
    }
    var fontSizeControl = el(
      SelectControl, {
        label: 'Font Size',
        value: fontSize,
        options: [
          {
            value: '',
            label: 'Default'
          },
          {
            value: 'small',
            label: 'Small'
          },
          {
            value: 'normal',
            label: 'Normal'
          },
          {
            value: 'medium',
            label: 'Medium'
          },
          {
            value: 'large',
            label: 'Large'
          },
          {
            value: 'huge',
            label: 'Huge'
          }
        ],
        onChange: onChangeFontSize
      }
    );

    return el(
      wp.element.Fragment,
      {},
      el(
        BlockEdit,
        props
      ),
      el(
        wp.editor.InspectorControls,
        {},
        el(
          wp.components.PanelBody, {
            title: 'Text Settings',
            initialOpen: true
          },
          fontSizeControl
        )
      )
    );
  };
}, 'blockEdit' );
wp.hooks.addFilter( 'editor.BlockEdit', 'core/heading', blockEdit );
