var el = wp.element.createElement;
var SelectControl = wp.components.SelectControl;
var classNames = wp.blockEditor.classNames;

var updateBlock = 'core/heading';

function blockProps( props, name ) {
  if( updateBlock == name ){
    props.attributes.fontSize = {
      type: 'string',
      default: '',
    };
  }
  return props;
}
wp.hooks.addFilter( 'blocks.registerBlockType', 'heading-block/add-font-size', blockProps );

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
      //alert( Object.keys( props.attributes ) );
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

    var returnBlock;
    if( fontSize != '' ) {
      returnBlock = el( 'div', {
        className: 'heading-reset has-' + fontSize + '-font-size',
      },
        el(
          BlockEdit,
          props
        ),
      );
    } else {
      returnBlock = el(
        BlockEdit,
        props
      );
    }

    return el(
      wp.element.Fragment,
      {},
      returnBlock,
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

function blockSave( props, blockType, attributes ) {
  if( updateBlock != blockType.name ) {
    return props;
  }
  if( attributes.fontSize && attributes.fontSize != '' ) {
    var newClass = "has-" + attributes.fontSize + "-font-size";
    if( props.className ) {
      props.className += " " + newClass;
    } else {
      props.className = newClass;
    }
  }
  return props;
}
wp.hooks.addFilter( 'blocks.getSaveContent.extraProps',	'editorskit/applyExtraClass',	blockSave );
