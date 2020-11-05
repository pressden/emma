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
  var PanelColorSettings = wp.blockEditor.PanelColorSettings;
  var getColorClassName = wp.blockEditor.getColorClassName;
  var withColors = wp.blockEditor.withColors;

  registerBlockType( 'emma/dialog', {
    title: 'Dialog',
    description: 'A block to create a popup modal/dialog box',
    icon: 'admin-comments',
    category: 'widgets',
    keywords: ['emma modal dialog popup'],

    supports: {
			align: ['wide', 'full'],
      anchor: true,
      html: false,
		},

		attributes: {
      color: {
        type: 'string',
      },
      backgroundColor: {
        type: 'string',
      },
      openOn: {
        type: 'string',
        default: 'both',
      },
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
      },
      openLimitExpiration: {
        type: 'integer',
        default: '0',
      },
      openUsers: {
        type: 'string',
        default: 'both',
      },
		},

    edit: withColors( 'color', 'backgroundColor' )( function( props ) {
      if( props.attributes.openLimitID === null ) {
        props.setAttributes( { openLimitID: Math.random().toString(36).substring(2, 5) + Math.random().toString(36).substring(2, 5) } );
      }

      var colorControls = el(
        PanelColorSettings, {
          title: 'Color settings',
          disableCustomColors: true,
          initialOpen: false,
          colorSettings: [
            {
              label: 'Text Color',
              value: props.color.color,
              onChange: props.setColor,
            },
            {
              label: 'Background Color',
              value: props.backgroundColor.color,
              onChange: props.setBackgroundColor,
            },
          ]
        }
      )

      function onChangeOpenOn( newValue ) {
        props.setAttributes( { openOn: newValue } );
      }
      var openOnControl =  el(
        RadioControl,
        {
          label: 'Open On',
          selected: props.attributes.openOn,
          options: [
            {
              value: 'desktop',
              label: 'Desktop Only',
            },
            {
              value: 'mobile',
              label: 'Mobile Only',
            },
            {
              value: 'both',
              label: 'Both',
            },
          ],
          onChange: onChangeOpenOn,
        }
      );

			function onChangeOpenLinkAddress( newValue ) {
        if( newValue !== '' && ! newValue.startsWith( '#' ) ) {
          newValue = '#' + newValue;
        }
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
              value: 'exit',
              label: 'Open Automatically on Exit Intent',
            },
            // {
            //   value: 'scroll',
            //   label: 'Open Automatically After Scrolling a Certain Distance',
            // }
          ],
          onChange: onChangeOpenAutomatically,
        }
      );

			function onChangeOpenDelay( newValue ) {
				props.setAttributes( { openDelay: newValue } );
      }
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

      function onChangeOpenLimitExpiration( newValue ) {
				props.setAttributes( { openLimitExpiration: parseInt( newValue ) } );
      }
      var openLimitExpirationControl = el(
        TextControl,
        {
          label: "Open Limit Expiration",
          value: props.attributes.openLimitExpiration,
          help: 'Define how many days before the open limit counter resets and the dialog is shown again. Use 0 for no limit.',
          type: 'number',
          min: 0,
          onChange: onChangeOpenLimitExpiration,
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

      function onChangeOpenUsers( newValue ) {
				props.setAttributes( { openUsers: newValue } );
      }
      var openUsersControl = el(
        RadioControl,
        {
          label: 'Show dialog for',
          selected: props.attributes.openUsers,
          options: [
            {
              value: 'logged-in',
              label: 'Logged-In Users'
            },
            {
              value: 'logged-out',
              label: 'Logged-Out Users'
            },
            {
              value: 'both',
              label: 'Both',
            },
          ],
          onChange: onChangeOpenUsers,
        }
      );

      var automaticOpenControls = '';
      if( props.attributes.openAutomatically !== 'false' ) {
        var automaticOpenControls = el(
          PanelBody, {
            title: 'Automatic Open Options',
            initialOpen: true,
          },
            openDelayControl,
            openLimitControl,
            openLimitExpirationControl,
            openLimitIDControl,
            openUsersControl,
        );
      }

      colorClasses = '';
      if( props.color.class ) {
        colorClasses += ' ' + props.color.class;
      }
      if( props.backgroundColor.class ) {
        colorClasses += ' ' + props.backgroundColor.class + ' has-background';
      }

      return (
        el(
          Fragment,
          null,
          el(
            InspectorControls,
            null,
            colorControls,
            el(
              PanelBody,
              {
                title: 'Open Options',
                initialOpen: true,
              },
              openOnControl,
              openLinkAddressControl,
              openAutomaticallyControl,
            ),
            automaticOpenControls,
          ),
          el(
            'div', {
              className: 'wp-block-emma-dialog' + colorClasses,
            },
            el( InnerBlocks, {
              renderAppender: InnerBlocks.ButtonBlockAppender,
            } ),
          ),
        )
      );
    } ),

    save: function( props ) {
      function returnZeroIfEmpty( val ) {
        if( val === '' ) {
          return 0;
        } else {
          return val;
        }
      }

      var a = props.attributes;

      var classes = '';
      if( a.color ) {
        classes += ' ' + getColorClassName( 'color', a.color );
      }
      if( a.backgroundColor ) {
        classes += ' ' + getColorClassName( 'background-color', a.backgroundColor );
      }

      var options = {
        'openOn': a.openOn,
        'openLinkAddress': a.openLinkAddress,
      };

      if( a.openAutomatically !== 'false' ) {
        options.openAutomatically = a.openAutomatically;
        options.openUsers = a.openUsers;
        options.openLimitID = a.openLimitID;

        if( a.openAutomatically === 'delay' ) {
          options.openDelay = returnZeroIfEmpty( a.openDelay );
        }

        if( returnZeroIfEmpty( a.openLimit ) > 0 ) {
          options.openLimit = returnZeroIfEmpty( a.openLimit );
          options.openLimitExpiration = a.openLimitExpiration;
        }
      }

      return (
        el('dialog', {
          'data-options': JSON.stringify( options ),
          className: classes,
        },
          el( 'a', {
            href: '#',
            className: 'close-dialog corner-close-button',
          },
            el( 'span', {
              className: 'screen-reader-text',
            }, 'test' ),
          ),
          el( 'div', {
            className: 'dialog-content',
          },
            el( InnerBlocks.Content, null )
          )
        )
      );
    }
	} );
} ) (
  window.wp.editor,
  window.wp.element
);
