/**
 * Register the Responsive Grid block
 */

(function( editor, element ) {

  var el = element.createElement;
  var registerBlockType = wp.blocks.registerBlockType;
	var Fragment = wp.element.Fragment;
  var InnerBlocks = wp.blockEditor.InnerBlocks;
	var InspectorControls = wp.blockEditor.InspectorControls;
	var PanelBody = wp.components.PanelBody;
  var SelectControl = wp.components.SelectControl;
  var ToggleControl = wp.components.ToggleControl;
  var RadioControl = wp.components.RadioControl;
  var TextControl = wp.components.TextControl;

  registerBlockType( 'emma/dialog', {
    title: 'Dialog',
    description: 'A block to create a popup modal/dialog box',
    icon: 'admin-comments',
    category: 'layout',
    keywords: ['emma modal dialog popup'],

    supports: {
			align: ['wide', 'full'],
      anchor: true,
      html: false,
		},

		attributes: {
      openLinkAddress: {
        type: 'string',
        default: '',
      },
      openAutomatically: {
        type: 'string',
        default: 'false'
      },
      openDelay: {
        type: 'number',
        default: '5',
      },
      openLimit: {
        type: 'integer',
        default: '0',
      },
      openLimitID: {
        type: 'string',
        default: null,
      }
		},

    edit: function( props ) {
      if( props.attributes.openLimitID === null ) {
        props.setAttributes( { openLimitID: Math.random().toString(36).substring(2, 5) + Math.random().toString(36).substring(2, 5) } );
      }

			function onChangeOpenLinkAddress( newValue ) {
				props.setAttributes( { openLinkAddress: newValue } );
      }
      var openLinkAddressControl = el(
        TextControl,
        {
          label: "Open Link",
          value: props.attributes.openLinkAddress,
          help: 'Enter the desired address of buttons/links that should open this dialog box when clicked. When making a button/link, point the link to the value entered here with a "#" in front of it (e.g. "#dialog-link").',
          onChange: onChangeOpenLinkAddress,
        }
      );

      function onChangeOpenAutomatically( newValue ) {
        props.setAttributes( { openAutomatically: newValue } );
      }
      var openAutomaticallyControl =  el(
        RadioControl,
        {
          label: 'Open Automatically',
          help: 'Should this dialog box open automatically? If so, how?',
          selected: props.attributes.openAutomatically,
          options: [
            {
              value: 'false',
              label: 'Do Not Open Automatically',
            },
            {
              value: 'delay',
              label: 'Open Automatically After Delay',
            },
            {
              value: 'scroll',
              label: 'Open Automatically After Scrolling a Certain Distance',
            }
          ],
          onChange: onChangeOpenAutomatically,
        }
      );

			function onChangeOpenDelay( newValue ) {
				props.setAttributes( { openDelay: newValue } );
      }
      var openDelayControl = '';
      if( props.attributes.openAutomatically === 'delay' ) {
        var openDelayControl = el(
          TextControl,
          {
            label: "Open Delay",
            value: props.attributes.openDelay,
            help: 'Define how many seconds after page load the dialog box should appear.',
            type: 'number',
            min: 0,
            onChange: onChangeOpenDelay,
          }
        );
      }

			function onChangeOpenLimit( newValue ) {
				props.setAttributes( { openLimit: parseInt( newValue ) } );
      }
      var openLimitControl = el(
        TextControl,
        {
          label: "Open Limit",
          value: props.attributes.openLimit,
          help: 'Define how many times this dialog box is allowed to appear. Use 0 for no limit.',
          type: 'number',
          min: 0,
          onChange: onChangeOpenLimit,
        }
      );

      function onChangeOpenLimitID( newValue ) {
				props.setAttributes( { openLimitID: newValue } );
      }
      var openLimitIDControl = el(
        TextControl,
        {
          label: "Open Limit ID",
          value: props.attributes.openLimitID,
          help: 'The ID that will be used to track how many times this dialog box will appear. Defaults to a random string, but can be customized so that multiple dialog boxes will count toward the same limit.',
          onChange: onChangeOpenLimitID,
        }
      );

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
              openAutomaticallyControl,
              openLinkAddressControl,
              openDelayControl,
              openLimitControl,
              openLimitIDControl
            ),
          ),
          el(
            'div', {},
            el( InnerBlocks ),
          ),
        )
      );
    },

    save: function( props ) {
      function returnZeroIfEmpty( val ) {
        if( val === '' ) {
          return 0;
        } else {
          return val;
        }
      }

      var options = {
        'openLinkAddress': props.attributes.openLinkAddress.replace(/^#+/, ''),
        'openLimit': returnZeroIfEmpty( props.attributes.openLimit ),
      };

      if( props.attributes.openAutomatically === 'delay' ) {
        options.openDelay = returnZeroIfEmpty( props.attributes.openDelay );
      }
      if( options.openLimit > 0 ) {
        options.openLimitID = props.attributes.openLimitID;
      }

      return (
        el('dialog', { 'data-options': JSON.stringify( options ) },
          el( InnerBlocks.Content, null )
        )
      );
    }
	} );
} ) (
  window.wp.editor,
  window.wp.element
);
